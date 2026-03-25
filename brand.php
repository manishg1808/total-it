<?php
declare(strict_types=1);

require __DIR__ . '/includes/site-data.php';

$brandKey = strtolower(trim((string) ($_GET['brand'] ?? 'hp')));

$brands = [
    'hp' => [
        'name' => 'HP',
        'summary' => 'Reliable printing for home offices and growing teams with balanced speed, quality, and smart wireless setup.',
        'highlights' => [
            'Strong all-in-one options for home and office',
            'Easy wireless printing and mobile app support',
            'Trusted print quality for documents and photos',
        ],
    ],
    'canon' => [
        'name' => 'Canon',
        'summary' => 'Great color depth and clean output quality for document work, creative printing, and photo-focused usage.',
        'highlights' => [
            'Excellent color and photo quality',
            'Cost-effective ink tank choices available',
            'Compact printers for desks and studio corners',
        ],
    ],
    'brother' => [
        'name' => 'Brother',
        'summary' => 'Known for dependable office performance, lower maintenance, and productivity-focused laser options.',
        'highlights' => [
            'Fast print speed for office workflows',
            'Solid mono and color laser reliability',
            'Efficient duty cycle for regular business use',
        ],
    ],
    'epson' => [
        'name' => 'Epson',
        'summary' => 'Ideal for high-volume printing with refill-friendly systems and long-term value per page.',
        'highlights' => [
            'EcoTank range for heavy print volumes',
            'Lower running cost for long-term use',
            'Versatile options for home, office, and creators',
        ],
    ],
];

if (!isset($brands[$brandKey])) {
    $brandKey = 'hp';
}

$brand = $brands[$brandKey];
$currentPage = 'printers';
$pageTitle = $brand['name'] . ' Printers | ' . $company['name'];
$pageDescription = 'Explore genuine ' . $brand['name'] . ' printers from an authorized dealer.';

require __DIR__ . '/includes/header.php';
?>

<main>
    <section class="page-hero">
        <div class="container page-hero-grid">
            <div class="page-hero-content">
                <p class="section-eyebrow">Authorized Dealer</p>
                <h1><?= e($brand['name']); ?> Printers</h1>
                <p><?= e($brand['summary']); ?></p>
                <div class="page-hero-actions">
                    <a class="btn btn-primary" href="printers.php">Shop <?= e($brand['name']); ?> Models</a>
                    <a class="btn btn-outline" href="printers.php">Get Expert Recommendation</a>
                </div>
                <span class="brand-page-tag">
                    <i class="ri-verified-badge-line" aria-hidden="true"></i>
                    Authorized Dealer
                </span>
            </div>

            <article class="page-hero-card">
                <h3>Why Choose <?= e($brand['name']); ?>?</h3>
                <ul>
                    <?php foreach ($brand['highlights'] as $point): ?>
                        <li><?= e($point); ?></li>
                    <?php endforeach; ?>
                </ul>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-title">
                <p class="section-eyebrow">Brand Support</p>
                <h2>Need Help Picking the Right <?= e($brand['name']); ?> Printer?</h2>
                <p>Tell us your printing volume, use case, and budget. We will suggest the best-fit model quickly.</p>
            </div>
            <div class="hero-buttons">
                <a class="btn btn-primary" href="printers.php">Talk to an Expert</a>
                <a class="btn btn-outline" href="printers.php">Browse All Printers</a>
            </div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
