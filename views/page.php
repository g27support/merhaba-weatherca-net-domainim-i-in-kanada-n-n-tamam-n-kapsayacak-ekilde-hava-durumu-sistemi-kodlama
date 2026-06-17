<?php
/** @var array $page */
/** @var string $lang */
$title = ($lang == 'en' ? $page['title_en'] : $page['title_fr']);
$body = ($lang == 'en' ? $page['body_en'] : $page['body_fr']);
?>

<div class="max-w-4xl mx-auto px-4 py-20">
    <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tighter leading-tight mb-16 text-center">
        <?= $title ?>
    </h1>

    <div class="prose prose-lg prose-slate max-w-none bg-white p-12 rounded-[2.5rem] border border-slate-100 shadow-sm">
        <?= nl2br($body) ?>
    </div>
</div>
