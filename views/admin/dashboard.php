<?php
/** @var array $stats */
/** @var array $config */
?>
<header class="flex justify-between items-center mb-12">
    <div>
        <h1 class="text-4xl font-black uppercase tracking-tighter">Dashboard</h1>
        <p class="text-slate-500">Welcome to WeatherCA.net management console.</p>
    </div>
    <div class="flex gap-4">
        <a href="/" target="_blank" class="bg-white text-slate-900 px-6 py-3 rounded-xl font-black uppercase text-xs hover:bg-canada-red hover:text-white transition">View Site</a>
    </div>
</header>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
    <div class="bg-slate-800 p-8 rounded-[2rem] border border-slate-700 shadow-xl">
        <div class="text-[10px] font-black uppercase text-slate-500 tracking-widest mb-2">Total Cities</div>
        <div class="text-5xl font-black"><?= $stats['cities'] ?></div>
    </div>
    <div class="bg-slate-800 p-8 rounded-[2rem] border border-slate-700 shadow-xl">
        <div class="text-[10px] font-black uppercase text-slate-500 tracking-widest mb-2">Blog Posts</div>
        <div class="text-5xl font-black"><?= $stats['articles'] ?></div>
    </div>
    <div class="bg-slate-800 p-8 rounded-[2rem] border border-slate-700 shadow-xl">
        <div class="text-[10px] font-black uppercase text-slate-500 tracking-widest mb-2">Guides</div>
        <div class="text-5xl font-black"><?= $stats['guides'] ?></div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-slate-800 rounded-[2rem] border border-slate-700 p-8">
        <h3 class="text-xl font-black uppercase mb-6">Quick Actions</h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="/<?= $config['site']['admin_path'] ?>/blog/create" class="bg-slate-700 p-6 rounded-2xl hover:bg-canada-red transition group">
                <div class="font-bold mb-1">New Blog Post</div>
                <div class="text-[10px] text-slate-400 group-hover:text-white uppercase font-black">Create →</div>
            </a>
            <a href="/<?= $config['site']['admin_path'] ?>/guides/create" class="bg-slate-700 p-6 rounded-2xl hover:bg-sapphire transition group">
                <div class="font-bold mb-1">New Guide</div>
                <div class="text-[10px] text-slate-400 group-hover:text-white uppercase font-black">Create →</div>
            </a>
        </div>
    </div>
    
    <div class="bg-slate-800 rounded-[2rem] border border-slate-700 p-8">
        <h3 class="text-xl font-black uppercase mb-6">System Status</h3>
        <div class="space-y-4">
            <div class="flex justify-between items-center bg-slate-700/50 p-4 rounded-xl">
                <span class="text-sm font-bold">API Connectivity</span>
                <span class="text-[10px] bg-green-500 text-white px-2 py-1 rounded font-black uppercase">Online</span>
            </div>
            <div class="flex justify-between items-center bg-slate-700/50 p-4 rounded-xl">
                <span class="text-sm font-bold">Database Health</span>
                <span class="text-[10px] bg-green-500 text-white px-2 py-1 rounded font-black uppercase">Perfect</span>
            </div>
        </div>
    </div>
</div>
