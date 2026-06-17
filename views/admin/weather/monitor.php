<?php
/** @var array $cities */
?>
<div class="mb-12">
    <h1 class="text-4xl font-black uppercase tracking-tighter">Weather Data Monitor</h1>
    <p class="text-slate-500">Track the freshness of cached weather data across all cities.</p>
</div>

<div class="bg-slate-800 rounded-[2.5rem] border border-slate-700 overflow-hidden shadow-xl">
    <table class="w-full text-left">
        <thead class="bg-slate-700/50 border-b border-slate-700 text-[10px] uppercase font-black text-slate-500 tracking-widest">
            <tr>
                <th class="p-6">City</th>
                <th class="p-6">Province</th>
                <th class="p-6">Last Updated</th>
                <th class="p-6">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-700">
            <?php foreach ($cities as $city): ?>
            <tr class="hover:bg-slate-700/30 transition">
                <td class="p-6 font-bold text-slate-200"><?= $city['name_en'] ?></td>
                <td class="p-6 text-sm text-slate-400"><?= $city['province_code'] ?></td>
                <td class="p-6 text-xs font-mono">
                    <?= $city['updated_at'] ?? 'Never' ?>
                </td>
                <td class="p-6">
                    <?php if ($city['updated_at']): ?>
                        <?php if ($city['age_mins'] < 60): ?>
                            <span class="text-[9px] font-black uppercase px-2 py-1 rounded bg-green-500/20 text-green-500 border border-green-500/20">Fresh</span>
                        <?php elseif ($city['age_mins'] < 1440): ?>
                            <span class="text-[9px] font-black uppercase px-2 py-1 rounded bg-orange-500/20 text-orange-500 border border-orange-500/20">Stale</span>
                        <?php else: ?>
                            <span class="text-[9px] font-black uppercase px-2 py-1 rounded bg-red-500/20 text-red-500 border border-red-500/20">Outdated</span>
                        <?php endif; ?>
                        <span class="text-[10px] ml-2 text-slate-500"><?= $city['age_mins'] ?>m ago</span>
                    <?php else: ?>
                        <span class="text-[9px] font-black uppercase px-2 py-1 rounded bg-slate-500/20 text-slate-500 border border-slate-500/20">No Data</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
