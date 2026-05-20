<?php
require_once 'includes/header.php';
?>

<!-- ===== HERO ===== -->
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
          <a href="mailto:matej@matejbujnak.com"
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

<main>

<!-- ===== PROJECTS ===== -->
<section id="projects" style="padding: 100px 0; background: #fff;">
  <div class="max-w-6xl mx-auto px-6">

    <!-- Section header -->
    <div class="text-center mb-16">
      <span class="inline-block text-sm font-mono font-semibold text-blue-600 tracking-widest uppercase mb-3">
        <?= htmlspecialchars($t['proj_tag']) ?>
      </span>
      <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
        <?= htmlspecialchars($t['proj_title']) ?>
      </h2>
      <p class="text-lg text-gray-500 max-w-2xl mx-auto">
        <?= htmlspecialchars($t['proj_subtitle']) ?>
      </p>
    </div>

    <!-- Problem & Goal -->
    <div class="rounded-2xl p-8 mb-8" style="background: linear-gradient(135deg, #eff6ff 0%, #e0f2fe 100%); border: 1px solid #bfdbfe;">
      <div class="flex items-start gap-4">
        <span class="text-2xl mt-1">📊</span>
        <div>
          <h3 class="text-xl font-bold text-gray-900 mb-3"><?= htmlspecialchars($t['proj_prob_title']) ?></h3>
          <p class="text-gray-600 mb-3"><?= $t['proj_problem'] ?></p>
          <p class="text-gray-600"><?= $t['proj_goal'] ?></p>
        </div>
      </div>
    </div>

    <!-- 3 Phases -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

      <!-- Phase A -->
      <div class="rounded-2xl p-6 border border-gray-100 hover:border-blue-200 hover:shadow-lg transition-all duration-300" style="background: #fff;">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4 text-white font-bold text-sm"
             style="background: linear-gradient(135deg, #0d6efd, #0dcaf0);">A</div>
        <h4 class="font-bold text-gray-900 mb-1"><?= htmlspecialchars($t['proj_a_title']) ?></h4>
        <p class="text-xs font-mono text-blue-500 mb-3 uppercase tracking-wide"><?= htmlspecialchars($t['proj_a_phase']) ?></p>
        <ul class="text-sm text-gray-600 space-y-2">
          <li class="flex gap-2"><span class="text-blue-400 mt-0.5">▸</span> <?= htmlspecialchars($t['proj_a_li1']) ?></li>
          <li class="flex gap-2"><span class="text-blue-400 mt-0.5">▸</span> <?= htmlspecialchars($t['proj_a_li2']) ?></li>
          <li class="flex gap-2"><span class="text-blue-400 mt-0.5">▸</span> <?= htmlspecialchars($t['proj_a_li3']) ?></li>
        </ul>
        <div class="mt-4 pt-4 border-t border-gray-100">
          <span class="text-2xl font-bold text-gray-900">21 000</span>
          <span class="text-blue-500 font-bold">+</span>
          <span class="text-sm text-gray-500 ml-1"><?= htmlspecialchars($t['proj_a_stat']) ?></span>
        </div>
      </div>

      <!-- Phase B -->
      <div class="rounded-2xl p-6 border border-gray-100 hover:border-blue-200 hover:shadow-lg transition-all duration-300" style="background: #fff;">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4 text-white font-bold text-sm"
             style="background: linear-gradient(135deg, #0d6efd, #0dcaf0);">B</div>
        <h4 class="font-bold text-gray-900 mb-1"><?= htmlspecialchars($t['proj_b_title']) ?></h4>
        <p class="text-xs font-mono text-blue-500 mb-3 uppercase tracking-wide"><?= htmlspecialchars($t['proj_b_phase']) ?></p>
        <ul class="text-sm text-gray-600 space-y-2">
          <li class="flex gap-2"><span class="text-blue-400 mt-0.5">▸</span> <?= htmlspecialchars($t['proj_b_li1']) ?></li>
          <li class="flex gap-2"><span class="text-blue-400 mt-0.5">▸</span> <?= htmlspecialchars($t['proj_b_li2']) ?></li>
          <li class="flex gap-2"><span class="text-blue-400 mt-0.5">▸</span> <?= htmlspecialchars($t['proj_b_li3']) ?></li>
        </ul>
        <div class="mt-4 pt-4 border-t border-gray-100">
          <span class="text-sm text-gray-500"><?= htmlspecialchars($t['proj_b_stat']) ?></span>
        </div>
      </div>

      <!-- Phase C -->
      <div class="rounded-2xl p-6 border border-gray-100 hover:border-blue-200 hover:shadow-lg transition-all duration-300" style="background: #fff;">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4 text-white font-bold text-sm"
             style="background: linear-gradient(135deg, #0d6efd, #0dcaf0);">C</div>
        <h4 class="font-bold text-gray-900 mb-1"><?= htmlspecialchars($t['proj_c_title']) ?></h4>
        <p class="text-xs font-mono text-blue-500 mb-3 uppercase tracking-wide"><?= htmlspecialchars($t['proj_c_phase']) ?></p>
        <ul class="text-sm text-gray-600 space-y-2">
          <li class="flex gap-2"><span class="text-blue-400 mt-0.5">▸</span> <?= htmlspecialchars($t['proj_c_li1']) ?></li>
          <li class="flex gap-2"><span class="text-blue-400 mt-0.5">▸</span> <?= htmlspecialchars($t['proj_c_li2']) ?></li>
          <li class="flex gap-2"><span class="text-blue-400 mt-0.5">▸</span> <?= htmlspecialchars($t['proj_c_li3']) ?></li>
        </ul>
        <div class="mt-4 pt-4 border-t border-gray-100">
          <span class="text-2xl font-bold text-gray-900 font-mono">R²</span>
          <span class="text-2xl font-bold text-blue-500 font-mono"> 0.95</span>
        </div>
      </div>

    </div>

    <!-- Tech stack -->
    <div class="flex flex-wrap items-center gap-3 mb-10">
      <span class="text-sm font-semibold text-gray-500 mr-2"><?= htmlspecialchars($t['proj_stack_label']) ?></span>
      <?php foreach (['Python', 'BeautifulSoup', 'Scrapy', 'Pandas', 'NumPy', 'Scikit-learn', 'XGBoost', 'SQL'] as $tech): ?>
        <span class="px-3 py-1 rounded-full text-xs font-mono font-medium text-blue-700"
              style="background: #eff6ff; border: 1px solid #bfdbfe;">
          <?= $tech ?>
        </span>
      <?php endforeach; ?>
    </div>

    <!-- CTA buttons -->
    <div class="flex flex-wrap gap-4">
      <a href="https://github.com/matejbujnak" target="_blank" rel="noopener"
         class="inline-flex items-center gap-2 px-6 py-3 rounded-lg font-semibold text-sm transition-all hover:shadow-md"
         style="background: linear-gradient(135deg, #0d6efd, #0dcaf0); color: white;">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61-.546-1.385-1.335-1.755-1.335-1.755-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
        </svg>
        <?= htmlspecialchars($t['proj_btn_github']) ?>
      </a>
      <a href="/blog.php"
         class="inline-flex items-center gap-2 px-6 py-3 rounded-lg font-semibold text-sm border-2 border-blue-200 text-blue-600 hover:border-blue-400 hover:bg-blue-50 transition-all">
        <?= htmlspecialchars($t['proj_btn_blog']) ?>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
        </svg>
      </a>
    </div>

  </div>
