<?php
declare(strict_types=1);

require __DIR__ . '/includes/site-data.php';
require __DIR__ . '/includes/printer-products.php';
require __DIR__ . '/includes/cart.php';

$requestedId = isset($_GET['id']) ? (int) $_GET['id'] : 1;
$product = getPrinterById($requestedId);

if ($product === null) {
    $product = getPrinterById(1);
}

if ($product === null) {
    http_response_code(404);
    exit('Product not found.');
}

$currentPage = 'printers';
$pageTitle = (string) $product['name'] . ' | ' . $company['name'];
$pageDescription = 'View complete details, price, and specifications for ' . (string) $product['name'] . '.';
$cartNotice = cartPullNotice();

require __DIR__ . '/includes/header.php';
?>

<main>
    <section class="page-hero page-hero--printers">
        <div class="container">
            <p class="section-eyebrow">Product Details</p>
            <h1><?= e((string) $product['name']); ?></h1>
            <p><?= e((string) $product['description']); ?></p>
        </div>
    </section>

    <section class="section section-light product-detail-section">
        <div class="container product-detail-layout">
            <?php if ($cartNotice !== null): ?>
                <p class="cart-notice product-cart-notice"><?= e($cartNotice); ?></p>
            <?php endif; ?>
            <article class="product-detail-visual" data-reveal>
                <div class="placeholder product-detail-image" aria-hidden="true">
                    <span>Product Image</span>
                </div>
                <div class="product-detail-highlights">
                    <h3>Key Highlights</h3>
                    <ul>
                        <?php foreach ((array) $product['highlights'] as $item): ?>
                            <li><?= e((string) $item); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </article>

            <aside class="product-detail-card" data-reveal>
                <div class="product-detail-meta">
                    <span class="product-badge"><?= e((string) $product['badge']); ?></span>
                    <span class="product-type"><?= e((string) $product['type']); ?></span>
                </div>
                <h2><?= e((string) $product['name']); ?></h2>
                <p class="rating product-detail-rating"><?= e((string) $product['rating']); ?> &#9733; Customer Rating</p>
                <div class="price-row product-detail-price">
                    <p class="price"><?= e((string) $product['price']); ?></p>
                    <p class="old-price"><?= e((string) $product['old_price']); ?></p>
                </div>
                <p class="product-detail-note">Inclusive of taxes. Genuine product with brand-backed warranty support.</p>
                <div class="product-detail-actions">
                    <form class="product-add-form" action="cart-actions.php" method="post">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="product_id" value="<?= e((string) $product['id']); ?>">
                        <input type="hidden" name="redirect" value="product.php?id=<?= e((string) $product['id']); ?>">
                        <button class="btn btn-primary" type="submit">Add to Cart</button>
                    </form>
                    <a class="btn btn-outline" href="printers.php">Back to Printers</a>
                </div>
            </aside>
        </div>
    </section>

    <section class="section product-specs-section">
        <div class="container">
            <div class="section-title" data-reveal>
                <h2>Technical Specifications</h2>
                <p>Quick overview of performance, compatibility, and support for this model.</p>
            </div>

            <div class="product-specs-wrap" data-reveal>
                <table class="product-specs-table">
                    <tbody>
                        <?php foreach ((array) $product['specs'] as $label => $value): ?>
                            <tr>
                                <th scope="row"><?= e((string) $label); ?></th>
                                <td><?= e((string) $value); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
