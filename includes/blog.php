<?php
/**
 * Blog helper - frontmatter parser, markdown renderer, post listing
 */

function parse_frontmatter(string $raw): array {
    $raw = ltrim($raw);
    if (!str_starts_with($raw, '---')) {
        return ['meta' => [], 'body' => $raw];
    }
    $end = strpos($raw, '---', 3);
    if ($end === false) {
        return ['meta' => [], 'body' => $raw];
    }
    $yaml = substr($raw, 3, $end - 3);
    $body = trim(substr($raw, $end + 3));
    $meta = [];
    foreach (explode("\n", trim($yaml)) as $line) {
        $line = trim($line);
        if ($line === '') continue;
        $pos = strpos($line, ':');
        if ($pos !== false) {
            $key = trim(substr($line, 0, $pos));
            $val = trim(substr($line, $pos + 1), " \t\"'");
            $meta[$key] = $val;
        }
    }
    return ['meta' => $meta, 'body' => $body];
}

function get_post_file(string $lang, string $slug): ?string {
    $base = dirname(__DIR__) . '/posts/';
    // Try current language first, then fall back to English
    foreach ([$lang, 'en'] as $l) {
        $path = $base . $l . '/' . $slug . '.md';
        if (file_exists($path)) return $path;
    }
    return null;
}

function get_posts(string $lang = 'en'): array {
    $base  = dirname(__DIR__) . '/posts/';
    $posts = [];
    $seen  = [];

    // Load current language posts, then fill missing with EN fallback
    foreach ([$lang, 'en'] as $l) {
        $dir = $base . $l . '/';
        if (!is_dir($dir)) continue;
        foreach (glob($dir . '*.md') as $file) {
            $slug = basename($file, '.md');
            if (isset($seen[$slug])) continue; // already have a version
            $raw    = file_get_contents($file);
            $parsed = parse_frontmatter($raw);
            $meta   = $parsed['meta'];
            if (empty($meta['title'])) continue;
            $seen[$slug] = true;
            $posts[] = [
                'slug'        => $slug,
                'title'       => $meta['title'],
                'date'        => $meta['date']        ?? '',
                'description' => $meta['description'] ?? '',
                'tags'        => isset($meta['tags'])
                                 ? array_map('trim', explode(',', $meta['tags']))
                                 : [],
            ];
        }
    }

    usort($posts, fn($a, $b) => strcmp($b['date'], $a['date']));
    return $posts;
}

// ── Markdown renderer ──────────────────────────────────────────────────────

function markdown_to_html(string $text): string {
    // 1. Protect fenced code blocks
    $codeBlocks = [];
    $text = preg_replace_callback('/^```(\w*)\n(.*?)^```/ms', function ($m) use (&$codeBlocks) {
        $id   = count($codeBlocks);
        $lang = $m[1] !== '' ? ' class="language-' . htmlspecialchars($m[1]) . '"' : '';
        $codeBlocks[$id] = '<pre class="bg-gray-900 text-gray-100 rounded-xl p-5 overflow-x-auto my-6 text-sm leading-relaxed"><code' . $lang . '>'
                         . htmlspecialchars(rtrim($m[2]))
                         . '</code></pre>';
        return "%%CB{$id}%%";
    }, $text);

    // 2. Protect inline code
    $inlineCodes = [];
    $text = preg_replace_callback('/`([^`\n]+)`/', function ($m) use (&$inlineCodes) {
        $id = count($inlineCodes);
        $inlineCodes[$id] = '<code class="bg-gray-100 text-pink-600 px-1.5 py-0.5 rounded text-[0.85em] font-mono">'
                          . htmlspecialchars($m[1])
                          . '</code>';
        return "%%IC{$id}%%";
    }, $text);

    $lines  = explode("\n", $text);
    $html   = '';
    $i      = 0;
    $n      = count($lines);
    $inUl   = false;
    $inOl   = false;

    $closeList = function () use (&$html, &$inUl, &$inOl) {
        if ($inUl) { $html .= "</ul>\n"; $inUl = false; }
        if ($inOl) { $html .= "</ol>\n"; $inOl = false; }
    };

    $hClass = [
        1 => 'text-3xl font-bold text-gray-900 mt-12 mb-4 leading-snug',
        2 => 'text-2xl font-bold text-gray-900 mt-10 mb-3 leading-snug',
        3 => 'text-xl  font-semibold text-gray-800 mt-8  mb-2',
        4 => 'text-lg  font-semibold text-gray-800 mt-6  mb-2',
        5 => 'text-base font-semibold text-gray-700 mt-5 mb-1',
        6 => 'text-sm  font-semibold text-gray-600 mt-4  mb-1',
    ];

    while ($i < $n) {
        $line = $lines[$i];

        // Heading
        if (preg_match('/^(#{1,6})\s+(.+)/', $line, $m)) {
            $closeList();
            $lvl  = strlen($m[1]);
            $html .= "<h{$lvl} class=\"{$hClass[$lvl]}\">" . inline_md($m[2]) . "</h{$lvl}>\n";

        // HR
        } elseif (preg_match('/^(-{3,}|\*{3,}|_{3,})\s*$/', $line)) {
            $closeList();
            $html .= '<hr class="my-8 border-gray-200">' . "\n";

        // Blockquote
        } elseif (preg_match('/^>\s*(.*)/', $line, $m)) {
            $closeList();
            $html .= '<blockquote class="border-l-4 border-blue-400 pl-5 my-5 text-gray-600 italic">'
                   . inline_md($m[1]) . "</blockquote>\n";

        // Unordered list
        } elseif (preg_match('/^[-*+]\s+(.+)/', $line, $m)) {
            if ($inOl) { $html .= "</ol>\n"; $inOl = false; }
            if (!$inUl) {
                $html .= '<ul class="list-disc list-outside pl-5 space-y-1.5 my-5 text-gray-700">' . "\n";
                $inUl = true;
            }
            $html .= '<li>' . inline_md($m[1]) . "</li>\n";

        // Ordered list
        } elseif (preg_match('/^\d+\.\s+(.+)/', $line, $m)) {
            if ($inUl) { $html .= "</ul>\n"; $inUl = false; }
            if (!$inOl) {
                $html .= '<ol class="list-decimal list-outside pl-5 space-y-1.5 my-5 text-gray-700">' . "\n";
                $inOl = true;
            }
            $html .= '<li>' . inline_md($m[1]) . "</li>\n";

        // Table
        } elseif (str_starts_with(trim($line), '|')) {
            $closeList();
            $tableLines = [$line];
            while (isset($lines[$i + 1]) && str_starts_with(trim($lines[$i + 1]), '|')) {
                $i++;
                $tableLines[] = $lines[$i];
            }
            $html .= render_md_table($tableLines);

        // Code block placeholder on its own line
        } elseif (preg_match('/^%%CB(\d+)%%$/', trim($line), $m)) {
            $closeList();
            $html .= $codeBlocks[(int)$m[1]] . "\n";

        // Empty line
        } elseif (trim($line) === '') {
            $closeList();
            $i++;
            continue;

        // Paragraph
        } else {
            $closeList();
            $para = $line;
            while (
                isset($lines[$i + 1])
                && trim($lines[$i + 1]) !== ''
                && !preg_match('/^(#{1,6}\s|>|[-*+]\s|\d+\.\s|%%CB)/', $lines[$i + 1])
                && !preg_match('/^(-{3,}|\*{3,}|_{3,})\s*$/', $lines[$i + 1])
            ) {
                $i++;
                $para .= ' ' . $lines[$i];
            }
            $html .= '<p class="text-gray-700 leading-[1.85] my-5">' . inline_md($para) . "</p>\n";
        }

        $i++;
    }
    $closeList();

    // Restore placeholders
    foreach ($codeBlocks  as $id => $block) $html = str_replace("%%CB{$id}%%",  $block, $html);
    foreach ($inlineCodes as $id => $code)  $html = str_replace("%%IC{$id}%%",  $code,  $html);

    return $html;
}

