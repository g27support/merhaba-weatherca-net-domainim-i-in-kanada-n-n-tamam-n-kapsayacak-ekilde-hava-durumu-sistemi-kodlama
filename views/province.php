<?php
/** @var array $province */
/** @var array $cities */
/** @var string $lang */
?>

<div class="max-w-7xl mx-auto px-4 py-12">
    <nav class="flex mb-8 text-[10px] font-black uppercase tracking-widest text-slate-400">
        <a href="/" class="hover:text-canada-red transition">Canada</a>
        <span class="mx-2">/</span>
        <span class="text-slate-900"><?= $lang == 'en' ? $province['name_en'] : $province['name_fr'] ?></span>
    </nav>

    <div class="mb-12">
        <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tighter">
            Weather in <span class="text-canada-red"><?= $lang == 'en' ? $province['name_en'] : $province['name_fr'] ?></span>
        </h1>
        <p class="text-xl text-slate-500 mt-4 max-w-2xl">
            Real-time weather conditions and forecasts for all communities across <?= $lang == 'en' ? $province['name_en'] : $province['name_fr'] ?>.
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php foreach ($cities as $city): ?>
            <a href="/weather/<?= $province['slug'] ?>/<?= $city['slug'] ?>" class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl hover:border-canada-red transition">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-black uppercase"><?= $lang == 'en' ? $city['name_en'] : $city['name_fr'] ?></h3>
                    <?php if (isset($city['temp'])): ?>
                        <span class="text-xl font-light"><?= round($city['temp']) ?>°</span>
                    <?php endif; ?>
                </div>
                <div class="mt-4 flex items-center gap-2">
                    <?php if (isset($city['condition_code'])): ?>
                        <img src="https://openweathermap.org/img/wn/<?= $city['condition_code'] ?>.png" class="w-8 h-8" alt="Weather">
                    <?php endif; ?>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">View Details →</span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
