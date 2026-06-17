<?php
/** @var string $content */
/** @var string $admin_user */
/** @var string $admin_role */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | WeatherCA.net</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-800 border-r border-slate-700 flex flex-col">
        <div class="p-6">
            <div class="text-xl font-black uppercase tracking-tighter">
                Weather<span class="text-canada-red">CA</span> <span class="text-[10px] bg-slate-700 px-2 py-1 rounded">ADMIN</span>
            </div>
        </div>
        
        <nav class="flex-grow px-4 space-y-1">
            <a href="/<?= $config['site']['admin_path'] ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-700 transition font-bold text-sm">
                <span>Dashboard</span>
            </a>
            <div class="pt-4 pb-2 px-4 text-[10px] font-black uppercase text-slate-500 tracking-widest">Content</div>
            <a href="/<?= $config['site']['admin_path'] ?>/blog" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-700 transition font-bold text-sm">
                <span>Blog Posts</span>
            </a>
            <a href="/<?= $config['site']['admin_path'] ?>/guides" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-700 transition font-bold text-sm">
                <span>Guides</span>
            </a>
            <a href="/<?= $config['site']['admin_path'] ?>/pages" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-700 transition font-bold text-sm">
                <span>Static Pages</span>
            </a>
            
            <div class="pt-4 pb-2 px-4 text-[10px] font-black uppercase text-slate-500 tracking-widest">System</div>
            <a href="/<?= $config['site']['admin_path'] ?>/cities" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-700 transition font-bold text-sm">
                <span>Cities & Weather</span>
            </a>
            <a href="/<?= $config['site']['admin_path'] ?>/settings" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-700 transition font-bold text-sm">
                <span>Settings</span>
            </a>
            <a href="/<?= $config['site']['admin_path'] ?>/seo" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-700 transition font-bold text-sm">
                <span>SEO & Redirects</span>
            </a>
        </nav>

        <div class="p-6 border-t border-slate-700">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 rounded-full bg-canada-red flex items-center justify-center font-black text-xs uppercase">
                    <?= substr($_SESSION['admin_user'] ?? 'A', 0, 1) ?>
                </div>
                <div class="text-xs">
                    <div class="font-bold"><?= $_SESSION['admin_user'] ?? 'Admin' ?></div>
                    <div class="text-slate-500 uppercase"><?= $_SESSION['admin_role'] ?? 'Admin' ?></div>
                </div>
            </div>
            <a href="/<?= $config['site']['admin_path'] ?>/logout" class="block w-full bg-slate-700 text-center py-2 rounded-lg text-xs font-bold hover:bg-red-500 transition">Logout</a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow p-8 overflow-y-auto">
        <?= $content ?>
    </main>

</body>
</html>
