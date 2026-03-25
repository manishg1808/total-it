<?php
declare(strict_types=1);

require __DIR__ . '/includes/site-data.php';
require __DIR__ . '/includes/cart.php';

$currentPage = 'printers';
$pageTitle = $company['name'] . ' | Checkout';
$pageDescription = 'Complete billing and shipping details and place your printer order securely.';

$checkoutSuccess = null;
if (isset($_SESSION['checkout_success']) && is_array($_SESSION['checkout_success'])) {
    $checkoutSuccess = $_SESSION['checkout_success'];
    unset($_SESSION['checkout_success']);
}

$cartItems = cartGetItems();
$cartCount = cartGetCount();
$cartSubtotal = cartGetSubtotal();

$checkoutFormValues = [
    'full_name' => '',
    'email' => '',
    'phone' => '',
    'address' => '',
    'city' => '',
    'state' => '',
    'zip' => '',
    'payment_method' => 'cod',
];
$checkoutFormError = null;

if ($checkoutSuccess === null && $cartCount === 0) {
    cartSetNotice('Your cart is empty. Please add a printer before checkout.');
    header('Location: cart.php');
    exit;
}

if ($checkoutSuccess === null && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $checkoutFormValues['full_name'] = trim((string) ($_POST['full_name'] ?? ''));
    $checkoutFormValues['email'] = trim((string) ($_POST['email'] ?? ''));
    $checkoutFormValues['phone'] = trim((string) ($_POST['phone'] ?? ''));
    $checkoutFormValues['address'] = trim((string) ($_POST['address'] ?? ''));
    $checkoutFormValues['city'] = trim((string) ($_POST['city'] ?? ''));
    $checkoutFormValues['state'] = trim((string) ($_POST['state'] ?? ''));
    $checkoutFormValues['zip'] = trim((string) ($_POST['zip'] ?? ''));
    $checkoutFormValues['payment_method'] = trim((string) ($_POST['payment_method'] ?? 'cod'));

    if (
        $checkoutFormValues['full_name'] === '' ||
        $checkoutFormValues['email'] === '' ||
        $checkoutFormValues['phone'] === '' ||
        $checkoutFormValues['address'] === '' ||
        $checkoutFormValues['city'] === '' ||
        $checkoutFormValues['state'] === '' ||
        $checkoutFormValues['zip'] === ''
    ) {
        $checkoutFormError = 'Please fill all required billing and shipping fields.';
    } elseif (!filter_var($checkoutFormValues['email'], FILTER_VALIDATE_EMAIL)) {
        $checkoutFormError = 'Please enter a valid email address.';
    } else {
        $orderNumber = 'ORD-' . date('Ymd') . '-' . (string) random_int(1000, 9999);

        $_SESSION['checkout_success'] = [
            'order_number' => $orderNumber,
            'customer_name' => $checkoutFormValues['full_name'],
            'email' => $checkoutFormValues['email'],
            'total' => $cartSubtotal,
            'items_count' => $cartCount,
        ];

        cartClear();
        header('Location: checkout.php?success=1');
        exit;
    }
}

require __DIR__ . '/includes/header.php';
?>

