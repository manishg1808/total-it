<?php
declare(strict_types=1);

require __DIR__ . '/includes/site-data.php';

$currentPage = 'about';
$pageTitle = $company['name'] . ' | About';
$pageDescription = 'Learn how Total IT Assist INC simplifies printer buying with trusted products and expert support.';

$aboutStats = [
    ['target' => 10000, 'suffix' => '+', 'label' => 'Happy Customers', 'thousands' => true],
    ['target' => 500, 'suffix' => '+', 'label' => 'Printers Delivered'],
    ['target' => 4.8, 'suffix' => '/5', 'label' => 'Average Rating', 'decimals' => 1],
    ['target' => 24, 'suffix' => '/7', 'label' => 'Support Availability'],
];

$storyParagraphs = [
    'Buying a printer can often feel confusing.',
    'With too many options, unclear specifications, and lack of proper guidance, customers end up making the wrong choice.',
    'At Total IT Assist INC, we simplify the process by providing clear comparisons, expert recommendations, and trusted products so you can make the right decision with confidence.',
];

$trustPoints = [
    '100% Genuine Products (HP, Canon, Epson, Brother)',
    'Secure and trusted payment process',
    'Fast dispatch and reliable delivery',
    'Expert support before and after purchase',
];

$missionVision = [
    [
        'label' => 'Mission',
        'title' => 'To make printer buying simple, practical, and trustworthy for every customer.',
    ],
    [
        'label' => 'Vision',
        'title' => 'To become the most trusted platform for printer solutions.',
    ],
];

$aboutProcess = [
    ['step' => '01', 'title' => 'Understand Your Requirement', 'text' => 'We analyze your usage, budget, and printing needs.'],
    ['step' => '02', 'title' => 'Recommend the Right Printer', 'text' => 'We suggest the best-fit models based on performance and value.'],
    ['step' => '03', 'title' => 'Secure Purchase Process', 'text' => 'Safe and smooth checkout with proper invoicing.'],
    ['step' => '04', 'title' => 'Post-Sales Support', 'text' => 'We assist you with setup and ongoing support when needed.'],
];

$aboutValues = [
    ['icon' => 'ri-shield-check-line', 'title' => 'Trust First', 'text' => 'We deliver only genuine products with transparent pricing.'],
    ['icon' => 'ri-customer-service-2-line', 'title' => 'Human Support', 'text' => 'Real experts guide you, no confusion, no scripts.'],
    ['icon' => 'ri-flashlight-line', 'title' => 'Fast Execution', 'text' => 'Quick order handling and reliable delivery timelines.'],
    ['icon' => 'ri-rocket-2-line', 'title' => 'Right Recommendation', 'text' => 'We focus on the best fit for your needs, not random upselling.'],
];

require __DIR__ . '/includes/header.php';
?>

