<?php
require_once __DIR__ . '/lang.php';

// Defaults – stránka ich môže prepísať pred includovaním header.php
$pageTitle       = $pageTitle       ?? $t['page_title'];
$pageDescription = $pageDescription ?? $t['page_desc'];
$pageCanonical   = $pageCanonical   ?? 'https://matejbujnak.com' . strtok($_SERVER['REQUEST_URI'] ?? '/', '?');

$langMeta = [
    'cs' => ['flag' => '🇨🇿', 'label' => 'CS', 'locale' => 'cs_CZ'],
    'sk' => ['flag' => '🇸🇰', 'label' => 'SK', 'locale' => 'sk_SK'],
    'en' => ['flag' => '🇬🇧', 'label' => 'EN', 'locale' => 'en_GB'],
];
?>
<!DOCTYPE html>
<html lang="<?= $t['html_lang'] ?>" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Primary SEO -->
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>" />
    <link rel="canonical" href="<?= htmlspecialchars($pageCanonical) ?>" />

    <!-- Open Graph -->
    <meta property="og:type"        content="website" />
    <meta property="og:url"         content="<?= htmlspecialchars($pageCanonical) ?>" />
    <meta property="og:title"       content="<?= htmlspecialchars($pageTitle) ?>" />
    <meta property="og:description" content="<?= htmlspecialchars($pageDescription) ?>" />
    <meta property="og:locale"      content="<?= $langMeta[$lang]['locale'] ?>" />

    <!-- Twitter Card -->
    <meta name="twitter:card"        content="summary" />
    <meta name="twitter:title"       content="<?= htmlspecialchars($pageTitle) ?>" />
    <meta name="twitter:description" content="<?= htmlspecialchars($pageDescription) ?>" />

    <!-- Tailwind CSS (CDN – dev only, pred produkciou prepnúť na CLI build) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: 'class',
        theme: {
          extend: {
            fontFamily: {
              sans: ['Inter', 'system-ui', 'sans-serif'],
              mono: ['JetBrains Mono', 'Fira Code', 'monospace'],
            },
            colors: {
              surface: {
                DEFAULT: '#0f1117',
                1: '#161b27',
                2: '#1e2537',
              },
              accent: {
                DEFAULT: '#4f8ef7',
                hover:   '#3b7de8',
              },
              muted: '#8892a4',
            },
            letterSpacing: {
              widest2: '0.2em',
            },
          },
        },
      }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet" />

    <style>
      body {
        background-color: #080c14;
        background-image:
          radial-gradient(ellipse 80% 50% at 50% -10%, rgba(79,142,247,0.12) 0%, transparent 70%),
          radial-gradient(ellipse 50% 40% at 80% 60%, rgba(139,92,246,0.07) 0%, transparent 60%);
        color: #e2e8f0;
      }

      .gradient-text {
        background: linear-gradient(135deg, #ffffff 0%, #a5b4fc 50%, #60a5fa 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
      }

      .card-meta {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.07);
        transition: border-color 0.2s, background 0.2s;
      }
      .card-meta:hover {
        background: rgba(255,255,255,0.055);
        border-color: rgba(79,142,247,0.25);
      }

      /* Lang dropdown */
      .lang-dropdown { position: relative; }
      .lang-menu {
        position: absolute;
        top: 100%;
        right: 0;
        /* padding-top vytvorí neviditeľný most cez medzeru – myš cez neho prejde bez straty hoveru */
        padding-top: 10px;
        min-width: 120px;
        opacity: 0;
        visibility: hidden;
        /* Pri schovaní počkaj 0.8s pred zmiznutím */
        transition: opacity 0.15s ease, visibility 0s linear 0.8s;
        pointer-events: none;
      }
      .lang-menu-inner {
        background: #161b27;
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0,0,0,0.4);
      }
      .lang-dropdown:hover .lang-menu {
        opacity: 1;
        visibility: visible;
        /* Pri otvorení žiadny delay */
        transition: opacity 0.15s ease, visibility 0s linear 0s;
        pointer-events: auto;
      }
    </style>
</head>
<body class="dark font-sans antialiased min-h-screen relative">

<!-- ===== NAV ===== -->
<header class="fixed top-0 inset-x-0 z-50 border-b border-white/5 backdrop-blur-md bg-surface/80">
  <nav class="max-w-5xl mx-auto px-6 h-14 flex items-center justify-between">

    <!-- Logo -->
    <a href="/" class="font-mono text-sm text-accent tracking-wide hover:text-accent-hover transition-colors">
      mb<span class="text-muted">.</span>
    </a>

    <!-- Navigačné linky + lang selector -->
    <div class="hidden sm:flex items-center gap-6">
      <ul class="flex items-center gap-7 text-sm text-muted font-medium">
        <li><a href="/#projects"   class="hover:text-slate-200 transition-colors"><?= $t['nav_projects'] ?></a></li>
        <li><a href="/#experience" class="hover:text-slate-200 transition-colors"><?= $t['nav_experience'] ?></a></li>
        <li><a href="/#stack"      class="hover:text-slate-200 transition-colors"><?= $t['nav_stack'] ?></a></li>
        <li><a href="/blog.php"    class="hover:text-slate-200 transition-colors"><?= $t['nav_blog'] ?></a></li>
        <li>
          <a href="mailto:matej@matejbujnak.com"
             class="px-4 py-1.5 rounded border border-accent/40 text-accent hover:bg-accent/10 transition-colors">
            <?= $t['nav_contact'] ?>
          </a>
        </li>
      </ul>

      <!-- Language dropdown -->
      <?php $currentPath = strtok($_SERVER['REQUEST_URI'] ?? '/', '?'); ?>
      <div class="lang-dropdown pl-4 border-l border-white/10">

        <!-- Trigger -->
        <button class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded
                       text-xs font-mono text-muted hover:text-slate-200
                       border border-transparent hover:border-white/10
                       transition-colors select-none">
          <span><?= $langMeta[$lang]['flag'] ?></span>
          <span><?= $langMeta[$lang]['label'] ?></span>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>

        <!-- Menu -->
        <div class="lang-menu" role="menu">
          <div class="lang-menu-inner">
            <?php foreach ($langMeta as $code => $meta): ?>
              <a href="<?= htmlspecialchars($currentPath) ?>?lang=<?= $code ?>"
                 role="menuitem"
                 class="flex items-center gap-2.5 px-3.5 py-2.5 text-xs font-mono transition-colors
                        <?= $code === $lang
                            ? 'text-accent bg-accent/8'
                            : 'text-muted hover:text-slate-200 hover:bg-white/5' ?>">
                <span><?= $meta['flag'] ?></span>
                <span><?= $meta['label'] ?></span>
                <?php if ($code === $lang): ?>
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-auto text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                  </svg>
                <?php endif; ?>
              </a>
            <?php endforeach; ?>
          </div>
        </div>

      </div>
    </div>

    <!-- Mobile menu button -->
    <button class="sm:hidden text-muted hover:text-slate-200 transition-colors" aria-label="Menu">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>

  </nav>
</header>

