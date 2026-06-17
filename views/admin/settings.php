<?php
/** @var array $settings */
/** @var string $success */
?>
<div class="mb-12">
    <h1 class="text-4xl font-black uppercase tracking-tighter">System Settings</h1>
    <p class="text-slate-500">Configure global site parameters and API integrations.</p>
</div>

<?php if ($success): ?>
    <div class="bg-green-500/10 text-green-500 p-6 rounded-2xl mb-8 border border-green-500/20 font-bold">
        <?= $success ?>
    </div>
<?php endif; ?>

<form method="POST" class="space-y-8 max-w-4xl">
    <div class="bg-slate-800 rounded-[2.5rem] border border-slate-700 overflow-hidden shadow-xl">
        <div class="p-8 border-b border-slate-700 bg-slate-700/30">
            <h3 class="text-xl font-black uppercase tracking-tighter">API Configuration</h3>
        </div>
        <div class="p-8 space-y-6">
            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">OpenWeatherMap API Key</label>
                <input type="text" name="settings[weather_api_key]" value="<?= $settings['weather_api_key'] ?? '' ?>" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 text-white focus:ring-2 focus:ring-canada-red outline-none">
            </div>
        </div>
    </div>

    <div class="bg-slate-800 rounded-[2.5rem] border border-slate-700 overflow-hidden shadow-xl">
        <div class="p-8 border-b border-slate-700 bg-slate-700/30">
            <h3 class="text-xl font-black uppercase tracking-tighter">General SEO</h3>
        </div>
        <div class="p-8 space-y-6">
            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Site Name (EN)</label>
                <input type="text" name="settings[site_name_en]" value="<?= $settings['site_name_en'] ?? 'WeatherCA.net' ?>" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 text-white focus:ring-2 focus:ring-canada-red outline-none">
            </div>
            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Site Name (FR)</label>
                <input type="text" name="settings[site_name_fr]" value="<?= $settings['site_name_fr'] ?? 'MétéoCA.net' ?>" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 text-white focus:ring-2 focus:ring-canada-red outline-none">
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="bg-canada-red text-white px-12 py-5 rounded-2xl font-black uppercase tracking-widest hover:bg-white hover:text-slate-900 transition duration-300 shadow-2xl">
            Save Changes
        </button>
    </div>
</form>
