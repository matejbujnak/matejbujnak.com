<section id="education" style="padding: 100px 0; background: #fff;">
  <div class="max-w-6xl mx-auto px-6">

    <div class="text-center mb-16">
      <span class="inline-block text-sm font-mono font-semibold text-blue-600 tracking-widest uppercase mb-3">
        <?= htmlspecialchars($t['edu_tag']) ?>
      </span>
      <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
        <?= htmlspecialchars($t['edu_title']) ?>
      </h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

      <!-- School card -->
      <div class="rounded-2xl p-8 border border-blue-100 shadow-sm shadow-blue-50"
           style="background: linear-gradient(135deg, #eff6ff 0%, #e0f2fe 100%);">

        <!-- Logo placeholder + name -->
        <div class="flex items-center gap-4 mb-6">
          <div class="w-14 h-14 rounded-xl flex items-center justify-center text-2xl shrink-0"
               style="background: linear-gradient(135deg, #0d6efd, #0dcaf0);">
            🎓
          </div>
          <div>
            <p class="font-bold text-gray-900 leading-snug"><?= htmlspecialchars($t['edu_school']) ?></p>
            <p class="text-sm text-gray-500 mt-0.5"><?= htmlspecialchars($t['edu_faculty']) ?></p>
          </div>
        </div>

        <!-- Degree + period -->
        <div class="flex items-center justify-between mb-6">
          <span class="text-sm font-semibold text-blue-700 bg-blue-100 px-3 py-1 rounded-full">
            <?= htmlspecialchars($t['edu_degree']) ?>
          </span>
          <span class="text-xs font-mono text-gray-400">
            <?= htmlspecialchars($t['edu_period']) ?>
          </span>
        </div>

        <!-- Note -->
        <p class="text-xs text-gray-500 italic border-t border-blue-100 pt-4">
          <?= htmlspecialchars($t['edu_note']) ?>
        </p>

      </div>

      <!-- Subjects -->
      <div>
        <p class="text-xs font-mono uppercase tracking-widest text-gray-400 mb-4">Key subjects</p>
        <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3">
          <?php
          $subjects = [
            $t['edu_li1'],
            $t['edu_li2'],
            $t['edu_li3'],
            $t['edu_li4'],
            $t['edu_li5'],
            $t['edu_li6'],
            $t['edu_li7'],
            $t['edu_li8'],
            $t['edu_li9'],
            $t['edu_li10'],
          ];
          foreach ($subjects as $subject):
          ?>
            <li class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 border border-gray-100 hover:border-blue-200 hover:bg-blue-50 transition-all duration-200">
              <span class="w-2 h-2 rounded-full shrink-0" style="background: linear-gradient(135deg, #0d6efd, #0dcaf0);"></span>
              <span class="text-sm text-gray-700"><?= htmlspecialchars($subject) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

    </div>
  </div>
</section>
