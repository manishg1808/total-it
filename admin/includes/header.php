<?php
declare(strict_types=1);

$adminTitle = $adminTitle ?? 'Admin Panel';
$adminPage = $adminPage ?? 'dashboard';

if (!function_exists('admin_e')) {
    function admin_e(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}

$adminBaseUrl = '/admin';
$siteBaseUrl = '';

$assetBaseUrl = $siteBaseUrl . '/assets';
$dashboardHref = $adminBaseUrl . '/index.php';
$adminCssHref = $assetBaseUrl . '/css/admin.css';
$adminJsHref = $assetBaseUrl . '/js/admin.js';
$backToSiteHref = $siteBaseUrl . '/index.php';

$adminLinks = [
    ['label' => 'Dashboard', 'href' => $adminBaseUrl . '/index.php', 'key' => 'dashboard', 'icon' => 'ri-dashboard-line'],
    ['label' => 'Products', 'href' => $adminBaseUrl . '/products.php', 'key' => 'products', 'icon' => 'ri-store-2-line'],
    ['label' => 'Category', 'href' => $adminBaseUrl . '/categories.php', 'key' => 'categories', 'icon' => 'ri-layout-grid-line'],
    ['label' => 'Brand', 'href' => $adminBaseUrl . '/brands.php', 'key' => 'brands', 'icon' => 'ri-price-tag-3-line'],
];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= admin_e($adminTitle); ?> | Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= admin_e($adminCssHref); ?>">
</head>
<body>
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <a class="admin-brand" href="<?= admin_e($dashboardHref); ?>">
                <span>AD</span>
                <div>
                    <strong>Admin Panel</strong>
                    <small>Printer Store</small>
                </div>
            </a>

            <nav class="admin-nav" aria-label="Admin navigation">
                <?php foreach ($adminLinks as $item): ?>
                    <a class="<?= $item['key'] === $adminPage ? 'active' : ''; ?>" href="<?= admin_e($item['href']); ?>">
                        <i class="<?= admin_e($item['icon']); ?>" aria-hidden="true"></i>
                        <span><?= admin_e($item['label']); ?></span>
                    </a>
                <?php endforeach; ?>
            </nav>

            <a class="admin-back-link" href="<?= admin_e($backToSiteHref); ?>">
                <i class="ri-arrow-left-line" aria-hidden="true"></i>
                Back to Website
            </a>
        </aside>

        <div class="admin-main">
            <header class="admin-topbar">
                <div>
                    <p class="admin-eyebrow">Management</p>
                    <h1><?= admin_e($adminTitle); ?></h1>
                </div>
                <span class="admin-badge">
                    <i class="ri-shield-check-line" aria-hidden="true"></i>
                    Secure Session
                </span>
            </header>

            <main class="admin-content">
