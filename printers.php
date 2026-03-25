<?php
declare(strict_types=1);

require __DIR__ . '/includes/site-data.php';
require __DIR__ . '/includes/printer-products.php';
require __DIR__ . '/includes/cart.php';

$currentPage = 'printers';
$pageTitle = $company['name'] . ' | Printers';
$pageDescription = 'Browse all printers by category, price, rating, and business need.';

$catalog = getPrinterCatalog();
$catalogCount = count($catalog);
$usageOptions = ['Home', 'Office', 'Photo', 'High Volume'];
$brandOptions = ['HP', 'Canon', 'Epson', 'Brother'];
$sortOptions = [
    'popular' => 'Sort: Most Popular',
    'price_low' => 'Price: Low to High',
    'price_high' => 'Price: High to Low',
    'rating_high' => 'Top Rated',
];

$searchQuery = trim((string) ($_GET['q'] ?? ''));
$selectedUsage = trim((string) ($_GET['usage'] ?? ''));
if (!in_array($selectedUsage, $usageOptions, true)) {
    $selectedUsage = '';
}

$selectedSort = trim((string) ($_GET['sort'] ?? 'popular'));
if (!array_key_exists($selectedSort, $sortOptions)) {
    $selectedSort = 'popular';
}

$selectedBrands = [];
$brandInput = $_GET['brands'] ?? [];
if (is_array($brandInput)) {
    foreach ($brandInput as $brand) {
        $brandName = trim((string) $brand);
        if (in_array($brandName, $brandOptions, true) && !in_array($brandName, $selectedBrands, true)) {
            $selectedBrands[] = $brandName;
        }
    }
}

$priceValues = array_map(
    static fn(array $item): int => (int) $item['price_value'],
    $catalog
);
$priceMinLimit = (int) (floor((float) min($priceValues) / 10) * 10);
$priceMaxLimit = (int) (ceil((float) max($priceValues) / 10) * 10);

$selectedBudget = isset($_GET['budget']) ? (int) $_GET['budget'] : $priceMaxLimit;
$selectedBudget = max($priceMinLimit, min($selectedBudget, $priceMaxLimit));
$budgetProgress = $priceMaxLimit > $priceMinLimit
    ? (($selectedBudget - $priceMinLimit) / ($priceMaxLimit - $priceMinLimit)) * 100
    : 100.0;

$filteredProducts = array_values(array_filter(
    $catalog,
    static function (array $item) use ($searchQuery, $selectedUsage, $selectedBrands, $selectedBudget): bool {
        if ((int) $item['price_value'] > $selectedBudget) {
            return false;
        }

        if ($selectedUsage !== '' && (string) ($item['usage'] ?? '') !== $selectedUsage) {
            return false;
        }

        if ($selectedBrands !== [] && !in_array((string) $item['brand'], $selectedBrands, true)) {
            return false;
        }

        if ($searchQuery !== '') {
            $haystack = strtolower(
                (string) $item['name'] . ' ' . (string) $item['brand'] . ' ' . (string) $item['type'] . ' ' . (string) ($item['usage'] ?? '')
            );
            if (!str_contains($haystack, strtolower($searchQuery))) {
                return false;
            }
        }

        return true;
    }
));

if ($selectedSort === 'price_low') {
    usort($filteredProducts, static fn(array $a, array $b): int => (int) $a['price_value'] <=> (int) $b['price_value']);
} elseif ($selectedSort === 'price_high') {
    usort($filteredProducts, static fn(array $a, array $b): int => (int) $b['price_value'] <=> (int) $a['price_value']);
} elseif ($selectedSort === 'rating_high') {
    usort($filteredProducts, static function (array $a, array $b): int {
        $ratingCompare = (float) $b['rating'] <=> (float) $a['rating'];
        if ($ratingCompare !== 0) {
            return $ratingCompare;
        }

        return (int) $a['price_value'] <=> (int) $b['price_value'];
    });
}

