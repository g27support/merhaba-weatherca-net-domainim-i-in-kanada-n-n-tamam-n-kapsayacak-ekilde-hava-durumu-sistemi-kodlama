<?php
/** @var array $posts */
/** @var string $lang */
?>

<section class="bg-navy-dark py-20 text-white">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tighter mb-4">
            <?= $lang == 'en' ? 'Canada Weather <span class="text-canada-red">Blog</span>' : 'Blogue <span class="text-canada-red">Météo</span> Canada' ?>
        </h1>
        <p class="text-xl opacity-60 max-w-2xl">
            <?= $lang == 'en' ? 'Stay updated with the latest meteorological reports, climate news, and local safety updates across Canada.' : 'Restez informé des derniers rapports météorologiques, des actualités climatiques et des mises à jour de sécurité locale à travers le Canada.' ?>
        </p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 py-20">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($posts as $post): ?>
            <?php include __DIR__ . '/../partials/blog-card.php'; ?>
        <?php endforeach; ?>
    </div>
</div>
