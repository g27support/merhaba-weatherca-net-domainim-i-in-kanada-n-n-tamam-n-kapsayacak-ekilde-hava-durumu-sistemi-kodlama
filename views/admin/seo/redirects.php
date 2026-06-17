<?php
/** @var array $redirects */
/** @var array $config */
?>
<div class="mb-12">
    <h1 class="text-4xl font-black uppercase tracking-tighter">SEO & Redirects</h1>
    <p class="text-slate-500">Manage 301/302 redirects and SEO overrides.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Add Redirect Form -->
    <div class="lg:col-span-1">
        <div class="bg-slate-800 p-8 rounded-[2rem] border border-slate-700 shadow-xl sticky top-8">
            <h3 class="text-xl font-black uppercase mb-6 tracking-tighter">Add New Redirect</h3>
            <form action="/<?= $config['site']['admin_path'] ?>/seo/redirects/add" method="POST" class="space-y-4">
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-500 mb-1 tracking-widest">Old URL (Relative)</label>
                    <input type="text" name="old_url" placeholder="/old-path" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-canada-red outline-none" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-500 mb-1 tracking-widest">New URL (Relative or Abs)</label>
                    <input type="text" name="new_url" placeholder="/new-path" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-canada-red outline-none" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-500 mb-1 tracking-widest">HTTP Code</label>
                    <select name="http_code" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-canada-red outline-none">
                        <option value="301">301 (Permanent)</option>
                        <option value="302">302 (Temporary)</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-canada-red text-white py-4 rounded-xl font-black uppercase text-xs hover:bg-white hover:text-slate-900 transition mt-4">
                    Create Redirect
                </button>
            </form>
        </div>
    </div>

    <!-- Redirects Table -->
    <div class="lg:col-span-2">
        <div class="bg-slate-800 rounded-[2rem] border border-slate-700 overflow-hidden shadow-xl">
            <table class="w-full text-left">
                <thead class="bg-slate-700/50 border-b border-slate-700 text-[10px] uppercase font-black text-slate-500 tracking-widest">
                    <tr>
                        <th class="p-6">Old URL</th>
                        <th class="p-6">New URL</th>
                        <th class="p-6">Code</th>
                        <th class="p-6 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700 text-sm">
                    <?php foreach ($redirects as $r): ?>
                    <tr class="hover:bg-slate-700/30 transition">
                        <td class="p-6 font-mono text-slate-300"><?= $r['old_url'] ?></td>
                        <td class="p-6 font-mono text-canada-red"><?= $r['new_url'] ?></td>
                        <td class="p-6"><span class="bg-slate-700 px-2 py-1 rounded text-[10px] font-bold"><?= $r['http_code'] ?></span></td>
                        <td class="p-6 text-right">
                            <a href="/<?= $config['site']['admin_path'] ?>/seo/redirects/delete/<?= $r['id'] ?>" class="text-red-500 hover:text-white transition uppercase font-black text-[10px]" onclick="return confirm('Delete redirect?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
