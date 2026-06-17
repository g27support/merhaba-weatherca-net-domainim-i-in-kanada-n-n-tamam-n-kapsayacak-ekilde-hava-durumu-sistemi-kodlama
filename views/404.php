<?php
/** @var string $lang */
?>
<div class="max-w-7xl mx-auto px-4 py-32 text-center">
    <h1 class="text-9xl font-black text-slate-200">404</h1>
    <p class="text-2xl font-bold mt-4 uppercase"><?= $lang == 'en' ? 'Page Not Found' : 'Page non trouvée' ?></p>
    <a href="/" class="inline-block mt-8 bg-canada-red text-white px-10 py-4 rounded-full font-black uppercase tracking-widest hover:bg-navy-dark transition">
        <?= $lang == 'en' ? 'Return Home' : 'Retour à l\'accueil' ?>
    </a>
</div>
