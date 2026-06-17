<?php
/** @var array $city */
/** @var array $current */
/** @var array $forecast */
/** @var string $lang */
?>

<div class="max-w-7xl mx-auto px-4 py-12">
    <!-- Breadcrumbs -->
    <nav class="flex mb-8 text-[10px] font-black uppercase tracking-widest text-slate-400">
        <a href="/" class="hover:text-canada-red transition">Canada</a>
        <span class="mx-2">/</span>
        <a href="/weather/<?= $city['province_slug'] ?>" class="hover:text-canada-red transition"><?= $lang == 'en' ? $city['province_en'] : $city['province_fr'] ?></a>
        <span class="mx-2">/</span>
        <span class="text-slate-900"><?= $lang == 'en' ? $city['name_en'] : $city['name_fr'] ?></span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Weather Card -->
        <div class="lg:col-span-2">
            <div class="bg-navy-dark rounded-[2.5rem] text-white overflow-hidden shadow-2xl relative">
                <div class="p-8 md:p-12 relative z-10 flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <h1 class="text-5xl md:text-7xl font-black mb-2 leading-none uppercase">
                            <?= $lang == 'en' ? $city['name_en'] : $city['name_fr'] ?>
                        </h1>
                        <p class="text-xl opacity-60 font-bold tracking-widest uppercase"><?= $lang == 'en' ? $city['province_en'] : $city['province_fr'] ?>, Canada</p>
                        
                        <div class="mt-12 flex items-center gap-8">
                            <span class="text-7xl md:text-9xl font-light"><?= round($current['temp'] ?? 0) ?>°<span class="text-3xl align-top mt-4 inline-block">C</span></span>
                            <div>
                                <p class="text-2xl font-bold"><?= $current['condition_text_' . $lang] ?? '' ?></p>
                                <p class="text-slate-400 font-medium"><?= $lang == 'en' ? 'Feels like' : 'Ressenti' ?> <?= round($current['feels_like'] ?? 0) ?>°</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 md:mt-0">
                        <img src="https://openweathermap.org/img/wn/<?= $current['condition_code'] ?? '01d' ?>@4x.png" alt="Weather Icon" class="w-48 h-48 drop-shadow-2xl">
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 border-t border-white/10 bg-white/5">
                    <div class="p-6 text-center border-r border-white/10">
                        <p class="text-[10px] font-black uppercase text-slate-400 mb-1"><?= $lang == 'en' ? 'Wind' : 'Vent' ?></p>
                        <p class="text-xl font-bold"><?= round($current['wind_speed'] ?? 0) ?> <span class="text-xs">km/h</span></p>
                    </div>
                    <div class="p-6 text-center border-r border-white/10">
                        <p class="text-[10px] font-black uppercase text-slate-400 mb-1">Humidity</p>
                        <p class="text-xl font-bold"><?= $current['humidity'] ?? 0 ?>%</p>
                    </div>
                    <div class="p-6 text-center border-r border-white/10">
                        <p class="text-[10px] font-black uppercase text-slate-400 mb-1">UV Index</p>
                        <p class="text-xl font-bold"><?= $current['uv_index'] ?? 0 ?></p>
                    </div>
                    <div class="p-6 text-center">
                        <p class="text-[10px] font-black uppercase text-slate-400 mb-1">Visibility</p>
                        <p class="text-xl font-bold"><?= round(($current['visibility'] ?? 0) / 1000) ?> <span class="text-xs">km</span></p>
                    </div>
                </div>
                
                <!-- Background Gradient Decor -->
                <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-canada-red/20 to-transparent pointer-events-none"></div>
            </div>

            <!-- Forecast Section -->
            <section class="mt-12">
                <h2 class="text-2xl font-black uppercase tracking-tighter mb-8"><?= $lang == 'en' ? '7-Day Forecast' : 'Prévisions sur 7 Jours' ?></h2>
                <div class="grid grid-cols-1 md:grid-cols-7 gap-4">
                    <?php foreach ($forecast as $day): ?>
                        <div class="bg-white p-6 rounded-3xl border border-slate-200 text-center flex flex-col items-center">
                            <span class="text-[10px] font-black text-slate-400 uppercase mb-1"><?= date('D', strtotime($day['forecast_date'])) ?></span>
                            <span class="text-xs font-bold mb-4"><?= date('M d', strtotime($day['forecast_date'])) ?></span>
                            <img src="https://openweathermap.org/img/wn/<?= $day['condition_code'] ?>.png" alt="Icon" class="w-12 h-12">
                            <div class="mt-4 font-black">
                                <span class="text-lg"><?= round($day['temp_max']) ?>°</span>
                                <span class="text-slate-400 text-xs ml-1"><?= round($day['temp_min']) ?>°</span>
                            </div>
                            <?php if ($day['pop'] > 20): ?>
                                <span class="mt-2 text-[9px] font-black text-sapphire uppercase"><?= $day['pop'] ?>% POP</span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>

        <!-- Sidebar / Ad Space -->
        <aside class="space-y-8">
            <div class="bg-slate-900 rounded-[2rem] p-8 text-white relative overflow-hidden group">
                <h3 class="text-xl font-black uppercase mb-4 relative z-10">Premium<br><span class="text-canada-red">Radar</span></h3>
                <p class="text-sm opacity-60 mb-6 relative z-10">Get hyper-local alerts and 15-day advanced insights for all Canadian provinces.</p>
                <button class="w-full bg-white text-slate-900 py-4 rounded-2xl font-black uppercase text-sm hover:bg-canada-red hover:text-white transition relative z-10">Go Premium</button>
                <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-canada-red/20 rounded-full blur-3xl group-hover:bg-canada-red/40 transition"></div>
            </div>
            
            <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem] p-8 flex items-center justify-center min-h-[250px]">
                <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Advertisement</p>
            </div>
        </aside>
    </div>
</div>
