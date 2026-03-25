<?php
declare(strict_types=1);

require_once __DIR__ . '/cart.php';

$pageTitle = $pageTitle ?? ($company['name'] . ' | Printer Shopping Store');
$pageDescription = $pageDescription ?? 'Professional printer shopping website with modern UI and trusted support.';
$currentPage = $currentPage ?? 'home';
$cartItemCount = cartGetCount();
$printerCategoryMenu = [
    ['label' => 'Inkjet Printers', 'icon' => 'ri-printer-line', 'href' => 'printers.php#inkjet'],
    ['label' => 'Laser Printers', 'icon' => 'ri-flashlight-line', 'href' => 'printers.php#laser'],
    ['label' => 'Wireless Printers', 'icon' => 'ri-wifi-line', 'href' => 'printers.php#wireless'],
    ['label' => 'All-in-One Printers', 'icon' => 'ri-file-list-3-line', 'href' => 'printers.php#all-in-one'],
];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle); ?></title>
    <meta name="description" content="<?= e($pageDescription); ?>">
    <link rel="icon" type="image/png" sizes="128x128" href="images/logo-printer.png">
    <link rel="shortcut icon" href="images/logo-printer.png" type="image/png">
    <link rel="apple-touch-icon" href="images/logo-printer.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="header-shell">
        <div class="promo-strip">
            <div class="container promo-inner">
                <p>Free shipping on orders above $99</p>
                <p>Support: <?= e($company['phone']); ?> | <?= e($company['email']); ?></p>
            </div>
        </div>

        <header class="navbar">
            <div class="container nav-inner">
                <div class="blur-layer" aria-hidden="true"></div>
                <a class="logo" href="index.php">
                    <span class="logo-icon" aria-hidden="true">
                        <img src="images/logo-printer.png" alt="">
                    </span>
                    <span class="logo-text"><?= e($company['name']); ?></span>
                </a>

                <nav class="menu" data-nav>
                    <?php foreach ($navLinks as $link): ?>
                        <?php if ($link['key'] === 'printers'): ?>
                            <div class="menu-dropdown <?= $link['key'] === $currentPage ? 'is-active' : ''; ?>">
                                <a class="menu-dropdown-trigger <?= $link['key'] === $currentPage ? 'active' : ''; ?>" href="<?= e($link['href']); ?>" aria-haspopup="true">
                                    <span><?= e($link['label']); ?></span>
                                    <i class="ri-arrow-down-s-line" aria-hidden="true"></i>
                                </a>
                                <div class="menu-dropdown-panel" aria-label="Printer categories">
                                    <?php foreach ($printerCategoryMenu as $item): ?>
                                        <a class="menu-dropdown-item" href="<?= e($item['href']); ?>">
                                            <i class="<?= e($item['icon']); ?>" aria-hidden="true"></i>
                                            <span><?= e($item['label']); ?></span>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <a class="<?= $link['key'] === $currentPage ? 'active' : ''; ?>" href="<?= e($link['href']); ?>"><?= e($link['label']); ?></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </nav>

                <div class="nav-actions">
                    <button class="appointment-btn" type="button" data-appointment-open>
                        <span>Get Appointment</span>
                    </button>
                    <button class="login-btn" type="button" aria-label="Login">
                        <i class="ri-user-3-line" aria-hidden="true"></i>
                    </button>
                    <a class="cart-btn" href="cart.php" aria-label="Open cart">
                        <svg viewBox="0 0 24 24" focusable="false">
                            <path d="M8 19a2 2 0 1 0 0 4a2 2 0 0 0 0-4zm9 0a2 2 0 1 0 .001 4A2 2 0 0 0 17 19zM6.2 5l.4 2H21l-1.6 8.1a2 2 0 0 1-2 1.6H9.2a2 2 0 0 1-2-1.6L5.1 3H2V1h4a1 1 0 0 1 1 .8L7.5 4h13.8v1H6.2z"></path>
                        </svg>
                        <span class="cart-count"><?= e((string) $cartItemCount); ?></span>
                    </a>
                    <button class="menu-toggle" type="button" aria-label="Open menu" data-nav-toggle>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </header>
    </div>
