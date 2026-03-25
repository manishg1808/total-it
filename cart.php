<?php
declare(strict_types=1);

require __DIR__ . '/includes/site-data.php';
require __DIR__ . '/includes/cart.php';

$currentPage = 'printers';
$pageTitle = $company['name'] . ' | Cart';
$pageDescription = 'Review selected printers, update quantities, and continue to checkout.';

$cartItems = cartGetItems();
$cartCount = cartGetCount();
$cartSubtotal = cartGetSubtotal();
$cartNotice = cartPullNotice();

require __DIR__ . '/includes/header.php';
?>

<main>
    <section class="page-hero page-hero--printers">
        <div class="container">
            <p class="section-eyebrow">Shopping Cart</p>
            <h1>Your Cart</h1>
            <p>Review selected products, adjust quantity, and continue with a secure checkout flow.</p>
        </div>
    </section>

    <section class="section section-light">
        <div class="container cart-layout">
            <div class="cart-main" data-reveal>
                <?php if ($cartNotice !== null): ?>
                    <p class="cart-notice"><?= e($cartNotice); ?></p>
                <?php endif; ?>

                <?php if ($cartCount === 0): ?>
                    <article class="cart-empty">
                        <h2>Your cart is empty</h2>
                        <p>Start by browsing our printer catalog and add the right model for your setup.</p>
                        <a class="btn btn-primary" href="printers.php">Browse Printers</a>
                    </article>
                <?php else: ?>
                    <div class="cart-list">
                        <?php foreach ($cartItems as $item): ?>
                            <?php $product = $item['product']; ?>
                            <article class="cart-item">
                                <div class="placeholder cart-item-image" aria-hidden="true">
                                    <span>Image</span>
                                </div>

                                <div class="cart-item-content">
                                    <h3><a href="product.php?id=<?= e((string) $product['id']); ?>"><?= e((string) $product['name']); ?></a></h3>
                                    <p class="cart-item-meta"><?= e((string) $product['type']); ?> | <?= e((string) $product['rating']); ?> &#9733;</p>
                                    <p class="cart-item-price"><?= e((string) $product['price']); ?></p>
                                </div>

                                <div class="cart-item-actions">
                                    <form class="cart-qty-form" action="cart-actions.php" method="post">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="product_id" value="<?= e((string) $product['id']); ?>">
                                        <input type="hidden" name="redirect" value="cart.php">
                                        <label for="qty-<?= e((string) $product['id']); ?>">Qty</label>
                                        <input id="qty-<?= e((string) $product['id']); ?>" type="number" name="qty" min="1" value="<?= e((string) $item['qty']); ?>">
                                        <button class="btn btn-outline btn-sm" type="submit">Update</button>
                                    </form>

                                    <form action="cart-actions.php" method="post">
                                        <input type="hidden" name="action" value="remove">
                                        <input type="hidden" name="product_id" value="<?= e((string) $product['id']); ?>">
                                        <input type="hidden" name="redirect" value="cart.php">
                                        <button class="btn btn-outline btn-sm" type="submit">Remove</button>
                                    </form>

                                    <p class="cart-line-total"><?= e((string) $item['line_total']); ?></p>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <aside class="cart-summary" data-reveal>
                <h3>Order Summary</h3>
                <div class="cart-summary-row">
                    <span>Total Items</span>
                    <strong><?= e((string) $cartCount); ?></strong>
                </div>
                <div class="cart-summary-row">
                    <span>Subtotal</span>
                    <strong><?= e($cartSubtotal); ?></strong>
                </div>
                <p>Shipping and taxes are calculated at checkout.</p>
                <a class="btn btn-primary btn-block <?= $cartCount === 0 ? 'is-disabled' : ''; ?>" href="<?= $cartCount === 0 ? '#' : 'checkout.php'; ?>" <?= $cartCount === 0 ? 'aria-disabled="true"' : ''; ?>>Proceed to Checkout</a>
                <a class="btn btn-outline btn-block" href="printers.php">Continue Shopping</a>

                <?php if ($cartCount > 0): ?>
                    <form action="cart-actions.php" method="post" class="cart-clear-form">
                        <input type="hidden" name="action" value="clear">
                        <input type="hidden" name="redirect" value="cart.php">
                        <button class="btn btn-outline btn-block" type="submit">Clear Cart</button>
                    </form>
                <?php endif; ?>
            </aside>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
