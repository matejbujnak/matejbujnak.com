<?php
$pageTitle       = 'Matej Bujnák — Data Engineer & ML Engineer';
$pageDescription = 'Portfólio Mateja Bujnáka – študent AI na FIT ČVUT, Data Engineer a Software Engineer. Špecializácia na ETL pipeline, Machine Learning a Python.';
require_once 'includes/header.php';
?>

<!-- ===== HERO ===== -->
<main>
<section class="relative min-h-screen flex flex-col justify-center px-6">

  <!-- Jemný radial glow za textom -->
  <div class="absolute inset-0 -z-0 overflow-hidden pointer-events-none" aria-hidden="true">
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2
                w-[600px] h-[600px] rounded-full
                bg-accent/5 blur-[120px]"></div>
  </div>

  <div class="relative z-10 max-w-5xl mx-auto w-full pt-28 pb-24">

    <!-- Chip / status badge -->
    <div class="inline-flex items-center gap-2 mb-8
                px-3 py-1.5 rounded-full border border-white/10
                bg-white/5 text-xs font-mono text-muted tracking-wide">
      <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
      Dostupný pre spoluprácu &amp; stáže · 2026
    </div>

    <!-- Headline -->
    <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold tracking-tight leading-[1.1] text-slate-50 mb-6">
      Data Engineering.<br />
      <span class="text-accent">Pipeline-first</span> myslenie.<br />
      <span class="text-slate-400 font-light">Od scrapu po model.</span>
    </h1>

    <!-- Perex -->
    <p class="max-w-xl text-base sm:text-lg text-muted leading-relaxed mb-10">
      Volám sa <span class="text-slate-200 font-medium">Matej Bujnák</span> — študent AI na FIT ČVUT a software engineer.
      Staviam spoľahlivé <span class="text-slate-200 font-medium">ETL pipelines</span>, trénujem
      <span class="text-slate-200 font-medium">ML modely</span> a transformujem surové dáta
      na výsledky, ktoré dávajú zmysel.
    </p>

    <!-- CTA tlačidlá -->
    <div class="flex flex-wrap gap-4">
      <a href="#projects"
         class="inline-flex items-center gap-2 px-6 py-3 rounded
                bg-accent hover:bg-accent-hover text-white font-medium text-sm
                transition-colors duration-150">
        Pozrieť projekty
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
        </svg>
      </a>
      <a href="/blog.php"
         class="inline-flex items-center gap-2 px-6 py-3 rounded
                border border-white/10 text-slate-300 hover:text-white hover:border-white/25
                font-medium text-sm transition-colors duration-150">
        Čítať blog
      </a>
    </div>

    <!-- Technický podpis / key stat -->
    <div class="mt-16 pt-8 border-t border-white/5
                grid grid-cols-2 sm:grid-cols-3 gap-y-8 gap-x-6 max-w-lg">

      <div>
        <p class="font-mono text-2xl font-semibold text-slate-100">21 000<span class="text-accent">+</span></p>
        <p class="text-xs text-muted mt-1 tracking-wide">záznamov v datasete</p>
      </div>

      <div>
        <p class="font-mono text-2xl font-semibold text-slate-100">R² <span class="text-accent">0.95</span></p>
        <p class="text-xs text-muted mt-1 tracking-wide">presnosť ML modelu</p>
      </div>

      <div>
        <p class="font-mono text-2xl font-semibold text-slate-100">End<span class="text-accent">-to-</span>end</p>
        <p class="text-xs text-muted mt-1 tracking-wide">scraper → ETL → model</p>
      </div>

    </div>

  </div>
</section>
</main>

<?php require_once 'includes/footer.php'; ?>
