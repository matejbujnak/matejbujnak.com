<section id="about" style="padding: 80px 0; background: #fff;">
  <div class="max-w-6xl mx-auto px-6">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

      <!-- Text -->
      <div>
        <span class="inline-block text-sm font-mono font-semibold text-blue-600 tracking-widest uppercase mb-3">
          <?= htmlspecialchars($t['about_tag']) ?>
        </span>
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">
          <?= htmlspecialchars($t['about_title']) ?>
        </h2>
        <p class="text-gray-600 leading-relaxed mb-4">
          <?= htmlspecialchars($t['about_p1']) ?>
        </p>
        <p class="text-gray-600 leading-relaxed">
          <?= htmlspecialchars($t['about_p2']) ?>
        </p>
      </div>

      <!-- Quick facts -->
      <div class="grid grid-cols-2 gap-4">
        <?php
        $facts = [
          ['icon' => '📍', 'text' => $t['about_li1']],
          ['icon' => '🎓', 'text' => $t['about_li2']],
          ['icon' => '💼', 'text' => $t['about_li3']],
          ['icon' => '🟢', 'text' => $t['about_li4']],
        ];
        foreach ($facts as $fact):
        ?>
          <div class="rounded-2xl p-5 border border-gray-100 hover:border-blue-200 hover:shadow-md transition-all duration-300 bg-white">
            <span class="text-2xl mb-3 block"><?= $fact['icon'] ?></span>
            <p class="text-sm font-medium text-gray-700"><?= htmlspecialchars($fact['text']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>
