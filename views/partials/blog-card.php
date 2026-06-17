<?php
/** @var array $post */
/** @var string $lang */
$title = ($lang == 'en' ? $post['title_en'] : $post['title_fr']);
$desc = ($lang == 'en' ? $post['meta_desc_en'] : $post['meta_desc_fr']);
$cat = ($lang == 'en' ? $post['cat_name_en'] : $post['cat_name_fr']);
?>
<div class="bg-white rounded-[2rem] border border-slate-200 overflow-hidden group hover:shadow-2xl transition duration-500">
    <?php if ($post['featured_image']): ?>
        <a href="/blog/<?= $post['slug'] ?>" class="block aspect-video overflow-hidden">
            <img src="<?= $post['featured_image'] ?>" alt="<?= $title ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        </a>
    <?php endif; ?>
    <div class="p-8">
        <div class="flex items-center gap-3 mb-4">
            <span class="text-[10px] font-black text-canada-red uppercase tracking-widest bg-red-50 px-3 py-1 rounded-full"><?= $cat ?></span>
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest"><?= date('M d, Y', strtotime($post['created_at'])) ?></span>
        </div>
        <h3 class="text-2xl font-black mb-4 group-hover:text-canada-red transition">
            <a href="/blog/<?= $post['slug'] ?>"><?= $title ?></a>
        </h3>
        <p class="text-slate-500 text-sm line-clamp-3 mb-6"><?= $desc ?></p>
        <a href="/blog/<?= $post['slug'] ?>" class="inline-flex items-center text-xs font-black uppercase tracking-widest group-hover:gap-3 transition-all">
            <?= $lang == 'en' ? 'Read More' : 'Lire la suite' ?> <span class="ml-2">→</span>
        </a>
    </div>
</div>
