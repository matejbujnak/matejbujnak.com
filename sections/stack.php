<section id="stack" style="padding: 100px 0; background: #fff;">
  <div class="max-w-6xl mx-auto px-6">

    <div class="text-center mb-16">
      <span class="inline-block text-sm font-mono font-semibold text-blue-600 tracking-widest uppercase mb-3">
        <?= htmlspecialchars($t['stack_tag']) ?>
      </span>
      <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
        <?= htmlspecialchars($t['stack_title']) ?>
      </h2>
      <p class="text-lg text-gray-500 max-w-2xl mx-auto">
        <?= htmlspecialchars($t['stack_subtitle']) ?>
      </p>
    </div>

    <?php
    $stackCategories = [
      ['label' => $t['stack_cat1'], 'icon' => '⚙️', 'items' => ['Python', 'C++', 'JavaScript', 'TypeScript']],
      ['label' => $t['stack_cat2'], 'icon' => '📊', 'items' => ['Pandas', 'Scikit-learn', 'XGBoost', 'LightGBM', 'CatBoost', 'FastAPI', 'Web Scraping', 'ETL']],
      ['label' => $t['stack_cat3'], 'icon' => '☁️', 'items' => ['Node.js', 'AWS (S3, Lambda, CloudWatch)', 'SQL', 'MySQL', 'PostgreSQL', 'MongoDB', 'Express', 'PHP']],
      ['label' => $t['stack_cat4'], 'icon' => '🖥️', 'items' => ['Next.js', 'React.js', 'Vue.js', 'Tailwind CSS', 'Git', 'Linux']],
    ];
    ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
      <?php foreach ($stackCategories as $cat): ?>
        <div class="rounded-2xl p-6 border border-gray-100 hover:border-blue-200 hover:shadow-lg transition-all duration-300 bg-white">
          <div class="flex items-center gap-2 mb-4">
            <span class="text-xl"><?= $cat['icon'] ?></span>
            <h3 class="font-bold text-gray-900"><?= htmlspecialchars($cat['label']) ?></h3>
          </div>
          <div class="flex flex-wrap gap-2">
            <?php foreach ($cat['items'] as $tech): ?>
              <span class="px-3 py-1 rounded-full text-xs font-mono font-medium text-blue-700"
                    style="background: #eff6ff; border: 1px solid #bfdbfe;">
                <?= htmlspecialchars($tech) ?>
              </span>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
