<?php
/** @var array $guides */
/** @var array $config */
?>
<div class="flex justify-between items-center mb-10">
    <h1 class="text-3xl font-black uppercase tracking-tighter">Guides</h1>
    <a href="/<?= $config['site']['admin_path'] ?>/guides/create" class="bg-sapphire text-white px-6 py-3 rounded-xl font-black uppercase text-xs hover:bg-white hover:text-slate-900 transition">New Guide</a>
</div>

<div class="bg-slate-800 rounded-[2rem] border border-slate-700 overflow-hidden shadow-xl">
    <table class="w-full text-left">
        <thead class="bg-slate-700/50 border-b border-slate-700 text-[10px] uppercase font-black text-slate-500 tracking-widest">
            <tr>
                <th class="p-6">Title</th>
                <th class="p-6">Type</th>
                <th class="p-6">Sticky</th>
                <th class="p-6 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-700 text-sm">
            <?php foreach ($guides as $guide): ?>
            <tr class="hover:bg-slate-700/30 transition">
                <td class="p-6">
                    <div class="font-bold"><?= $guide['title_en'] ?></div>
                    <div class="text-[10px] text-slate-500 font-mono mt-1"><?= $guide['slug'] ?></div>
                </td>
                <td class="p-6">
                    <span class="text-[9px] font-black uppercase px-2 py-1 rounded bg-slate-700 text-slate-300 border border-slate-600">
                        <?= $guide['guide_type'] ?>
                    </span>
                </td>
                <td class="p-6">
                    <?php if ($guide['is_sticky']): ?>
                        <span class="text-green-500">Yes</span>
                    <?php else: ?>
                        <span class="text-slate-500">No</span>
                    <?php endif; ?>
                </td>
                <td class="p-6 text-right">
                    <div class="flex justify-end gap-2">
                        <a href="#" class="p-2 hover:bg-slate-600 rounded-lg transition uppercase font-black text-[10px]">Edit</a>
                        <a href="#" class="p-2 hover:bg-red-500 transition rounded-lg text-white uppercase font-black text-[10px]">Del</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
