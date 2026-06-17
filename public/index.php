<?php require_once "../config/config.php"; ?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Canada - <?php echo __("latest_news"); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: "Inter", sans-serif; }
        .bg-canada-red { background-color: #EF3340; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-bold tracking-tight text-slate-900">Weather<span class="text-canada-red">CA</span>.net</span>
                </div>
                
                <div class="hidden md:flex space-x-8 text-sm font-medium">
                    <a href="#" class="text-slate-600 hover:text-canada-red">Forecast</a>
                    <a href="#" class="text-slate-600 hover:text-canada-red">Blog</a>
                    <a href="#" class="text-slate-600 hover:text-canada-red">Guides</a>
                </div>

                <div class="flex items-center gap-4">
                    <div class="flex bg-slate-100 p-1 rounded-lg text-xs">
                        <a href="?lang=en" class="px-3 py-1 <?php echo $lang=="en" ? "bg-white shadow rounded-md font-bold" : ""; ?>">EN</a>
                        <a href="?lang=fr" class="px-3 py-1 <?php echo $lang=="fr" ? "bg-white shadow rounded-md font-bold" : ""; ?>">FR</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <header class="bg-canada-red py-20 text-white text-center">
        <div class="max-w-3xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-6">Canada Weather Radar</h1>
            <form action="search.php" method="GET" class="relative">
                <input type="text" name="q" placeholder="<?php echo __("search_city"); ?>" class="w-full py-4 px-6 rounded-full text-slate-900 shadow-2xl focus:outline-none focus:ring-4 focus:ring-red-300">
                <button type="submit" class="absolute right-2 top-2 bg-slate-900 text-white px-6 py-2 rounded-full hover:bg-slate-800 transition">Search</button>
            </form>
            <div class="mt-4 flex flex-wrap justify-center gap-2 text-xs">
                <span>Trending:</span>
                <a href="city.php?slug=toronto-on" class="underline opacity-80 hover:opacity-100">Toronto</a>
                <a href="city.php?slug=montreal-qc" class="underline opacity-80 hover:opacity-100">Montreal</a>
                <a href="city.php?slug=vancouver-bc" class="underline opacity-80 hover:opacity-100">Vancouver</a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2 space-y-8">
                <section>
                    <h2 class="text-2xl font-bold mb-6 border-l-4 border-canada-red pl-4"><?php echo __("latest_news"); ?></h2>
                    <div class="grid grid-cols-1 gap-4">
                        <?php
                        $articles = $db->query("SELECT * FROM content WHERE lang = '$lang' ORDER BY created_at DESC LIMIT 5")->fetchAll();
                        foreach($articles as $art):
                        ?>
                        <a href="article.php?slug=<?php echo $art["slug"]; ?>" class="group bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
                            <span class="text-[10px] font-black text-canada-red uppercase tracking-widest"><?php echo $art["type"]; ?></span>
                            <h3 class="text-xl font-bold mt-1 group-hover:text-canada-red transition"><?php echo $art["title"]; ?></h3>
                            <p class="text-slate-500 mt-2 text-sm line-clamp-2"><?php echo $art["meta_desc"]; ?></p>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>
            
            <aside class="space-y-8">
                <div class="bg-slate-900 text-white p-6 rounded-xl">
                    <h3 class="text-lg font-bold mb-4 italic italic">Premium Features</h3>
                    <ul class="text-sm space-y-3 opacity-90">
                        <li>✓ Detailed UV Index</li>
                        <li>✓ 15-Day Advanced Forecast</li>
                        <li>✓ Historical Data Access</li>
                    </ul>
                    <button class="w-full mt-6 bg-white text-slate-900 font-bold py-2 rounded-lg">Go Premium</button>
                </div>
            </aside>
        </div>
    </main>

    <footer class="bg-white border-t border-slate-200 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 text-center text-slate-500 text-sm">
            <p>&copy; 2024 WeatherCA.net - All Rights Reserved. (Federal Weather Data Provided by Environment Canada)</p>
        </div>
    </footer>

</body>
</html>