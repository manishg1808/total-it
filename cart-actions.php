<?php
declare(strict_types=1);

require __DIR__ . '/includes/site-data.php';
require __DIR__ . '/includes/cart.php';

$redirect = (string) ($_POST['redirect'] ?? 'cart.php');
if ($redirect === '' || str_contains($redirect, '://') || str_contains($redirect, "\n") || str_contains($redirect, "\r")) {
    $redirect = 'cart.php';
}

$action = (string) ($_POST['action'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'add') {
        $productId = (int) ($_POST['product_id'] ?? 0);
        $qty = max(1, (int) ($_POST['qty'] ?? 1));

        if (cartAddItem($productId, $qty)) {
            cartSetNotice('Product added to cart.');
        } else {
            cartSetNotice('Unable to add product to cart.');
        }
    } elseif ($action === 'update') {
        $productId = (int) ($_POST['product_id'] ?? 0);
        $qty = (int) ($_POST['qty'] ?? 1);
        cartUpdateItem($productId, $qty);
        cartSetNotice('Cart updated successfully.');
    } elseif ($action === 'remove') {
        $productId = (int) ($_POST['product_id'] ?? 0);
        cartRemoveItem($productId);
        cartSetNotice('Item removed from cart.');
    } elseif ($action === 'clear') {
        cartClear();
        cartSetNotice('Cart cleared.');
    }
}

header('Location: ' . $redirect);
exit;