</section>

<!-- ===== EXPERIENCE ===== -->
<section id="experience" style="padding: 100px 0; background: #f8fafc;">
  <div class="max-w-6xl mx-auto px-6">

    <!-- Header -->
    <div class="text-center mb-16">
      <span class="inline-block text-sm font-mono font-semibold text-blue-600 tracking-widest uppercase mb-3">
        <?= htmlspecialchars($t['exp_tag']) ?>
      </span>
      <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
        <?= htmlspecialchars($t['exp_title']) ?>
      </h2>
      <p class="text-lg text-gray-500 max-w-2xl mx-auto">
        <?= htmlspecialchars($t['exp_subtitle']) ?>
      </p>
    </div>

    <!-- Timeline -->
    <div class="relative">

      <!-- Vertical line -->
      <div class="hidden md:block absolute left-[calc(50%-1px)] top-0 bottom-0 w-0.5 bg-blue-100"></div>

      <?php
      $entries = [
        [
          'side'    => 'left',
          'icon'    => '🏢',
          'company' => $t['exp_datax_company'],
          'role'    => $t['exp_datax_role'],
          'type'    => $t['exp_datax_type'],
          'period'  => $t['exp_datax_period'],
          'stack'   => ['Node.js', 'MongoDB', 'AWS', 'PHP'],
          'items'   => [$t['exp_datax_li1'], $t['exp_datax_li2'], $t['exp_datax_li3']],
          'accent'  => false,
        ],
        [
          'side'    => 'right',
          'icon'    => '🏢',
          'company' => $t['exp_reactoo_company'],
          'role'    => $t['exp_reactoo_role'],
          'type'    => $t['exp_reactoo_type'],
          'period'  => $t['exp_reactoo_period'],
          'stack'   => ['Node.js', 'AWS', 'Linux', 'JavaScript'],
          'items'   => [$t['exp_reactoo_li1'], $t['exp_reactoo_li2'], $t['exp_reactoo_li3']],
          'accent'  => false,
        ],
        [
          'side'    => 'left',
          'icon'    => '🧪',
          'company' => $t['exp_oss_company'],
          'role'    => $t['exp_oss_role'],
          'type'    => $t['exp_oss_type'],
          'period'  => $t['exp_oss_period'],
          'stack'   => ['Python', 'FastAPI', 'Next.js', 'TypeScript', 'Chrome API'],
          'items'   => [$t['exp_oss_li1'], $t['exp_oss_li2'], $t['exp_oss_li3']],
          'accent'  => true,
        ],
      ];

      foreach ($entries as $e):
        $isLeft = $e['side'] === 'left';
      ?>
      <div class="relative flex flex-col md:flex-row items-start md:items-center gap-6 mb-12">

        <!-- Dot on timeline -->
        <div class="hidden md:flex absolute left-1/2 -translate-x-1/2 w-4 h-4 rounded-full border-2 border-blue-400 bg-white z-10"></div>

        <!-- Card — left side -->
        <div class="w-full md:w-[calc(50%-2rem)] <?= $isLeft ? 'md:pr-8' : 'md:order-last md:pl-8' ?>">
          <div class="rounded-2xl p-6 bg-white border transition-all duration-300
                      <?= $e['accent'] ? 'border-blue-200 shadow-md shadow-blue-50' : 'border-gray-100 hover:border-blue-200 hover:shadow-lg' ?>">

            <!-- Header row -->
            <div class="flex items-start justify-between gap-3 mb-4">
              <div>
                <div class="flex items-center gap-2 mb-1">
                  <span><?= $e['icon'] ?></span>
                  <span class="font-bold text-gray-900"><?= htmlspecialchars($e['company']) ?></span>
                </div>
                <p class="text-sm font-semibold text-blue-600"><?= htmlspecialchars($e['role']) ?></p>
              </div>
              <div class="text-right shrink-0">
                <span class="inline-block text-xs font-mono px-2 py-1 rounded-full mb-1
                             <?= $e['accent'] ? 'bg-blue-50 text-blue-600' : 'bg-gray-100 text-gray-500' ?>">
                  <?= htmlspecialchars($e['type']) ?>
                </span>
                <p class="text-xs text-gray-400"><?= htmlspecialchars($e['period']) ?></p>
              </div>
            </div>

            <!-- Bullet points -->
            <ul class="text-sm text-gray-600 space-y-2 mb-4">
              <?php foreach ($e['items'] as $item): ?>
                <li class="flex gap-2">
                  <span class="text-blue-400 mt-0.5 shrink-0">▸</span>
                  <?= htmlspecialchars($item) ?>
                </li>
              <?php endforeach; ?>
            </ul>

            <!-- Stack chips -->
            <div class="flex flex-wrap gap-2">
              <?php foreach ($e['stack'] as $tech): ?>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-mono text-blue-700"
                      style="background: #eff6ff; border: 1px solid #bfdbfe;">
                  <?= htmlspecialchars($tech) ?>
                </span>
              <?php endforeach; ?>
            </div>

          </div>
        </div>

        <!-- Spacer — right side (empty) -->
        <div class="hidden md:block w-[calc(50%-2rem)] <?= $isLeft ? '' : 'md:order-first' ?>"></div>

      </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>

</main>

<?php require_once 'includes/footer.php'; ?>
