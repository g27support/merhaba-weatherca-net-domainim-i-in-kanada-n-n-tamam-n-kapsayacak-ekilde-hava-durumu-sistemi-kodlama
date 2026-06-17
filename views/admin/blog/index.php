<?php
/** @var array $posts */
/** @var array $config */
?>
<div class="flex justify-between items-center mb-10">
    <h1 class="text-3xl font-black uppercase tracking-tighter">Blog Posts</h1>
    <a href="/<?= $config['site']['admin_path'] ?>/blog/create" class="bg-canada-red text-white px-6 py-3 rounded-xl font-black uppercase text-xs hover:bg-white hover:text-slate-900 transition">New Post</a>
</div>

<div class="bg-slate-800 rounded-[2rem] border border-slate-700 overflow-hidden shadow-2xl">
    <table class="w-full text-left">
        <thead class="bg-slate-700/50 border-b border-slate-700 text-[10px] uppercase font-black text-slate-500 tracking-widest">
            <tr>
                <th class="p-6">Title</th>
                <th class="p-6">Category</th>
                <th class="p-6">Status</th>
                <th class="p-6">Date</th>
                <th class="p-6 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-700">
            <?php foreach ($posts as $post): ?>
            <tr class="hover:bg-slate-700/30 transition">
                <td class="p-6">
                    <div class="font-bold"><?= $post['title_en'] ?></div>
                    <div class="text-[10px] text-slate-500 font-mono mt-1"><?= $post['slug'] ?></div>
                </td>
                <td class="p-6 text-sm"><?= $post['cat_name'] ?></td>
                <td class="p-6">
                    <span class="text-[9px] font-black uppercase px-2 py-1 rounded <?= $post['status'] == 'published' ? 'bg-green-500/20 text-green-500' : 'bg-orange-500/20 text-orange-500' ?>">
                        <?= $post['status'] ?>
                    </span>
                </td>
                <td class="p-6 text-xs text-slate-400 font-bold"><?= date('M d, Y', strtotime($post['created_at'])) ?></td>
                <td class="p-6 text-right">
                    <div class="flex justify-end gap-2">
                        <a href="#" class="p-2 hover:bg-slate-600 rounded-lg transition">Edit</a>
                        <a href="#" class="p-2 hover:bg-red-500 transition rounded-lg text-white">Del</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