<main>
    <section class="page-hero page-hero--printers">
        <div class="container">
            <p class="section-eyebrow">Checkout</p>
            <h1>Secure Checkout</h1>
            <p>Enter your shipping details and complete your order with confidence.</p>
        </div>
    </section>

    <section class="section section-light checkout-section">
        <div class="container">
            <?php if ($checkoutSuccess !== null): ?>
                <article class="checkout-success" data-reveal>
                    <div class="checkout-success-icon" aria-hidden="true">
                        <i class="ri-checkbox-circle-line"></i>
                    </div>
                    <p class="section-eyebrow">Order Confirmed</p>
                    <h2>Thank You, <?= e((string) ($checkoutSuccess['customer_name'] ?? 'Customer')); ?>!</h2>
                    <p>Your order has been placed successfully. We sent confirmation details to <?= e((string) ($checkoutSuccess['email'] ?? 'your email')); ?>.</p>

                    <div class="checkout-success-meta">
                        <article>
                            <span>Order Number</span>
                            <strong><?= e((string) ($checkoutSuccess['order_number'] ?? 'N/A')); ?></strong>
                        </article>
                        <article>
                            <span>Items</span>
                            <strong><?= e((string) ($checkoutSuccess['items_count'] ?? '0')); ?></strong>
                        </article>
                        <article>
                            <span>Total Paid</span>
                            <strong><?= e((string) ($checkoutSuccess['total'] ?? '$0.00')); ?></strong>
                        </article>
                    </div>

                    <div class="checkout-success-actions">
                        <a class="btn btn-primary" href="printers.php">Continue Shopping</a>
                        <a class="btn btn-outline" href="contact.php">Need Help?</a>
                    </div>
                </article>
            <?php else: ?>
                <div class="checkout-layout">
                    <div class="checkout-main" data-reveal>
                        <h2>Billing &amp; Shipping Details</h2>

                        <?php if ($checkoutFormError !== null): ?>
                            <p class="form-alert form-alert--error"><?= e($checkoutFormError); ?></p>
                        <?php endif; ?>

                        <form id="checkout-form" class="checkout-form" action="checkout.php" method="post">
                            <div class="checkout-field-grid">
                                <div class="checkout-field">
                                    <label for="checkout-full-name">Full Name</label>
                                    <input id="checkout-full-name" name="full_name" type="text" placeholder="Full Name" value="<?= e($checkoutFormValues['full_name']); ?>" required>
                                </div>

                                <div class="checkout-field">
                                    <label for="checkout-email">Email Address</label>
                                    <input id="checkout-email" name="email" type="email" placeholder="Email Address" value="<?= e($checkoutFormValues['email']); ?>" required>
                                </div>

                                <div class="checkout-field checkout-field--full">
                                    <label for="checkout-phone">Phone Number</label>
                                    <input id="checkout-phone" name="phone" type="tel" placeholder="Phone Number" value="<?= e($checkoutFormValues['phone']); ?>" required>
                                </div>

                                <div class="checkout-field checkout-field--full">
                                    <label for="checkout-address">Shipping Address</label>
                                    <input id="checkout-address" name="address" type="text" placeholder="Shipping Address" value="<?= e($checkoutFormValues['address']); ?>" required>
                                </div>

                                <div class="checkout-field">
                                    <label for="checkout-city">City</label>
                                    <input id="checkout-city" name="city" type="text" placeholder="City" value="<?= e($checkoutFormValues['city']); ?>" required>
                                </div>

                                <div class="checkout-field">
                                    <label for="checkout-state">State</label>
                                    <input id="checkout-state" name="state" type="text" placeholder="State" value="<?= e($checkoutFormValues['state']); ?>" required>
                                </div>

                                <div class="checkout-field checkout-field--full">
                                    <label for="checkout-zip">ZIP / Postal Code</label>
                                    <input id="checkout-zip" name="zip" type="text" placeholder="ZIP / Postal Code" value="<?= e($checkoutFormValues['zip']); ?>" required>
                                </div>
                            </div>

                            <div class="checkout-payment">
                                <h3>Payment Method</h3>
                                <p>All prices are displayed in USD. No hidden fees.</p>

                                <label class="checkout-payment-option">
                                    <input type="radio" name="payment_method" value="cod" <?= $checkoutFormValues['payment_method'] === 'cod' ? 'checked' : ''; ?>>
                                    <span class="checkout-payment-icon" aria-hidden="true">
                                        <i class="ri-money-dollar-circle-line"></i>
                                    </span>
                                    <span>
                                        <strong>Cash on Delivery</strong>
                                        <small>Pay when your printer is delivered.</small>
                                    </span>
                                </label>
                            </div>
                        </form>
                    </div>

                    <aside class="checkout-order" data-reveal>
                        <h2>Your Order</h2>

                        <div class="checkout-order-list">
                            <?php foreach ($cartItems as $item): ?>
                                <?php $orderProduct = $item['product']; ?>
                                <article class="checkout-order-item">
                                    <p><?= e((string) $orderProduct['name']); ?></p>
                                    <strong><?= e((string) $item['line_total']); ?></strong>
                                </article>
                            <?php endforeach; ?>
                        </div>

                        <div class="checkout-order-total">
                            <span>Total</span>
                            <strong><?= e($cartSubtotal); ?></strong>
                        </div>

                        <button class="btn btn-primary checkout-place-order" type="submit" form="checkout-form">Place Order</button>

                        <p class="checkout-order-note">
                            <i class="ri-lock-2-line" aria-hidden="true"></i>
                            Secure Checkout
                            <span>|</span>
                            <i class="ri-shield-check-line" aria-hidden="true"></i>
                            Genuine Printers
                        </p>
                    </aside>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
