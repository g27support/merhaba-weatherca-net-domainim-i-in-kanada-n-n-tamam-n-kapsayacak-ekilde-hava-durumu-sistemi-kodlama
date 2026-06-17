<?php
/** @var array $featuredCities */
/** @var array $latestPosts */
/** @var string $lang */
?>

<!-- Hero Section with Search -->
<section class="bg-navy-dark py-24 text-white text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 relative z-10">
        <h1 class="text-4xl md:text-6xl font-black mb-6 leading-tight uppercase">
            <?= \App\Core\Lang::t('home.hero_title') ?>
        </h1>
        <p class="text-xl opacity-80 mb-10"><?= \App\Core\Lang::t('home.hero_subtitle') ?></p>
        
        <!-- Alpine.js Search -->
        <div x-data="{ query: '', results: [], loading: false }" class="relative max-w-xl mx-auto">
            <input 
                x-model="query" 
                @input.debounce.300ms="
                    if(query.length > 1) { 
                        loading = true; 
                        fetch('/api/search?q=' + query).then(r => r.json()).then(data => { results = data; loading = false; }); 
                    } else { results = []; }
                "
                type="text" 
                placeholder="<?= \App\Core\Lang::t('home.search_placeholder') ?>" 
                class="w-full py-5 px-8 rounded-full text-slate-900 shadow-2xl focus:outline-none focus:ring-4 focus:ring-canada-red/50 text-lg"
            >
            <div x-show="results.length > 0" class="absolute top-full left-0 right-0 bg-white mt-2 rounded-2xl shadow-2xl text-slate-900 overflow-hidden z-50 text-left border border-slate-200">
                <template x-for="item in results" :key="item.city_slug">
                    <a :href="(window.location.pathname.startsWith('/fr') ? '/fr' : '') + '/weather/' + item.province_slug + '/' + item.city_slug" class="block px-6 py-4 hover:bg-slate-50 border-b border-slate-100 last:border-0 transition flex justify-between items-center">
                        <div>
                            <span class="font-bold text-lg" x-text="<?= $lang == 'en' ? 'item.name_en' : 'item.name_fr' ?>"></span>
                            <span class="text-slate-400 text-sm ml-2" x-text="item.province_code"></span>
                        </div>
                        <span class="text-canada-red font-black">→</span>
                    </a>
                </template>
            </div>
        </div>
    </div>
    
    <!-- Background Decor -->
    <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
        <div class="absolute top-10 left-10 w-64 h-64 bg-canada-red rounded-full blur-[120px]"></div>
        <div class="absolute bottom-10 right-10 w-64 h-64 bg-sapphire rounded-full blur-[120px]"></div>
    </div>
</section>

<!-- Featured Cities Grid -->
<section class="max-w-7xl mx-auto px-4 py-20">
    <div class="flex justify-between items-end mb-10">
        <div>
            <h2 class="text-3xl font-black uppercase tracking-tighter"><?= \App\Core\Lang::t('home.major_centers') ?></h2>
            <div class="w-20 h-1 bg-canada-red mt-2"></div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($featuredCities as $city): ?>
            <a href="<?= $lang == 'fr' ? '/fr' : '' ?>/weather/<?= $city['province_slug'] ?>/<?= $city['slug'] ?>" class="group bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl hover:border-canada-red transition duration-300">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest"><?= $lang == 'en' ? $city['province_en'] : $city['province_fr'] ?></span>
                        <h3 class="text-2xl font-black group-hover:text-canada-red transition"><?= $lang == 'en' ? $city['name_en'] : $city['name_fr'] ?></h3>
                    </div>
                    <?php if (isset($city['temp'])): ?>
                        <div class="text-right">
                            <span class="text-3xl font-light"><?= round($city['temp']) ?>°</span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <span class="text-sm font-bold text-slate-500 uppercase"><?= \App\Core\Lang::t('home.view_forecast') ?></span>
                    <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center group-hover:bg-canada-red group-hover:text-white transition">
                        <span class="text-lg">→</span>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</section>
