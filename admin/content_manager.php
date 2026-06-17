<?php
require_once "../config/config.php";
require_once "../includes/functions.php";
if (!isset($_SESSION["admin_logged_in"])) { header("Location: login.php"); exit; }

$action = isset($_GET["action"]) ? $_GET["action"] : "list";
$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $type = $_POST["type"];
    $lang_code = $_POST["lang"];
    $body = $_POST["body"];
    $meta_desc = $_POST["meta_desc"];
    $slug = empty($_POST["slug"]) ? createSlug($title) : createSlug($_POST["slug"]);

    if ($id > 0) {
        $stmt = $db->prepare("UPDATE content SET title=?, type=?, lang=?, body=?, slug=?, meta_desc=? WHERE id=?");
        $stmt->execute([$title, $type, $lang_code, $body, $slug, $meta_desc, $id]);
    } else {
        $stmt = $db->prepare("INSERT INTO content (title, type, lang, body, slug, meta_desc) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $type, $lang_code, $body, $slug, $meta_desc]);
    }
    header("Location: content_manager.php?msg=success");
    exit;
}

if ($action == "delete" && $id > 0) {
    $stmt = $db->prepare("DELETE FROM content WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: content_manager.php?msg=deleted");
    exit;
}

$article = ["title"=>"", "body"=>"", "type"=>"blog", "lang"=>"en", "slug"=>"", "meta_desc"=>""];
if ($id > 0) {
    $stmt = $db->prepare("SELECT * FROM content WHERE id = ?");
    $stmt->execute([$id]);
    $article = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Content - WeatherCA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 flex">

    <aside class="w-64 bg-slate-900 text-white min-h-screen p-6">
        <div class="text-xl font-black mb-10">Weather<span class="text-red-500">CA</span></div>
        <nav class="space-y-2 text-sm">
            <a href="index.php" class="block p-3 rounded-lg hover:bg-slate-800">Dashboard</a>
            <a href="content_manager.php" class="block p-3 rounded-lg bg-red-600 font-bold">Manage Content</a>
            <a href="logout.php" class="block p-3 text-slate-400">Logout</a>
        </nav>
    </aside>

    <main class="flex-1 p-10">
        <?php if ($action == "list"): ?>
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-black">Articles (Blog & Guides)</h1>
                <a href="content_manager.php?action=add" class="bg-slate-900 text-white px-4 py-2 rounded-lg font-bold">+ New Article</a>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 border-b border-slate-200 text-xs uppercase font-bold text-slate-500">
                        <tr>
                            <th class="p-4">Title</th>
                            <th class="p-4">Type</th>
                            <th class="p-4">Lang</th>
                            <th class="p-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php
                        $articles = $db->query("SELECT * FROM content ORDER BY id DESC")->fetchAll();
                        foreach($articles as $row):
                        ?>
                        <tr class="hover:bg-slate-50">
                            <td class="p-4 font-bold"><?php echo $row["title"]; ?></td>
                            <td class="p-4"><span class="px-2 py-1 rounded text-xs font-bold <?php echo $row["type"]=="guide" ? "bg-blue-100 text-blue-700":"bg-green-100 text-green-700"; ?>"><?php echo strtoupper($row["type"]); ?></span></td>
                            <td class="p-4 text-sm"><?php echo strtoupper($row["lang"]); ?></td>
                            <td class="p-4 flex gap-2">
                                <a href="content_manager.php?action=edit&id=<?php echo $row["id"]; ?>" class="text-blue-600 hover:underline">Edit</a>
                                <a href="content_manager.php?action=delete&id=<?php echo $row["id"]; ?>" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>
            <h1 class="text-2xl font-black mb-8"><?php echo $id > 0 ? "Edit Article" : "Add New Article"; ?></h1>
            <form method="POST" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 space-y-6">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase mb-2">Title</label>
                        <input type="text" name="title" value="<?php echo $article["title"]; ?>" class="w-full p-3 rounded-lg border border-slate-300 outline-none focus:ring-2 focus:ring-red-500" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase mb-2">Slug (SEO URL)</label>
                        <input type="text" name="slug" value="<?php echo $article["slug"]; ?>" placeholder="auto-generated if empty" class="w-full p-3 rounded-lg border border-slate-300 outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase mb-2">Type</label>
                        <select name="type" class="w-full p-3 rounded-lg border border-slate-300">
                            <option value="blog" <?php echo $article["type"]=="blog"?"selected":""; ?>>Blog Post</option>
                            <option value="guide" <?php echo $article["type"]=="guide"?"selected":""; ?>>Weather Guide</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase mb-2">Language</label>
                        <select name="lang" class="w-full p-3 rounded-lg border border-slate-300">
                            <option value="en" <?php echo $article["lang"]=="en"?"selected":""; ?>>English</option>
                            <option value="fr" <?php echo $article["lang"]=="fr"?"selected":""; ?>>Français</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase mb-2">Meta Description (SEO)</label>
                    <textarea name="meta_desc" rows="2" class="w-full p-3 rounded-lg border border-slate-300 outline-none focus:ring-2 focus:ring-red-500"><?php echo $article["meta_desc"]; ?></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase mb-2">Content (HTML allowed)</label>
                    <textarea name="body" rows="10" class="w-full p-3 rounded-lg border border-slate-300 outline-none focus:ring-2 focus:ring-red-500"><?php echo $article["body"]; ?></textarea>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-slate-900 text-white px-8 py-3 rounded-xl font-bold">Save Article</button>
                    <a href="content_manager.php" class="bg-slate-100 px-8 py-3 rounded-xl font-bold">Cancel</a>
                </div>
            </form>
        <?php endif; ?>
    </main>

</body>
</html>