$queryState = [];
if ($searchQuery !== '') {
    $queryState['q'] = $searchQuery;
}
if ($selectedBudget !== $priceMaxLimit) {
    $queryState['budget'] = (string) $selectedBudget;
}
if ($selectedUsage !== '') {
    $queryState['usage'] = $selectedUsage;
}
if ($selectedBrands !== []) {
    $queryState['brands'] = $selectedBrands;
}
if ($selectedSort !== 'popular') {
    $queryState['sort'] = $selectedSort;
}

$buildPageUrl = static function (int $targetPage, array $baseQuery): string {
    $params = $baseQuery;
    if ($targetPage > 1) {
        $params['page'] = $targetPage;
    }

    $query = http_build_query($params);
    return 'printers.php' . ($query !== '' ? '?' . $query : '');
};

$perPage = 9;
$totalProducts = count($filteredProducts);
$totalPages = (int) max(1, ceil($totalProducts / $perPage));
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$page = max(1, min($page, $totalPages));
$offset = ($page - 1) * $perPage;
$visibleProducts = array_slice($filteredProducts, $offset, $perPage);
$currentListUrl = $buildPageUrl($page, $queryState);
$cartNotice = cartPullNotice();

require __DIR__ . '/includes/header.php';
?>

<main>
    <section class="page-hero page-hero--printers">
        <div class="container">
            <p class="section-eyebrow">Shop Page</p>
            <h1>Browse All Printers</h1>
            <p>Find the right model for home, office, and high-volume use with transparent pricing.</p>
        </div>
    </section>

    <section class="section section-light">
        <div class="container filter-layout">
            <aside class="filter-sidebar" data-reveal>
                <form class="smart-filter-form" action="printers.php" method="get" data-smart-filters>
                    <h3>Smart Filters</h3>
                    <p class="smart-filter-subline">Refine printers by budget, usage, and brand.</p>

                    <?php if ($searchQuery !== ''): ?>
                        <input type="hidden" name="q" value="<?= e($searchQuery); ?>">
                    <?php endif; ?>
                    <?php if ($selectedSort !== 'popular'): ?>
                        <input type="hidden" name="sort" value="<?= e($selectedSort); ?>">
                    <?php endif; ?>

                    <div class="filter-group">
                        <div class="filter-headline">
                            <label for="budget-range">Budget Slider</label>
                            <strong data-budget-value>$<?= e(number_format((float) $selectedBudget, 2)); ?></strong>
                        </div>
                        <input
                            id="budget-range"
                            class="budget-range"
                            data-budget-range
                            type="range"
                            name="budget"
                            min="<?= e((string) $priceMinLimit); ?>"
                            max="<?= e((string) $priceMaxLimit); ?>"
                            step="1"
                            value="<?= e((string) $selectedBudget); ?>"
                            style="--range-progress: <?= e(number_format((float) $budgetProgress, 2, '.', '')); ?>%;"
                            aria-label="Maximum budget"
                        >
                    </div>

                    <div class="filter-group">
                        <label for="usage">Usage</label>
                        <div class="select-wrap">
                            <select id="usage" name="usage" data-filter-live>
                                <option value="">All</option>
                                <?php foreach ($usageOptions as $usage): ?>
                                    <option value="<?= e($usage); ?>" <?= $selectedUsage === $usage ? 'selected' : ''; ?>><?= e($usage); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <i class="ri-arrow-down-s-line" aria-hidden="true"></i>
                        </div>
                    </div>

                    <div class="filter-group">
                        <p>Brand</p>
                        <div class="brand-check-grid">
                            <?php foreach ($brandOptions as $brand): ?>
                                <label class="check-item">
                                    <input type="checkbox" name="brands[]" value="<?= e($brand); ?>" data-filter-live <?= in_array($brand, $selectedBrands, true) ? 'checked' : ''; ?>>
                                    <span><?= e($brand); ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="filter-actions">
                        <button class="btn btn-primary btn-sm" type="submit">Apply</button>
                        <a class="btn btn-outline btn-sm" href="printers.php">Clear</a>
                    </div>
                </form>
            </aside>

            <div class="filter-content" data-reveal>
                <?php if ($cartNotice !== null): ?>
                    <p class="cart-notice"><?= e($cartNotice); ?></p>
                <?php endif; ?>
                <div class="filter-toolbar">
                    <div class="filter-toolbar-copy">
                        <h2>Products <span class="filter-count">(<?= e((string) $totalProducts); ?>)</span></h2>
                        <p class="filter-result-summary">Showing <?= e((string) $totalProducts); ?> of <?= e((string) $catalogCount); ?> printers</p>
                    </div>
                    <form class="filter-sort-form" action="printers.php" method="get">
                        <?php if ($searchQuery !== ''): ?>
                            <input type="hidden" name="q" value="<?= e($searchQuery); ?>">
                        <?php endif; ?>
                        <input type="hidden" name="budget" value="<?= e((string) $selectedBudget); ?>">
                        <?php if ($selectedUsage !== ''): ?>
                            <input type="hidden" name="usage" value="<?= e($selectedUsage); ?>">
                        <?php endif; ?>
                        <?php foreach ($selectedBrands as $brand): ?>
                            <input type="hidden" name="brands[]" value="<?= e($brand); ?>">
                        <?php endforeach; ?>

                        <select name="sort" data-auto-submit>
                            <?php foreach ($sortOptions as $sortValue => $sortLabel): ?>
                                <option value="<?= e($sortValue); ?>" <?= $selectedSort === $sortValue ? 'selected' : ''; ?>><?= e($sortLabel); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
                <div class="product-grid">
                    <?php if ($visibleProducts === []): ?>
                        <article class="product-empty-state">
                            <h3>No products found</h3>
                            <p>Try increasing budget or selecting fewer filters.</p>
                            <a class="btn btn-outline btn-sm" href="printers.php">Clear Filters</a>
                        </article>
                    <?php else: ?>
                        <?php foreach ($visibleProducts as $product): ?>
                            <?php $detailUrl = 'product.php?id=' . (int) $product['id']; ?>
                            <article class="product-card product-card--clickable" data-product-url="<?= e($detailUrl); ?>" tabindex="0" role="link" aria-label="Open details for <?= e($product['name']); ?>">
                                <div class="product-image" aria-hidden="true">
                                    <span class="product-image-icon">
                                        <i class="ri-printer-line"></i>
                                    </span>
                                    <span class="product-image-label"><?= e($product['brand']); ?> Preview</span>
                                </div>
                                <div class="product-meta-row">
                                    <span class="product-brand"><?= e($product['brand']); ?></span>
                                    <p class="rating">
                                        <i class="ri-star-fill" aria-hidden="true"></i>
                                        <span><?= e((string) $product['rating']); ?></span>
                                    </p>
                                </div>
                                <h3><a class="product-title-link" href="<?= e($detailUrl); ?>"><?= e((string) $product['name']); ?></a></h3>
                                <p class="product-subline">Genuine warranty support with reliable print performance.</p>
                                <div class="price-row">
                                    <p class="price"><?= e((string) $product['price']); ?></p>
                                </div>
                                <div class="product-actions">
                                    <form class="product-add-form" action="cart-actions.php" method="post">
                                        <input type="hidden" name="action" value="add">
                                        <input type="hidden" name="product_id" value="<?= e((string) $product['id']); ?>">
                                        <input type="hidden" name="redirect" value="<?= e($currentListUrl); ?>">
                                        <button class="btn btn-primary btn-block btn-cart-sm" type="submit">Add to Cart</button>
                                    </form>
                                    <a class="product-view-link" href="<?= e($detailUrl); ?>">
                                        View Details
                                        <i class="ri-arrow-right-line" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <?php if ($totalPages > 1 && $visibleProducts !== []): ?>
                    <nav class="shop-pagination" aria-label="Printers pagination">
                        <a class="page-link <?= $page <= 1 ? 'is-disabled' : ''; ?>" href="<?= $page <= 1 ? '#' : e($buildPageUrl($page - 1, $queryState)); ?>">Previous</a>

                        <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                            <a class="page-link <?= $p === $page ? 'is-active' : ''; ?>" href="<?= e($buildPageUrl($p, $queryState)); ?>"><?= e((string) $p); ?></a>
                        <?php endfor; ?>

                        <a class="page-link <?= $page >= $totalPages ? 'is-disabled' : ''; ?>" href="<?= $page >= $totalPages ? '#' : e($buildPageUrl($page + 1, $queryState)); ?>">Next</a>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>

