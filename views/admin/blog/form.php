<?php
/** @var array $categories */
/** @var array $post */
/** @var array $config */
$id = $post['id'] ?? 0;
?>
<div class="mb-10 flex justify-between items-center">
    <h1 class="text-3xl font-black uppercase tracking-tighter"><?= $id ? 'Edit' : 'Create' ?> Blog Post</h1>
    <a href="/<?= $config['site']['admin_path'] ?>/blog" class="text-slate-400 hover:text-white text-xs font-bold uppercase tracking-widest">← Back to list</a>
</div>

<form action="/<?= $config['site']['admin_path'] ?>/blog/save" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <input type="hidden" name="id" value="<?= $id ?>">
    
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-slate-800 p-8 rounded-[2rem] border border-slate-700 shadow-xl space-y-6">
            <div>
                <label class="block text-xs font-black uppercase text-slate-500 mb-2 tracking-widest">Title (EN)</label>
                <input type="text" name="title_en" value="<?= $post['title_en'] ?? '' ?>" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 text-white focus:ring-2 focus:ring-canada-red outline-none" required>
            </div>
            <div>
                <label class="block text-xs font-black uppercase text-slate-500 mb-2 tracking-widest">Title (FR)</label>
                <input type="text" name="title_fr" value="<?= $post['title_fr'] ?? '' ?>" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 text-white focus:ring-2 focus:ring-canada-red outline-none" required>
            </div>
            <div>
                <label class="block text-xs font-black uppercase text-slate-500 mb-2 tracking-widest">Content (EN)</label>
                <textarea name="content_en" rows="15" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 text-white focus:ring-2 focus:ring-canada-red outline-none"><?= $post['content_en'] ?? '' ?></textarea>
            </div>
            <div>
                <label class="block text-xs font-black uppercase text-slate-500 mb-2 tracking-widest">Content (FR)</label>
                <textarea name="content_fr" rows="15" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 text-white focus:ring-2 focus:ring-canada-red outline-none"><?= $post['content_fr'] ?? '' ?></textarea>
            </div>
        </div>
    </div>

    <div class="lg:col-span-1 space-y-8">
        <div class="bg-slate-800 p-8 rounded-[2rem] border border-slate-700 shadow-xl space-y-6">
            <div>
                <label class="block text-xs font-black uppercase text-slate-500 mb-2 tracking-widest">Status</label>
                <select name="status" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 text-white">
                    <option value="published" <?= ($post['status'] ?? '') == 'published' ? 'selected' : '' ?>>Published</option>
                    <option value="draft" <?= ($post['status'] ?? '') == 'draft' ? 'selected' : '' ?>>Draft</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-black uppercase text-slate-500 mb-2 tracking-widest">Category</label>
                <select name="category_id" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 text-white">
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= ($post['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>><?= $cat['name_en'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-xs font-black uppercase text-slate-500 mb-2 tracking-widest">Slug</label>
                <input type="text" name="slug" value="<?= $post['slug'] ?? '' ?>" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 text-white" placeholder="auto-generated">
            </div>
            <div>
                <label class="block text-xs font-black uppercase text-slate-500 mb-2 tracking-widest">Featured Image URL</label>
                <input type="text" name="featured_image" value="<?= $post['featured_image'] ?? '' ?>" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 text-white">
            </div>
            
            <button type="submit" class="w-full bg-canada-red text-white py-5 rounded-2xl font-black uppercase tracking-widest hover:bg-white hover:text-slate-900 transition duration-300">
                <?= $id ? 'Update' : 'Publish' ?>
            </button>
        </div>
    </div>
</form>
