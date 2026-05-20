<?php
require_once 'includes/header.php';
?>

<!-- ===== HERO ===== -->
<main>
<section class="relative min-h-screen flex flex-col justify-center px-6 overflow-hidden">

  <div class="relative z-10 max-w-5xl mx-auto w-full pt-28 pb-24">

    <!-- Name + title -->
    <div class="mb-7">
      <h1 class="text-5xl sm:text-6xl md:text-7xl font-bold tracking-tight leading-[1.05] mb-3">
        <span class="gradient-text">Matej Bujňák</span>
      </h1>
      <p class="text-xl sm:text-2xl font-medium text-slate-400 tracking-tight">
        <?= htmlspecialchars($t['hero_subtitle']) ?>
      </p>
    </div>

    <!-- Main text -->
    <p class="max-w-xl mb-10 text-[0.97rem] sm:text-base leading-relaxed text-slate-400">
      <?= $t['hero_text'] ?>
    </p>

    <!-- CTA buttons -->
    <div class="flex flex-wrap gap-3 mb-16">
      <!-- GitHub -->
      <a href="https://github.com/matejbujnak" target="_blank" rel="noopener"
         class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg
                bg-white/5 hover:bg-white/10 border border-white/10 hover:border-white/20
                text-slate-300 hover:text-white font-medium text-sm transition-all duration-150">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61-.546-1.385-1.335-1.755-1.335-1.755-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
        </svg>
        <?= htmlspecialchars($t['hero_github']) ?>
      </a>
      <!-- LinkedIn -->
      <a href="https://www.linkedin.com/in/matejbujnak/" target="_blank" rel="noopener"
         class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg
                bg-accent/10 hover:bg-accent/20 border border-accent/20 hover:border-accent/40
                text-accent hover:text-white font-medium text-sm transition-all duration-150">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
          <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
        </svg>
        <?= htmlspecialchars($t['hero_linkedin']) ?>
      </a>
      <!-- CV -->
      <a href="<?= htmlspecialchars($t['cv_file']) ?>" target="_blank"
         class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg
                border border-white/10 hover:border-white/20
                text-slate-400 hover:text-slate-200 font-medium text-sm transition-all duration-150">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
        </svg>
        <?= htmlspecialchars($t['hero_cv']) ?>
      </a>
    </div>

    <!-- Meta cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-w-xl">

      <div class="card-meta rounded-xl p-4">
        <p class="text-[10px] font-mono uppercase tracking-widest2 text-muted mb-2"><?= htmlspecialchars($t['meta_edu_label']) ?></p>
        <p class="text-sm font-medium text-slate-200 leading-snug"><?= htmlspecialchars($t['meta_edu_title']) ?></p>
        <p class="text-xs text-muted mt-0.5"><?= htmlspecialchars($t['meta_edu_sub']) ?></p>
      </div>

      <div class="card-meta rounded-xl p-4">
        <p class="text-[10px] font-mono uppercase tracking-widest2 text-muted mb-2"><?= htmlspecialchars($t['meta_exp_label']) ?></p>
        <p class="text-sm font-medium text-slate-200 leading-snug"><?= htmlspecialchars($t['meta_exp_title']) ?></p>
        <p class="text-xs text-muted mt-0.5"><?= htmlspecialchars($t['meta_exp_sub']) ?></p>
      </div>

    </div>

  </div>
</section>
</main>

<?php require_once 'includes/footer.php'; ?>
