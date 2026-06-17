<?php
require_once "../config/config.php";
if (!isset($_SESSION["admin_logged_in"])) { header("Location: login.php"); exit; }

$cityCount = $db->query("SELECT COUNT(*) FROM locations")->fetchColumn();
$articleCount = $db->query("SELECT COUNT(*) FROM content")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - WeatherCA Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: "Inter", sans-serif; }</style>
</head>
<body class="bg-slate-50 flex min-h-screen">

    <aside class="w-64 bg-slate-900 text-white p-6 hidden md:block">
        <div class="text-xl font-black mb-10">Weather<span class="text-red-500">CA</span></div>
        <nav class="space-y-2">
            <a href="index.php" class="block p-3 rounded-lg bg-red-600 font-bold">Dashboard</a>
            <a href="content_manager.php" class="block p-3 rounded-lg hover:bg-slate-800 transition">Manage Content</a>
            <a href="locations.php" class="block p-3 rounded-lg hover:bg-slate-800 transition">Locations</a>
            <a href="settings.php" class="block p-3 rounded-lg hover:bg-slate-800 transition">Settings</a>
            <div class="pt-10">
                <a href="logout.php" class="text-slate-400 text-sm hover:text-white">Logout</a>
            </div>
        </nav>
    </aside>

    <main class="flex-1 p-8 md:p-12">
        <header class="flex justify-between items-center mb-10">
            <h1 class="text-3xl font-black text-slate-900">Welcome, Administrator</h1>
            <a href="../public/index.php" target="_blank" class="bg-white border border-slate-300 px-4 py-2 rounded-lg text-sm font-bold">View Site</a>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                <p class="text-slate-500 font-bold text-xs uppercase tracking-widest">Total Locations</p>
                <p class="text-4xl font-black mt-2"><?php echo $cityCount; ?></p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                <p class="text-slate-500 font-bold text-xs uppercase tracking-widest">Blog & Guides</p>
                <p class="text-4xl font-black mt-2"><?php echo $articleCount; ?></p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                <p class="text-slate-500 font-bold text-xs uppercase tracking-widest">System Status</p>
                <p class="text-lg font-bold mt-2 text-green-600 flex items-center gap-2">
                    <span class="w-3 h-3 bg-green-600 rounded-full animate-pulse"></span> Online
                </p>
            </div>
        </div>

        <section class="mt-12">
            <h2 class="text-xl font-bold mb-6">Quick Actions</h2>
            <div class="flex gap-4">
                <a href="content_manager.php?action=add" class="bg-slate-900 text-white px-6 py-3 rounded-xl font-bold hover:bg-slate-800">Add New Article</a>
                <a href="settings.php" class="bg-white border border-slate-200 px-6 py-3 rounded-xl font-bold hover:bg-slate-50">SEO Settings</a>
            </div>
        </section>
    </main>

</body>
</html>