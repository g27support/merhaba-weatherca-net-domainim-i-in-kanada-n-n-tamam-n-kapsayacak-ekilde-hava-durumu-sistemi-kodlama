<?php
require_once "../config/config.php";

$slug = isset($_GET["slug"]) ? $_GET["slug"] : "";
$stmt = $db->prepare("SELECT * FROM content WHERE slug = ? AND lang = ?");
$stmt->execute([$slug, $lang]);
$article = $stmt->fetch();

if (!$article) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo $article["title"]; ?> - WeatherCA.net</title>
    <meta name="description" content="<?php echo $article["meta_desc"]; ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>.bg-canada-red { background-color: #EF3340; }</style>
</head>
<body class="bg-slate-50">
    <nav class="bg-white border-b border-slate-200 p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="index.php" class="text-xl font-bold">Weather<span class="text-canada-red">CA</span></a>
        </div>
    </nav>

    <article class="max-w-4xl mx-auto px-4 py-16">
        <header class="mb-12">
            <span class="text-canada-red font-bold uppercase tracking-widest text-sm"><?php echo strtoupper($article["type"]); ?></span>
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 mt-4 leading-tight"><?php echo $article["title"]; ?></h1>
            <div class="flex items-center gap-4 mt-6 text-slate-500">
                <span>Published: <?php echo date("F d, Y", strtotime($article["created_at"])); ?></span>
            </div>
        </header>

        <div class="prose prose-lg prose-slate max-w-none leading-relaxed text-slate-700">
            <?php echo nl2br($article["body"]); ?>
        </div>
        
        <footer class="mt-16 pt-8 border-t border-slate-200">
            <div class="bg-slate-100 p-8 rounded-2xl flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-lg">Helpful Guide?</h3>
                    <p class="text-slate-600">Share this weather information with your friends in Canada.</p>
                </div>
                <div class="flex gap-2">
                    <button class="bg-white px-4 py-2 rounded-lg border border-slate-300 font-bold text-sm">Share</button>
                </div>
            </div>
        </footer>
    </article>
</body>
</html>