<main class="about-page">
    <section class="page-hero page-hero--about">
        <div class="container page-hero-grid">
            <div class="page-hero-content" data-reveal>
                <p class="section-eyebrow">About Us</p>
                <h1>Built for Smarter Printer Shopping</h1>
                <p>We focus on clear recommendations, trusted products, and a professional shopping flow.</p>
                <div class="page-hero-actions">
                    <a class="btn btn-primary" href="printers.php">Shop Printers</a>
                    <a class="btn btn-outline" href="contact.php">Talk to Expert</a>
                </div>
            </div>
            <aside class="page-hero-card" data-reveal>
                <h3>Why Buyers Trust Us</h3>
                <ul>
                    <?php foreach ($shopBenefits as $benefit): ?>
                        <li><?= e($benefit); ?></li>
                    <?php endforeach; ?>
                </ul>
            </aside>
        </div>
    </section>

    <section class="section about-snapshot-section">
        <div class="container">
            <div class="section-title" data-reveal>
                <p class="section-eyebrow">Company Snapshot</p>
                <h2>What Makes Our Team Reliable</h2>
                <p>Built with a service-first mindset for modern home and business printing requirements.</p>
            </div>
            <div class="about-snapshot-grid">
                <?php foreach ($aboutStats as $item): ?>
                    <article class="about-snapshot-card" data-reveal>
                        <strong
                            data-count-up
                            data-target="<?= e((string) $item['target']); ?>"
                            data-suffix="<?= e((string) ($item['suffix'] ?? '')); ?>"
                            <?php if (!empty($item['decimals'])): ?>
                                data-decimals="<?= e((string) $item['decimals']); ?>"
                            <?php endif; ?>
                            <?php if (!empty($item['thousands'])): ?>
                                data-thousands="true"
                            <?php endif; ?>
                        >0</strong>
                        <span><?= e($item['label']); ?></span>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section-light about-story-section">
        <div class="container">
            <div class="section-title" data-reveal>
                <p class="section-eyebrow">Our Story</p>
                <h2>Why We Started</h2>
            </div>
            <article class="about-story-card" data-reveal>
                <div class="about-story-copy">
                    <?php foreach ($storyParagraphs as $paragraph): ?>
                        <p><?= e($paragraph); ?></p>
                    <?php endforeach; ?>
                </div>
            </article>
        </div>
    </section>

    <section class="section about-trust-section">
        <div class="container">
            <div class="section-title" data-reveal>
                <p class="section-eyebrow">Why Trust Us</p>
                <h2>WHY TRUST US</h2>
            </div>
            <article class="about-governance-card" data-reveal>
                <ul class="about-governance-list about-trust-list">
                    <?php foreach ($trustPoints as $point): ?>
                        <li>
                            <i class="ri-checkbox-circle-line" aria-hidden="true"></i>
                            <span><?= e($point); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </article>
        </div>
    </section>

    <section class="section section-light about-mission-section">
        <div class="container">
            <div class="section-title" data-reveal>
                <p class="section-eyebrow">Mission &amp; Vision</p>
                <h2>MISSION &amp; VISION</h2>
            </div>

            <div class="about-mission-grid">
                <?php foreach ($missionVision as $item): ?>
                    <article class="about-mission-card" data-reveal>
                        <p class="section-eyebrow"><?= e($item['label']); ?></p>
                        <h3><?= e($item['label']); ?></h3>
                        <p><?= e($item['title']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section section-light about-work-section">
        <div class="container">
            <div class="section-title" data-reveal>
                <p class="section-eyebrow">How We Work</p>
                <h2>HOW WE WORK</h2>
            </div>

            <div class="about-process-grid">
                <?php foreach ($aboutProcess as $item): ?>
                    <article class="about-process-card" data-reveal>
                        <span class="about-process-step"><?= e($item['step']); ?></span>
                        <h3><?= e($item['title']); ?></h3>
                        <p><?= e($item['text']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section about-values-section">
        <div class="container">
            <div class="section-title" data-reveal>
                <p class="section-eyebrow">Core Values</p>
                <h2>CORE VALUES</h2>
            </div>

            <div class="about-values-grid">
                <?php foreach ($aboutValues as $value): ?>
                    <article class="about-value-card" data-reveal>
                        <div class="about-value-icon" aria-hidden="true">
                            <i class="<?= e($value['icon']); ?>"></i>
                        </div>
                        <h3><?= e($value['title']); ?></h3>
                        <p><?= e($value['text']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section about-final-section">
        <div class="container">
            <article class="about-corporate-cta" data-reveal>
                <div>
                    <p class="section-eyebrow section-eyebrow--light">Final CTA</p>
                    <h2>Need Help Choosing the Right Printer?</h2>
                    <p>Talk to our experts and get the best recommendation for your needs.</p>
                </div>
                <div class="about-corporate-actions">
                    <a class="btn btn-primary" href="contact.php">Contact Us</a>
                    <a class="btn btn-outline" href="printers.php">Explore Products</a>
                </div>
            </article>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
