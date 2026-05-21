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

        <!-- Card -->
        <div class="w-full md:w-[calc(50%-2rem)] <?= $isLeft ? 'md:pr-8' : 'md:order-last md:pl-8' ?>">
          <div class="rounded-2xl p-6 bg-white border transition-all duration-300
                      <?= $e['accent'] ? 'border-blue-200 shadow-md shadow-blue-50' : 'border-gray-100 hover:border-blue-200 hover:shadow-lg' ?>">

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

            <ul class="text-sm text-gray-600 space-y-2 mb-4">
              <?php foreach ($e['items'] as $item): ?>
                <li class="flex gap-2">
                  <span class="text-blue-400 mt-0.5 shrink-0">▸</span>
                  <?= htmlspecialchars($item) ?>
                </li>
              <?php endforeach; ?>
            </ul>

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

        <!-- Spacer -->
        <div class="hidden md:block w-[calc(50%-2rem)] <?= $isLeft ? '' : 'md:order-first' ?>"></div>

      </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>
