<?php
/** @var array $post */
/** @var string $lang */
$title = ($lang == 'en' ? $post['title_en'] : $post['title_fr']);
$content = ($lang == 'en' ? $post['content_en'] : $post['content_fr']);
$cat = ($lang == 'en' ? $post['cat_name_en'] : $post['cat_name_fr']);
?>

<article class="max-w-4xl mx-auto px-4 py-20">
    <header class="text-center mb-16">
        <div class="flex items-center justify-center gap-4 mb-6">
            <span class="text-xs font-black text-canada-red uppercase tracking-widest bg-red-50 px-4 py-1.5 rounded-full"><?= $cat ?></span>
            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest"><?= date('F d, Y', strtotime($post['created_at'])) ?></span>
        </div>
        <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tighter leading-tight mb-8">
            <?= $title ?>
        </h1>
        <?php if ($post['featured_image']): ?>
            <div class="rounded-[2.5rem] overflow-hidden shadow-2xl aspect-[21/9]">
                <img src="<?= $post['featured_image'] ?>" alt="<?= $title ?>" class="w-full h-full object-cover">
            </div>
        <?php endif; ?>
    </header>

    <div class="prose prose-lg prose-slate max-w-none prose-headings:uppercase prose-headings:font-black prose-a:text-canada-red">
        <?= nl2br($content) ?>
    </div>

    <footer class="mt-20 pt-10 border-t border-slate-200">
        <div class="bg-slate-900 rounded-[2.5rem] p-10 text-white flex flex-col md:flex-row items-center justify-between gap-8">
            <div>
                <h4 class="text-2xl font-black uppercase mb-2"><?= $lang == 'en' ? 'Helpful Update?' : 'Mise à jour utile ?' ?></h4>
                <p class="text-slate-400"><?= $lang == 'en' ? 'Share this weather report with your community.' : 'Partagez ce rapport météo avec votre communauté.' ?></p>
            </div>
            <div class="flex gap-4">
                <button class="bg-white text-slate-900 px-8 py-3 rounded-xl font-black uppercase text-xs hover:bg-canada-red hover:text-white transition">Share Post</button>
            </div>
        </div>
    </footer>
</article>
