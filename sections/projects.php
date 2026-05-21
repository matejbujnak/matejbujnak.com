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

    <!-- Tech stack chips -->
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
