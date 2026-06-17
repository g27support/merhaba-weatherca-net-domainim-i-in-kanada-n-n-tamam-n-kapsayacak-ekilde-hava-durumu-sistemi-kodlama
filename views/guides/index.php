<?php
/** @var array $guides */
/** @var string $lang */
?>

<section class="bg-sapphire py-20 text-white">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tighter mb-4">
            <?= $lang == 'en' ? 'Weather <span class="text-canada-red">Safety</span> Guides' : 'Guides de <span class="text-canada-red">Sécurité</span> Météo' ?>
        </h1>
        <p class="text-xl opacity-80 max-w-2xl mx-auto">
            <?= $lang == 'en' ? 'Expert advice on navigating Canada\'s diverse and sometimes extreme weather conditions.' : 'Conseils d\'experts pour naviguer dans les conditions météorologiques diverses et parfois extrêmes du Canada.' ?>
        </p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 py-20">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <?php foreach ($guides as $guide): ?>
            <a href="/guides/<?= $guide['slug'] ?>" class="group bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-2xl hover:border-canada-red transition duration-500">
                <div class="flex items-center gap-4 mb-6">
                    <span class="text-[10px] font-black text-canada-red uppercase tracking-widest bg-red-50 px-3 py-1 rounded-full"><?= $guide['guide_type'] ?></span>
                    <?php if ($guide['is_sticky']): ?>
                        <span class="text-[10px] font-black text-sapphire uppercase tracking-widest bg-blue-50 px-3 py-1 rounded-full">Essential</span>
                    <?php endif; ?>
                </div>
                <h3 class="text-3xl font-black mb-4 group-hover:text-canada-red transition"><?= $lang == 'en' ? $guide['title_en'] : $guide['title_fr'] ?></h3>
                <div class="flex items-center text-xs font-black uppercase tracking-widest mt-8">
                    <?= $lang == 'en' ? 'Open Guide' : 'Ouvrir le guide' ?> <span class="ml-2 group-hover:ml-4 transition-all">→</span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
