<?php
require_once 'includes/blog.php';
require_once 'includes/header.php';

$posts = get_posts($lang);
?>

<main>
<section style="padding: 100px 0; background: #fff;">
  <div class="max-w-3xl mx-auto px-6">

    <div class="text-center mb-16">
      <span class="inline-block text-sm font-mono font-semibold text-blue-600 tracking-widest uppercase mb-3">
        Blog
      </span>
      <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
        <?= htmlspecialchars($t['blog_title']) ?>
      </h1>
      <p class="text-gray-500 max-w-xl mx-auto">
        <?= htmlspecialchars($t['blog_subtitle']) ?>
      </p>
    </div>

    <?php if (empty($posts)): ?>
      <p class="text-center text-gray-400 py-16"><?= htmlspecialchars($t['blog_empty']) ?></p>
    <?php else: ?>
      <div class="space-y-4">
        <?php foreach ($posts as $post): ?>
          <a href="/post.php?slug=<?= urlencode($post['slug']) ?>"
             class="flex items-start justify-between gap-6 p-6 rounded-2xl border border-gray-100
                    hover:border-blue-200 hover:shadow-md transition-all duration-200 group">
            <div class="flex-1 min-w-0">
              <h2 class="text-base font-bold text-gray-900 group-hover:text-blue-600 transition-colors mb-1.5">
                <?= htmlspecialchars($post['title']) ?>
              </h2>
              <?php if ($post['description']): ?>
                <p class="text-sm text-gray-500 leading-relaxed mb-3">
                  <?= htmlspecialchars($post['description']) ?>
                </p>
              <?php endif; ?>
              <?php if ($post['tags']): ?>
                <div class="flex flex-wrap gap-1.5">
                  <?php foreach ($post['tags'] as $tag): ?>
                    <span class="text-xs font-mono bg-blue-50 text-blue-600 px-2 py-0.5 rounded">
                      <?= htmlspecialchars($tag) ?>
                    </span>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
            <span class="text-xs font-mono text-gray-400 shrink-0 mt-0.5">
              <?= htmlspecialchars($post['date']) ?>
            </span>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</section>
</main>

<?php require_once 'includes/footer.php'; ?>
