<?php
/** @var string $content */
/** @var array $seo */
/** @var string $lang */
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <?php include __DIR__ . '/../partials/seo-head.php'; ?>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Header / Navigation -->
    <nav class="bg-navy-dark text-white sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <a href="/" class="text-2xl font-black tracking-tighter">
                        WEATHER<span class="text-canada-red">CA</span>.NET
                    </a>
                </div>
                
                <div class="hidden md:flex items-center space-x-6 text-sm font-bold uppercase tracking-wider">
                    <a href="<?= $lang == 'fr' ? '/fr' : '' ?>/weather/ontario" class="hover:text-canada-red transition"><?= $lang == 'en' ? 'Ontario' : 'Ontario' ?></a>
                    <a href="<?= $lang == 'fr' ? '/fr' : '' ?>/weather/quebec" class="hover:text-canada-red transition"><?= $lang == 'en' ? 'Quebec' : 'Québec' ?></a>
                    <a href="<?= $lang == 'fr' ? '/fr' : '' ?>/blog" class="hover:text-canada-red transition"><?= \App\Core\Lang::t('nav.blog') ?></a>
                    <a href="<?= $lang == 'fr' ? '/fr' : '' ?>/guides" class="hover:text-canada-red transition"><?= \App\Core\Lang::t('nav.guides') ?></a>
                </div>

                <div class="flex items-center gap-4">
                    <div class="flex bg-navy-light p-1 rounded-full text-[10px] font-black">
                        <a href="/" class="px-3 py-1 rounded-full <?= $lang == 'en' ? 'bg-canada-red' : '' ?>">EN</a>
                        <a href="/fr" class="px-3 py-1 rounded-full <?= $lang == 'fr' ? 'bg-canada-red' : '' ?>">FR</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        <?= $content ?>
    </main>

    <!-- Footer -->
    <footer class="bg-navy-dark text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 border-b border-white/10 pb-12 mb-8">
                <div class="md:col-span-1">
                    <div class="text-xl font-black mb-4">WEATHER<span class="text-canada-red">CA</span>.NET</div>
                    <p class="text-sm text-slate-400">Premium Canadian weather forecasts, alerts, and travel guides. Bilingual & SEO optimized.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4 uppercase text-xs tracking-widest text-canada-red">Provinces</h4>
                    <ul class="text-sm space-y-2 text-slate-400">
                        <li><a href="/weather/ontario" class="hover:text-white">Ontario</a></li>
                        <li><a href="/weather/quebec" class="hover:text-white">Quebec</a></li>
                        <li><a href="/weather/british-columbia" class="hover:text-white">BC</a></li>
                        <li><a href="/weather/alberta" class="hover:text-white">Alberta</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4 uppercase text-xs tracking-widest text-canada-red">Resources</h4>
                    <ul class="text-sm space-y-2 text-slate-400">
                        <li><a href="/blog" class="hover:text-white">Weather Blog</a></li>
                        <li><a href="/guides" class="hover:text-white">Safety Guides</a></li>
                        <li><a href="/contact" class="hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4 uppercase text-xs tracking-widest text-canada-red">Legal</h4>
                    <ul class="text-sm space-y-2 text-slate-400">
                        <li><a href="/privacy" class="hover:text-white">Privacy Policy</a></li>
                        <li><a href="/terms" class="hover:text-white">Terms of Use</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center text-[10px] text-slate-500 uppercase tracking-[0.2em]">
                &copy; <?= date('Y') ?> WeatherCA.net - Managed by Antigravity AI
            </div>
        </div>
    </footer>

</body>
</html>
