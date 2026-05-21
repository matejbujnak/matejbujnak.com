<?php
require_once 'includes/blog.php';

// Validate slug - alphanumeric, hyphens, underscores only
$slug = preg_replace('/[^a-z0-9_-]/i', '', $_GET['slug'] ?? '');
if (!$slug) {
    header('Location: /blog.php');
    exit;
}

require_once 'includes/lang.php';
$file = get_post_file($lang, $slug);
if (!$file) {
    http_response_code(404);
    header('Location: /blog.php');
    exit;
}

$raw     = file_get_contents($file);
$parsed  = parse_frontmatter($raw);
$meta    = $parsed['meta'];
$content = markdown_to_html($parsed['body']);

$pageTitle       = ($meta['title'] ?? 'Post') . ' - Matej Bujňák';
$pageDescription = $meta['description'] ?? '';

require_once 'includes/header.php';
?>

<main>
<article style="padding: 80px 0 120px;" class="bg-white">
  <div class="max-w-2xl mx-auto px-6">

    <!-- Back to blog -->
    <a href="/blog.php"
       class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-blue-600 transition-colors mb-12">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
      </svg>
      Blog
    </a>

    <!-- Post header -->
    <header class="mb-10">
      <?php if (!empty($meta['tags'])): ?>
        <div class="flex flex-wrap gap-2 mb-5">
          <?php foreach (array_map('trim', explode(',', $meta['tags'])) as $tag): ?>
            <span class="text-xs font-mono bg-blue-50 text-blue-600 px-2.5 py-1 rounded-full">
              <?= htmlspecialchars($tag) ?>
            </span>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 leading-tight mb-4">
        <?= htmlspecialchars($meta['title'] ?? '') ?>
      </h1>

      <?php if (!empty($meta['description'])): ?>
        <p class="text-lg text-gray-500 leading-relaxed mb-5">
          <?= htmlspecialchars($meta['description']) ?>
        </p>
      <?php endif; ?>

      <span class="text-xs font-mono text-gray-400">
        <?= htmlspecialchars($meta['date'] ?? '') ?>
      </span>
    </header>

    <hr class="border-gray-100 mb-10">

    <!-- Markdown content -->
    <div>
      <?= $content ?>
    </div>

  </div>
</article>
</main>

<?php require_once 'includes/footer.php'; ?>
