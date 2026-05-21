<section class="relative overflow-hidden min-h-screen flex items-center"
         style="background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%); color: white; padding-bottom: 80px;">

  <div class="max-w-6xl mx-auto px-6 w-full pt-24 pb-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

      <!-- Text -->
      <div>
        <h1 class="text-5xl sm:text-6xl font-bold mb-5 leading-tight"
            style="text-shadow: 0 2px 4px rgba(0,0,0,0.1);">
          Matej Bujňák
        </h1>
        <h2 class="text-2xl sm:text-3xl font-medium mb-5"
            style="color: rgba(255,255,255,0.95); text-shadow: 0 1px 3px rgba(0,0,0,0.1);">
          <?= htmlspecialchars($t['hero_subtitle']) ?>
        </h2>
        <p class="mb-8 max-w-lg"
           style="font-size: 1.15rem; line-height: 1.7; color: rgba(255,255,255,0.85);">
          <?= htmlspecialchars($t['hero_text_light']) ?>
        </p>

        <!-- Buttons -->
        <div class="flex flex-wrap gap-4 mb-10">
          <a href="#projects"
             class="inline-flex items-center gap-2 px-6 py-3 rounded-lg font-semibold text-sm transition-all"
             style="background: white; color: #0d6efd;">
            <?= htmlspecialchars($t['hero_btn_projects']) ?>
          </a>
          <a href="<?= htmlspecialchars($t['cv_file']) ?>" target="_blank"
             class="inline-flex items-center gap-2 px-6 py-3 rounded-lg font-semibold text-sm border-2 transition-all hover:bg-white/10"
             style="border-color: rgba(255,255,255,0.7); color: white;">
            <?= htmlspecialchars($t['hero_cv']) ?>
          </a>
        </div>

        <!-- Social icons -->
        <div class="flex items-center gap-5">
          <a href="https://github.com/matejbujnak" target="_blank" rel="noopener"
             class="social-icon" style="color: rgba(255,255,255,0.85);" aria-label="GitHub">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61-.546-1.385-1.335-1.755-1.335-1.755-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
            </svg>
          </a>
          <a href="https://www.linkedin.com/in/matejbujnak/" target="_blank" rel="noopener"
             class="social-icon" style="color: rgba(255,255,255,0.85);" aria-label="LinkedIn">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
            </svg>
          </a>
          <a href="mailto:bujnak.matko@gmail.com"
             class="social-icon" style="color: rgba(255,255,255,0.85);" aria-label="Email">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
          </a>
        </div>
      </div>

      <!-- Illustration -->
      <div class="hidden lg:flex justify-center items-center">
        <img src="/images/hero-illustration.svg"
             alt="Hero illustration"
             class="hero-img w-full max-w-md" />
      </div>

    </div>
  </div>

  <!-- Waves -->
  <div class="hero-waves">
    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
         viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
      <defs>
        <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"/>
      </defs>
      <g class="parallax">
        <use xlink:href="#gentle-wave" x="48" y="0"  fill="rgba(255,255,255,0.7)"/>
        <use xlink:href="#gentle-wave" x="48" y="3"  fill="rgba(255,255,255,0.5)"/>
        <use xlink:href="#gentle-wave" x="48" y="5"  fill="rgba(255,255,255,0.3)"/>
        <use xlink:href="#gentle-wave" x="48" y="7"  fill="#ffffff"/>
      </g>
    </svg>
  </div>

</section>
