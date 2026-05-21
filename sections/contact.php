<section id="contact" style="padding: 100px 0; background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);">
  <div class="max-w-4xl mx-auto px-6 text-center">

    <span class="inline-block text-sm font-mono font-semibold tracking-widest uppercase mb-4"
          style="color: rgba(255,255,255,0.7);">
      <?= htmlspecialchars($t['contact_tag']) ?>
    </span>
    <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
      <?= htmlspecialchars($t['contact_title']) ?>
    </h2>

    <!-- Availability cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10 mt-10">

      <div class="rounded-2xl p-6 text-left" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2);">
        <div class="flex items-start justify-between gap-3 mb-3">
          <p class="font-bold text-white"><?= htmlspecialchars($t['contact_avail1_title']) ?></p>
          <span class="text-xs font-mono px-2.5 py-1 rounded-full shrink-0 font-semibold"
                style="background: rgba(255,255,255,0.2); color: white;">
            <?= htmlspecialchars($t['contact_avail1_badge']) ?>
          </span>
        </div>
        <p class="text-sm" style="color: rgba(255,255,255,0.8);">
          <?= htmlspecialchars($t['contact_avail1_text']) ?>
        </p>
      </div>

      <div class="rounded-2xl p-6 text-left" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15);">
        <div class="flex items-start justify-between gap-3 mb-3">
          <p class="font-bold text-white"><?= htmlspecialchars($t['contact_avail2_title']) ?></p>
          <span class="text-xs font-mono px-2.5 py-1 rounded-full shrink-0"
                style="background: rgba(255,255,255,0.15); color: rgba(255,255,255,0.9);">
            <?= htmlspecialchars($t['contact_avail2_badge']) ?>
          </span>
        </div>
        <p class="text-sm" style="color: rgba(255,255,255,0.75);">
          <?= htmlspecialchars($t['contact_avail2_text']) ?>
        </p>
      </div>

    </div>

    <!-- Pitch -->
    <p class="text-base max-w-2xl mx-auto mb-10" style="color: rgba(255,255,255,0.85); line-height: 1.8;">
      <?= htmlspecialchars($t['contact_pitch']) ?>
    </p>

    <!-- Contact info -->
    <div class="flex flex-wrap justify-center gap-6 mb-10 text-sm font-mono" style="color: rgba(255,255,255,0.9);">
      <a href="mailto:<?= htmlspecialchars($t['contact_email']) ?>"
         class="flex items-center gap-2 hover:text-white transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
        <?= htmlspecialchars($t['contact_email']) ?>
      </a>
      <a href="tel:<?= htmlspecialchars($t['contact_phone']) ?>"
         class="flex items-center gap-2 hover:text-white transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
        </svg>
        <?= htmlspecialchars($t['contact_phone']) ?>
      </a>
    </div>

    <!-- CTA buttons -->
    <div class="flex flex-wrap justify-center gap-4">
      <a href="https://www.linkedin.com/in/matejbujnak/" target="_blank" rel="noopener"
         class="inline-flex items-center gap-2 px-6 py-3 rounded-lg font-semibold text-sm transition-all hover:shadow-lg"
         style="background: white; color: #0d6efd;">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
          <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
        </svg>
        <?= htmlspecialchars($t['contact_btn_li']) ?>
      </a>
      <a href="https://github.com/matejbujnak" target="_blank" rel="noopener"
         class="inline-flex items-center gap-2 px-6 py-3 rounded-lg font-semibold text-sm transition-all hover:bg-white/10"
         style="border: 2px solid rgba(255,255,255,0.6); color: white;">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61-.546-1.385-1.335-1.755-1.335-1.755-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
        </svg>
        <?= htmlspecialchars($t['contact_btn_gh']) ?>
      </a>
    </div>

  </div>
</section>
