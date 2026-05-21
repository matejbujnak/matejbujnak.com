<?php
require_once __DIR__ . '/lang.php';

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

    <title><?= htmlspecialchars($pageTitle) ?></title>
    <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>" />
    <link rel="canonical" href="<?= htmlspecialchars($pageCanonical) ?>" />

    <meta property="og:type"        content="website" />
    <meta property="og:url"         content="<?= htmlspecialchars($pageCanonical) ?>" />
    <meta property="og:title"       content="<?= htmlspecialchars($pageTitle) ?>" />
    <meta property="og:description" content="<?= htmlspecialchars($pageDescription) ?>" />
    <meta property="og:locale"      content="<?= $langMeta[$lang]['locale'] ?>" />
    <meta name="twitter:card"        content="summary" />
    <meta name="twitter:title"       content="<?= htmlspecialchars($pageTitle) ?>" />
    <meta name="twitter:description" content="<?= htmlspecialchars($pageDescription) ?>" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ['Inter', 'system-ui', 'sans-serif'],
              mono: ['JetBrains Mono', 'monospace'],
            },
            letterSpacing: { widest2: '0.15em' },
          },
        },
      }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet" />

    <style>
      body { font-family: 'Inter', sans-serif; line-height: 1.6; background: #fff; color: #212529; }

      /* ---- Navbar ---- */
      #navbar { transition: all 0.3s ease; background: transparent; }
      #navbar .nav-link { color: white; font-weight: 500; transition: all 0.3s ease; }
      #navbar .nav-link:hover { color: rgba(255,255,255,0.75); }
      #navbar .nav-brand { color: white; font-weight: 700; }

      #navbar.scrolled {
        background: rgba(255,255,255,0.98);
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      }
      #navbar.scrolled .nav-link  { color: #212529; }
      #navbar.scrolled .nav-link:hover { color: #0d6efd; }
      #navbar.scrolled .nav-brand { color: #212529; }
      #navbar.scrolled .nav-contact-btn {
        border-color: #0d6efd !important;
        color: #0d6efd !important;
      }
      #navbar.scrolled .nav-contact-btn:hover {
        background: #0d6efd !important;
        color: white !important;
      }
      #navbar.scrolled .lang-trigger { color: #6c757d; }
      #navbar.scrolled .lang-trigger:hover { color: #212529; }
      #navbar.scrolled .lang-divider { border-color: #dee2e6; }

      /* ---- Lang dropdown ---- */
      .lang-dropdown { position: relative; }
      .lang-menu {
        position: absolute; top: 100%; right: 0; padding-top: 8px;
        opacity: 0; visibility: hidden; pointer-events: none;
        transition: opacity 0.15s ease, visibility 0s linear 0.8s;
      }
      .lang-menu-inner {
        background: #fff; border: 1px solid rgba(0,0,0,0.1); border-radius: 8px;
        overflow: hidden; box-shadow: 0 2px 15px rgba(0,0,0,0.1); min-width: 110px;
      }
      .lang-dropdown:hover .lang-menu {
        opacity: 1; visibility: visible; pointer-events: auto;
        transition: opacity 0.15s ease, visibility 0s linear 0s;
      }

      /* ---- Hero waves ---- */
      .hero-waves {
        position: absolute; bottom: 0; left: 0;
        width: 100%; height: 100px;
      }
      .waves { width: 100%; height: 100px; }
      .parallax > use { animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite; }
      .parallax > use:nth-child(1) { animation-delay: -2s; animation-duration: 7s; }
      .parallax > use:nth-child(2) { animation-delay: -3s; animation-duration: 10s; }
      .parallax > use:nth-child(3) { animation-delay: -4s; animation-duration: 13s; }
      .parallax > use:nth-child(4) { animation-delay: -5s; animation-duration: 20s; }
      @keyframes move-forever {
        0%   { transform: translate3d(-90px,0,0); }
        100% { transform: translate3d(85px,0,0); }
      }

      /* ---- Floating hero image ---- */
      @keyframes float {
        0%   { transform: translateY(0px); }
        50%  { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
      }
      .hero-img { animation: float 3s ease-in-out infinite; }

      /* ---- Social icons ---- */
      .social-icon { transition: transform 0.3s ease; display: inline-flex; }
      .social-icon:hover { transform: translateY(-5px); }

      /* ---- Mobile: always solid navbar ---- */
      @media (max-width: 767px) {
        #navbar {
          background: rgba(255,255,255,0.98) !important;
          box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        #navbar .nav-brand { color: #212529 !important; }
        #navbar .nav-hamburger { color: #212529 !important; }
      }

      /* ---- Mobile menu links ---- */
      .mobile-nav-link { color: #212529; font-size: 0.95rem; font-weight: 500; transition: color 0.2s; }
      .mobile-nav-link:hover { color: #0d6efd; }
      #mobile-menu { border-top: 1px solid #e5e7eb; }

      /* ---- Sections ---- */
      section { padding: 100px 0; }
      @media (max-width: 768px) {
        section { padding: 60px 0; }
        .hero-waves { height: 40px; }
        .waves { height: 40px; }
      }
    </style>
</head>
<body>

<!-- Preloader -->
<div id="preloader" class="fixed inset-0 bg-white flex items-center justify-center z-[9999]">
  <div style="width:50px;height:50px;border:5px solid #f3f3f3;border-top:5px solid #0d6efd;border-radius:50%;animation:spin 1s linear infinite;"></div>
</div>
<style>
  @keyframes spin { 0%{transform:rotate(0deg)} 100%{transform:rotate(360deg)} }
  #preloader.fade-out { opacity:0; visibility:hidden; transition: all 0.6s ease; }
</style>
<script>
  window.addEventListener('load', function() {
    document.getElementById('preloader').classList.add('fade-out');
  });
</script>

<!-- ===== NAVBAR ===== -->
<header id="navbar" class="fixed top-0 inset-x-0 z-50 py-4">
  <div class="max-w-6xl mx-auto px-6 flex items-center justify-between">

    <a href="/" class="nav-brand font-bold text-lg">Matej Bujňák</a>

    <div class="hidden md:flex items-center gap-8">
      <nav class="flex items-center gap-7 text-sm">
        <a href="/#projects"   class="nav-link"><?= $t['nav_projects'] ?></a>
        <a href="/#experience" class="nav-link"><?= $t['nav_experience'] ?></a>
        <a href="/#education"  class="nav-link"><?= $t['nav_education'] ?></a>
        <a href="/#about"      class="nav-link"><?= $t['nav_about'] ?></a>
        <a href="/#stack"      class="nav-link"><?= $t['nav_stack'] ?></a>
        <a href="/blog.php"    class="nav-link"><?= $t['nav_blog'] ?></a>
        <a href="mailto:bujnak.matko@gmail.com"
           class="nav-contact-btn px-4 py-1.5 rounded border-2 border-white/60 text-white text-sm font-medium hover:bg-white hover:text-blue-600 transition-all">
          <?= $t['nav_contact'] ?>
        </a>
      </nav>

      <!-- Lang -->
      <?php $currentPath = strtok($_SERVER['REQUEST_URI'] ?? '/', '?'); ?>
      <div class="lang-dropdown lang-divider pl-5 border-l border-white/25">
        <button class="lang-trigger inline-flex items-center gap-1.5 text-xs font-mono text-white/75 hover:text-white transition-colors select-none py-1">
          <span><?= $langMeta[$lang]['flag'] ?></span>
          <span><?= $langMeta[$lang]['label'] ?></span>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        <div class="lang-menu" role="menu">
          <div class="lang-menu-inner">
            <?php foreach ($langMeta as $code => $meta): ?>
              <a href="<?= htmlspecialchars($currentPath) ?>?lang=<?= $code ?>"
                 role="menuitem"
                 class="flex items-center gap-2.5 px-3.5 py-2.5 text-xs font-mono transition-colors
                        <?= $code === $lang ? 'text-blue-600 bg-blue-50 font-medium' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' ?>">
                <span><?= $meta['flag'] ?></span>
                <span><?= $meta['label'] ?></span>
                <?php if ($code === $lang): ?>
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-auto text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                  </svg>
                <?php endif; ?>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

    <button id="mobile-menu-btn" class="md:hidden nav-hamburger" aria-label="Menu">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>

  </div>

  <!-- Mobile menu -->
  <div id="mobile-menu" class="md:hidden hidden px-6 pb-4 pt-2">
    <nav class="flex flex-col gap-1">
      <a href="/#projects"   class="mobile-nav-link py-2.5 border-b border-gray-100"><?= $t['nav_projects'] ?></a>
      <a href="/#experience" class="mobile-nav-link py-2.5 border-b border-gray-100"><?= $t['nav_experience'] ?></a>
      <a href="/#education"  class="mobile-nav-link py-2.5 border-b border-gray-100"><?= $t['nav_education'] ?></a>
      <a href="/#about"      class="mobile-nav-link py-2.5 border-b border-gray-100"><?= $t['nav_about'] ?></a>
      <a href="/#stack"      class="mobile-nav-link py-2.5 border-b border-gray-100"><?= $t['nav_stack'] ?></a>
      <a href="/blog.php"    class="mobile-nav-link py-2.5 border-b border-gray-100"><?= $t['nav_blog'] ?></a>
      <a href="mailto:bujnak.matko@gmail.com" class="mobile-nav-link py-2.5 border-b border-gray-100"><?= $t['nav_contact'] ?></a>
    </nav>
    <!-- Language selector -->
    <?php $currentPath = strtok($_SERVER['REQUEST_URI'] ?? '/', '?'); ?>
    <div class="flex items-center gap-2 pt-3">
      <?php foreach ($langMeta as $code => $meta): ?>
        <a href="<?= htmlspecialchars($currentPath) ?>?lang=<?= $code ?>"
           class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-mono transition-colors
                  <?= $code === $lang ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' ?>">
          <span><?= $meta['flag'] ?></span>
          <span><?= $meta['label'] ?></span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</header>

<script>
  var navbar = document.getElementById('navbar');
  window.addEventListener('scroll', function() {
    navbar.classList.toggle('scrolled', window.scrollY > 40);
  }, { passive: true });

  // Mobile menu toggle
  var mobileBtn  = document.getElementById('mobile-menu-btn');
  var mobileMenu = document.getElementById('mobile-menu');
  mobileBtn.addEventListener('click', function() {
    mobileMenu.classList.toggle('hidden');
  });
  // Close on link click
  mobileMenu.querySelectorAll('a').forEach(function(link) {
    link.addEventListener('click', function() {
      mobileMenu.classList.add('hidden');
    });
  });
</script>
