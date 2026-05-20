<?php
// Defaults – každá stránka ich môže prepísať pred includovaním header.php
$pageTitle       = $pageTitle       ?? 'Matej Bujnák — Data Engineer & ML Engineer';
$pageDescription = $pageDescription ?? 'Portfólio Mateja Bujnáka - študent AI na FIT ČVUT, Data Engineer a Software Engineer. Špecializácia: ETL pipeline, Machine Learning, Python.';
$pageCanonical   = $pageCanonical   ?? 'https://matejbujnak.com' . ($_SERVER['REQUEST_URI'] ?? '/');
?>
<!DOCTYPE html>
<html lang="sk" class="scroll-smooth">
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
    <meta property="og:locale"      content="sk_SK" />

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
    </style>
</head>
<body class="dark font-sans antialiased min-h-screen relative">

<!-- ===== NAV ===== -->
<header class="fixed top-0 inset-x-0 z-50 border-b border-white/5 backdrop-blur-md bg-surface/80">
  <nav class="max-w-5xl mx-auto px-6 h-14 flex items-center justify-between">

    <!-- Logo / meno -->
    <a href="/" class="font-mono text-sm text-accent tracking-wide hover:text-accent-hover transition-colors">
      mb<span class="text-muted">.</span>
    </a>

    <!-- Navigačné linky -->
    <ul class="hidden sm:flex items-center gap-8 text-sm text-muted font-medium">
      <li><a href="/#projects"     class="hover:text-slate-200 transition-colors">Projekty</a></li>
      <li><a href="/#experience"   class="hover:text-slate-200 transition-colors">Prax</a></li>
      <li><a href="/#stack"        class="hover:text-slate-200 transition-colors">Stack</a></li>
      <li><a href="/blog.php"      class="hover:text-slate-200 transition-colors">Blog</a></li>
      <li>
        <a href="mailto:matej@matejbujnak.com"
           class="px-4 py-1.5 rounded border border-accent/40 text-accent hover:bg-accent/10 transition-colors">
          Kontakt
        </a>
      </li>
    </ul>

    <!-- Mobile menu placeholder (rozšírime neskôr) -->
    <button class="sm:hidden text-muted hover:text-slate-200 transition-colors" aria-label="Menu">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>

  </nav>
</header>