function render_md_table(array $lines): string {
    $parseCells = function(string $line): array {
        $line = trim($line);
        if (str_starts_with($line, '|')) $line = substr($line, 1);
        if (str_ends_with($line, '|'))   $line = substr($line, 0, -1);
        return array_map('trim', explode('|', $line));
    };

    $isSep = fn($l) => (bool)preg_match('/^\s*\|[\s\-:|]+\|/', $l) && str_contains($l, '-');

    // Find separator row index
    $sepIdx = -1;
    foreach ($lines as $idx => $line) {
        if ($isSep($line)) { $sepIdx = $idx; break; }
    }

    $headers = [];
    $rows    = [];
    foreach ($lines as $idx => $line) {
        if ($isSep($line)) continue;
        if ($sepIdx >= 0 && $idx < $sepIdx) $headers = $parseCells($line);
        else                                $rows[]   = $parseCells($line);
    }

    $html = '<div class="overflow-x-auto my-6"><table class="w-full text-sm border-collapse">';

    if ($headers) {
        $html .= '<thead><tr>';
        foreach ($headers as $cell) {
            $html .= '<th class="text-left px-4 py-2.5 font-semibold text-gray-700 border-b-2 border-gray-200 bg-gray-50">'
                   . inline_md($cell) . '</th>';
        }
        $html .= '</tr></thead>';
    }

    $html .= '<tbody>';
    foreach ($rows as $row) {
        $html .= '<tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">';
        foreach ($row as $cell) {
            $html .= '<td class="px-4 py-2.5 text-gray-700">' . inline_md($cell) . '</td>';
        }
        $html .= '</tr>';
    }
    $html .= '</tbody></table></div>';

    return $html;
}

function inline_md(string $text): string {
    // Bold
    $text = preg_replace('/\*\*(.+?)\*\*/s', '<strong class="font-semibold text-gray-900">$1</strong>', $text);
    $text = preg_replace('/__(.+?)__/s',     '<strong class="font-semibold text-gray-900">$1</strong>', $text);
    // Italic
    $text = preg_replace('/\*(.+?)\*/s', '<em>$1</em>', $text);
    $text = preg_replace('/_(.+?)_/s',   '<em>$1</em>', $text);
    // Image (before links)
    $text = preg_replace(
        '/!\[([^\]]*)\]\(([^)]+)\)/',
        '<img src="$2" alt="$1" class="max-w-full rounded-xl my-6 shadow-sm">',
        $text
    );
    // Link
    $text = preg_replace(
        '/\[([^\]]+)\]\(([^)]+)\)/',
        '<a href="$2" class="text-blue-600 hover:underline font-medium" target="_blank" rel="noopener">$1</a>',
        $text
    );
    return $text;
}
