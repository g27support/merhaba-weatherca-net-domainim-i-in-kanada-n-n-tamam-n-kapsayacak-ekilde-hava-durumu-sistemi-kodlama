<?php
/** @var array $guide */
/** @var string $lang */
$title = ($lang == 'en' ? $guide['title_en'] : $guide['title_fr']);
$content = ($lang == 'en' ? $guide['content_en'] : $guide['content_fr']);
?>

<div class="max-w-4xl mx-auto px-4 py-20">
    <nav class="flex mb-12 text-[10px] font-black uppercase tracking-widest text-slate-400">
        <a href="/" class="hover:text-canada-red transition">Home</a>
        <span class="mx-2">/</span>
        <a href="/guides" class="hover:text-canada-red transition">Guides</a>
        <span class="mx-2">/</span>
        <span class="text-slate-900"><?= $title ?></span>
    </nav>

    <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tighter leading-tight mb-12">
        <?= $title ?>
    </h1>

    <div class="prose prose-lg prose-slate max-w-none prose-headings:uppercase prose-headings:font-black prose-a:text-canada-red bg-white p-8 md:p-16 rounded-[3rem] border border-slate-100 shadow-sm">
        <?= nl2br($content) ?>
    </div>
    
    <div class="mt-20 bg-navy-dark rounded-[2.5rem] p-12 text-white text-center">
        <h3 class="text-3xl font-black uppercase mb-4"><?= $lang == 'en' ? 'Stay Safe' : 'Restez en sécurité' ?></h3>
        <p class="text-slate-400 max-w-xl mx-auto mb-8"><?= $lang == 'en' ? 'Check your local forecast daily for real-time alerts and safety notifications.' : 'Consultez quotidiennement vos prévisions locales pour des alertes en temps réel et des notifications de sécurité.' ?></p>
        <a href="/" class="inline-block bg-canada-red text-white px-10 py-4 rounded-full font-black uppercase tracking-widest hover:bg-white hover:text-slate-900 transition"><?= $lang == 'en' ? 'Check Forecast' : 'Vérifier les prévisions' ?></a>
    </div>
</div>
