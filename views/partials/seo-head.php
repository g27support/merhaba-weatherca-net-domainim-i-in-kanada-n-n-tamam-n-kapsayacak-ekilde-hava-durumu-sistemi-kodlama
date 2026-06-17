<?php
/** @var array $seo */
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $seo['title'] ?? 'WeatherCA.net' ?></title>
<meta name="description" content="<?= $seo['description'] ?? '' ?>">

<!-- OpenGraph -->
<meta property="og:title" content="<?= $seo['title'] ?? '' ?>">
<meta property="og:description" content="<?= $seo['description'] ?? '' ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?= $seo['canonical'] ?? '' ?>">
<meta property="og:image" content="<?= $seo['image'] ?? '/assets/og-image.png' ?>">

<!-- Canonical & Hreflang -->
<link rel="canonical" href="<?= $seo['canonical'] ?? '' ?>">
<?php foreach ($seo['hreflang'] ?? [] as $lang => $url): ?>
    <link rel="alternate" hreflang="<?= $lang ?>" href="<?= $url ?>">
<?php endforeach; ?>

<!-- Tailwind & Fonts -->
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/custom.css">

<!-- Schema.org JSON-LD -->
<?php if (isset($seo['schema'])): ?>
    <script type="application/ld+json">
        <?= json_encode($seo['schema'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>
    </script>
<?php endif; ?>

<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'canada-red': '#EF3340',
                    'navy-dark': '#0A1128',
                    'navy-light': '#1C2541',
                }
            }
        }
    }
</script>
