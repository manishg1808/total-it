<?php
declare(strict_types=1);

$rootPath = dirname(__DIR__);
chdir($rootPath);

$requestPath = (string) (parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH) ?? '/');
$cleanPath = '/' . ltrim($requestPath, '/');
$normalizedPath = rtrim($cleanPath, '/');
if ($normalizedPath === '') {
    $normalizedPath = '/';
}

$routeMap = [
    '/' => 'index.php',
    '/index' => 'index.php',
    '/index.php' => 'index.php',

    '/about' => 'about.php',
    '/about.php' => 'about.php',

    '/contact' => 'contact.php',
    '/contact.php' => 'contact.php',

    '/printers' => 'printers.php',
    '/printers.php' => 'printers.php',

    '/brand' => 'brand.php',
    '/brand.php' => 'brand.php',

    '/product' => 'product.php',
    '/product.php' => 'product.php',

    '/cart' => 'cart.php',
    '/cart.php' => 'cart.php',

    '/checkout' => 'checkout.php',
    '/checkout.php' => 'checkout.php',

    '/cart-actions' => 'cart-actions.php',
    '/cart-actions.php' => 'cart-actions.php',

    '/admin' => 'admin/index.php',
    '/admin/' => 'admin/index.php',
    '/admin/index.php' => 'admin/index.php',
    '/admin/products' => 'admin/products.php',
    '/admin/products.php' => 'admin/products.php',
    '/admin/categories' => 'admin/categories.php',
    '/admin/categories.php' => 'admin/categories.php',
    '/admin/brands' => 'admin/brands.php',
    '/admin/brands.php' => 'admin/brands.php',
];

$targetFile = $routeMap[$normalizedPath] ?? null;

if ($targetFile === null) {
    http_response_code(404);
    header('Content-Type: text/html; charset=utf-8');
    echo '<h1>404 Not Found</h1>';
    exit;
}

$absoluteTarget = $rootPath . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $targetFile);

if (!is_file($absoluteTarget)) {
    http_response_code(404);
    header('Content-Type: text/html; charset=utf-8');
    echo '<h1>404 Not Found</h1>';
    exit;
}

require $absoluteTarget;
