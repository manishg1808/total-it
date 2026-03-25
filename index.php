<?php
declare(strict_types=1);

require __DIR__ . '/includes/site-data.php';
require __DIR__ . '/includes/cart.php';

$currentPage = 'home';
$pageTitle = $company['name'] . ' | Home';
$pageDescription = 'Shop premium printers with a clean and professional shopping experience.';
$brandLogos = [
    'hp' => 'images/brands/hp.svg',
    'canon' => 'images/brands/canon.png',
    'brother' => 'images/brands/brother.png',
    'epson' => 'images/brands/epson.svg',
];
$homeBestSellerProductIds = [1, 2, 3, 4];
$cartNotice = cartPullNotice();

require __DIR__ . '/includes/header.php';
?>

<main class="home-main">
    <?php if ($cartNotice !== null): ?>
        <div class="container">
            <p class="cart-notice"><?= e($cartNotice); ?></p>
        </div>
    <?php endif; ?>
    <section class="hero hero-banner">
        <div class="container">
            <article class="banner-card" data-reveal>
                <img class="banner-image" src="images/banner.jpg" alt="Professional printer shopping banner">
                <div class="banner-overlay"></div>
                <div class="banner-content">
                    <div class="banner-copy">
                        <p class="section-eyebrow section-eyebrow--light">Trusted Printer Store for Home, Office, and Business</p>
                        <h1>Find the Perfect Printer for Your Needs</h1>
                        <p class="lead">
                            <span>Shop reliable printers with clean pricing, genuine products, and smooth delivery.</span>
                            <span>Get the right model faster with expert guidance and trusted after-sales support.</span>
                        </p>
                        <div class="banner-metrics banner-metrics--inline">
                            <article>
                                <strong data-count-up data-target="120" data-prefix="" data-suffix="+">0</strong>
                                <span>Printer Models</span>
                            </article>
                            <article>
                                <strong data-count-up data-target="98" data-prefix="" data-suffix="%">0</strong>
                                <span>Happy Customers</span>
                            </article>
                            <article>
                                <strong data-count-up data-target="24" data-prefix="&lt;" data-suffix="h">0</strong>
                                <span>Dispatch Window</span>
                            </article>
                        </div>
                        <div class="banner-highlights">
                            <span>Official Warranty</span>
                            <span>Secure Payments</span>
                            <span>Expert Guidance</span>
                        </div>
                        <div class="hero-buttons">
                            <a href="printers.php" class="btn btn-primary">Shop Now</a>
                            <a href="printers.php" class="btn btn-outline">Get Recommendation</a>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>

    <section class="section brand-strip-section">
        <div class="container">
            <article class="brand-strip" data-reveal>
                <div class="brand-strip-copy">
                    <span class="dealer-badge dealer-badge--featured">
                        <i class="ri-verified-badge-line" aria-hidden="true"></i>
                        Authorized Dealer
                    </span>
                    <h2>Buy from Official Printer Partners</h2>
                    <p>Get genuine models, official warranty support, and safer post-sales service directly from trusted brands.</p>
                    <div class="dealer-note">
                        <i class="ri-shield-check-line" aria-hidden="true"></i>
                        <span>Every listed brand includes verified sourcing and invoice-backed purchase.</span>
                    </div>
                </div>
                <div class="brand-strip-grid" aria-label="Printer brands">
                    <a class="brand-tile" href="brand.php?brand=hp">
                        <img src="<?= e($brandLogos['hp']); ?>" alt="HP logo" loading="lazy">
                        <i class="ri-arrow-right-up-line" aria-hidden="true"></i>
                    </a>
                    <a class="brand-tile" href="brand.php?brand=canon">
                        <img src="<?= e($brandLogos['canon']); ?>" alt="Canon logo" loading="lazy">
                        <i class="ri-arrow-right-up-line" aria-hidden="true"></i>
                    </a>
                    <a class="brand-tile" href="brand.php?brand=brother">
                        <img src="<?= e($brandLogos['brother']); ?>" alt="Brother logo" loading="lazy">
                        <i class="ri-arrow-right-up-line" aria-hidden="true"></i>
                    </a>
                    <a class="brand-tile" href="brand.php?brand=epson">
                        <img src="<?= e($brandLogos['epson']); ?>" alt="Epson logo" loading="lazy">
                        <i class="ri-arrow-right-up-line" aria-hidden="true"></i>
                    </a>
                </div>
            </article>
        </div>
    </section>

    <section class="section bestseller-section">
        <div class="container">
            <div class="section-title split-title" data-reveal>
                <div>
                    <p class="section-eyebrow">Best Seller</p>
                    <h2>Most Loved Printers Right Now</h2>
                </div>
                <a class="link-inline" href="printers.php">Browse Full Collection</a>
            </div>

            <div class="bestseller-layout">
                <?php $featuredBestSeller = $products[0]; ?>
                <?php
                $featuredNameParts = explode(' ', $featuredBestSeller['name']);
                $featuredBrand = $featuredNameParts[0];
                $featuredBrandKey = strtolower($featuredBrand);
                $featuredPrice = (string) $featuredBestSeller['price'];
                ?>
                <article class="bestseller-feature" data-reveal>
                    <div class="bestseller-feature-image" aria-hidden="true">
                        <i class="ri-printer-line"></i>
                        <span>Image</span>
                    </div>
                    <div class="bestseller-feature-copy">
                        <div class="bestseller-brand-row">
                            <img class="bestseller-brand-logo" src="<?= e($brandLogos[$featuredBrandKey] ?? 'images/logo-printer.png'); ?>" alt="<?= e($featuredBrand); ?> logo" loading="lazy">
                            <span class="bestseller-rating">&#9733; <?= e($featuredBestSeller['rating']); ?></span>
                        </div>
                        <h3><?= e($featuredBestSeller['name']); ?></h3>
                        <p class="bestseller-price"><?= e($featuredPrice); ?></p>
                        <div class="bestseller-card-actions">
                            <form class="bestseller-add-form" action="cart-actions.php" method="post">
                                <input type="hidden" name="action" value="add">
                                <input type="hidden" name="product_id" value="<?= e((string) $homeBestSellerProductIds[0]); ?>">
                                <input type="hidden" name="redirect" value="index.php">
                                <button class="btn btn-primary btn-sm" type="submit">Add to Cart</button>
                            </form>
                            <a class="bestseller-view-link" href="printers.php">
                                View Detail
                                <i class="ri-arrow-right-line" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </article>

                <div class="bestseller-list">
                    <?php foreach (array_slice($products, 1, 2) as $index => $product): ?>
                        <?php
                        $nameParts = explode(' ', $product['name']);
                        $brandName = $nameParts[0];
                        $brandKey = strtolower($brandName);
                        $displayPrice = (string) $product['price'];
                        $homeProductId = $homeBestSellerProductIds[$index + 1] ?? 1;
                        ?>
                        <article class="bestseller-mini-card" data-reveal>
                            <div class="bestseller-mini-image" aria-hidden="true">
                                <i class="ri-printer-line"></i>
                                <span>Image</span>
                            </div>
                            <div class="bestseller-mini-copy">
                                <div class="bestseller-brand-row">
                                    <img class="bestseller-brand-logo" src="<?= e($brandLogos[$brandKey] ?? 'images/logo-printer.png'); ?>" alt="<?= e($brandName); ?> logo" loading="lazy">
                                    <span class="bestseller-rating">&#9733; <?= e($product['rating']); ?></span>
                                </div>
                                <h3><?= e($product['name']); ?></h3>
                                <p class="bestseller-price"><?= e($displayPrice); ?></p>
                                <div class="bestseller-card-actions">
                                    <form class="bestseller-add-form" action="cart-actions.php" method="post">
                                        <input type="hidden" name="action" value="add">
                                        <input type="hidden" name="product_id" value="<?= e((string) $homeProductId); ?>">
                                        <input type="hidden" name="redirect" value="index.php">
                                        <button class="btn btn-primary btn-sm" type="submit">Add to Cart</button>
                                    </form>
                                    <a class="bestseller-view-link" href="printers.php">
                                        View Detail
                                        <i class="ri-arrow-right-line" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>

                    <article class="bestseller-mini-card" data-reveal>
                        <div class="bestseller-mini-image" aria-hidden="true">
                            <i class="ri-printer-line"></i>
                            <span>Image</span>
                        </div>
                        <div class="bestseller-mini-copy">
                            <div class="bestseller-brand-row">
                                <img class="bestseller-brand-logo" src="<?= e($brandLogos['brother']); ?>" alt="Brother logo" loading="lazy">
                                <span class="bestseller-rating">&#9733; 4.7</span>
                            </div>
                            <h3>Brother HL-L2370DW</h3>
                            <p class="bestseller-price">$319.00</p>
                            <div class="bestseller-card-actions">
                                <form class="bestseller-add-form" action="cart-actions.php" method="post">
                                    <input type="hidden" name="action" value="add">
                                    <input type="hidden" name="product_id" value="<?= e((string) $homeBestSellerProductIds[3]); ?>">
                                    <input type="hidden" name="redirect" value="index.php">
                                    <button class="btn btn-primary btn-sm" type="submit">Add to Cart</button>
                                </form>
                                <a class="bestseller-view-link" href="printers.php">
                                    View Detail
                                    <i class="ri-arrow-right-line" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="section printer-category-section">
        <div class="container">
            <div class="printer-category-head section-title" data-reveal>
                <h2>Shop Printers by Category</h2>
                <p>Pick the perfect printer for home or office with genuine warranty support.</p>
            </div>

            <div class="printer-category-grid">
                <a class="printer-category-card" href="printers.php" data-reveal>
                    <h3>Home Printers</h3>
                    <p>Best for home &amp; personal use</p>
                </a>

                <a class="printer-category-card" href="printers.php" data-reveal>
                    <h3>Office Printers</h3>
                    <p>Reliable printers for office work</p>
                </a>

                <a class="printer-category-card" href="printers.php" data-reveal>
                    <h3>Inkjet Printers</h3>
                    <p>Great for photos &amp; color printing</p>
                </a>

                <a class="printer-category-card" href="printers.php" data-reveal>
                    <h3>Laser Printers</h3>
                    <p>Fast, efficient &amp; cost-effective</p>
                </a>
            </div>
        </div>
    </section>

    <section class="section home-stats-section">
        <div class="container">
            <div class="why-stats-grid">
                <article class="why-stat-card" data-reveal>
                    <strong data-count-up data-target="10000" data-suffix="+">0</strong>
                    <span>Happy Customers</span>
                </article>
                <article class="why-stat-card" data-reveal>
                    <strong data-count-up data-target="500" data-suffix="+">0</strong>
                    <span>Printers Sold</span>
                </article>
                <article class="why-stat-card" data-reveal>
                    <strong>4.8&#9733;</strong>
                    <span>Average Rating</span>
                </article>
                <article class="why-stat-card" data-reveal>
                    <strong>24/7</strong>
                    <span>Support</span>
                </article>
            </div>
        </div>
    </section>

    <section class="section why-choose-section">
        <div class="container">
            <div class="section-title why-choose-head" data-reveal>
                <p class="section-eyebrow">Why Choose Us</p>
                <h2>Shop with Confidence, Not Confusion</h2>
                <p>Built to earn trust from the first visit with genuine products, faster delivery, clear support, and secure checkout.</p>
            </div>

            <div class="why-visual-grid">
                <article class="why-visual-card" data-reveal>
                    <div class="why-card-icon" aria-hidden="true">
                        <i class="ri-printer-line"></i>
                    </div>
                    <h3>100% Genuine Printers</h3>
                    <ul class="why-card-points">
                        <li>Direct from brand (HP / Canon)</li>
                    </ul>
                </article>

                <article class="why-visual-card" data-reveal>
                    <div class="why-card-icon" aria-hidden="true">
                        <i class="ri-truck-line"></i>
                    </div>
                    <h3>Fast &amp; Safe Delivery</h3>
                    <ul class="why-card-points">
                        <li>2-5 days shipping</li>
                        <li>Damage protection</li>
                    </ul>
                </article>

                <article class="why-visual-card" data-reveal>
                    <div class="why-card-icon" aria-hidden="true">
                        <i class="ri-bank-card-line"></i>
                    </div>
                    <h3>Secure Payments</h3>
                    <ul class="why-card-points">
                        <li>UPI / Card / EMI</li>
                        <li>SSL protected</li>
                    </ul>
                </article>

                <article class="why-visual-card" data-reveal>
                    <div class="why-card-icon" aria-hidden="true">
                        <i class="ri-customer-service-2-line"></i>
                    </div>
                    <h3>Expert Support</h3>
                    <ul class="why-card-points">
                        <li>Real human help</li>
                        <li>Printer selection guidance</li>
                    </ul>
                </article>
            </div>

            <div class="why-pre-cta">
                <article class="home-cta-card" data-reveal>
                    <div class="home-cta-copy">
                        <p class="section-eyebrow section-eyebrow--light">Fast Recommendation</p>
                        <h2>Need Help Choosing the Right Printer?</h2>
                        <p>Tell us your monthly print volume, color needs, and budget. Our team will suggest the best-fit models quickly.</p>
                        <div class="hero-buttons">
                            <a class="btn btn-primary" href="printers.php">Get Free Consultation</a>
                            <a class="btn btn-outline" href="printers.php">Explore All Printers</a>
                        </div>
                    </div>

                    <div class="home-cta-points">
                        <article>
                            <strong>Budget Friendly Options</strong>
                            <span>Filtered picks for home, office, and business use.</span>
                        </article>
                        <article>
                            <strong>Real Human Support</strong>
                            <span>No bot-only flow, direct expert guidance available.</span>
                        </article>
                        <article>
                            <strong>Quick Response Window</strong>
                            <span>Recommendation support within business hours.</span>
                        </article>
                    </div>
                </article>
            </div>

            <article class="how-works-card" data-reveal>
                <div class="how-works-head">
                    <h3>How It Works</h3>
                    <p>A simple and transparent process</p>
                </div>

                <div class="how-works-grid">
                    <article class="how-step-item" data-reveal>
                        <span class="how-step-no">01</span>
                        <h4>Submit Request</h4>
                        <p>Share your printer details and contact information.</p>
                    </article>

                    <article class="how-step-item" data-reveal>
                        <span class="how-step-no">02</span>
                        <h4>Request Review</h4>
                        <p>Our team reviews your request and requirements.</p>
                    </article>

                    <article class="how-step-item" data-reveal>
                        <span class="how-step-no">03</span>
                        <h4>Follow-Up</h4>
                        <p>You&apos;ll be contacted with next steps or clarifications.</p>
                    </article>

                    <article class="how-step-item" data-reveal>
                        <span class="how-step-no">04</span>
                        <h4>Assistance</h4>
                        <p>Guidance is provided based on your request.</p>
                    </article>
                </div>
            </article>

            <article class="why-compare-card" data-reveal>
                <div class="why-compare-head">
                    <h3>Trust Snapshot</h3>
                    <p>Compare both sides in seconds and choose the safer option with confidence.</p>
                </div>
                <div class="why-compare-grid" aria-label="Comparison between others and us">
                    <article class="trust-column trust-column--others">
                        <h4>Others</h4>
                        <ul class="trust-list">
                            <li><i class="ri-close-circle-line" aria-hidden="true"></i>Fake products</li>
                            <li><i class="ri-close-circle-line" aria-hidden="true"></i>Slow delivery</li>
                            <li><i class="ri-close-circle-line" aria-hidden="true"></i>No support</li>
                            <li><i class="ri-close-circle-line" aria-hidden="true"></i>Confusing choice</li>
                        </ul>
                    </article>

                    <article class="trust-column trust-column--us">
                        <h4>Us</h4>
                        <ul class="trust-list">
                            <li><i class="ri-checkbox-circle-line" aria-hidden="true"></i>Genuine brands</li>
                            <li><i class="ri-checkbox-circle-line" aria-hidden="true"></i>Fast shipping</li>
                            <li><i class="ri-checkbox-circle-line" aria-hidden="true"></i>Expert help</li>
                            <li><i class="ri-checkbox-circle-line" aria-hidden="true"></i>Smart finder</li>
                        </ul>
                    </article>
                </div>
            </article>

        </div>
    </section>

    <section class="section final-cta">
        <div class="container">
            <article class="cta-inner" data-reveal>
                <div class="cta-copy">
                    <p class="section-eyebrow section-eyebrow--light">Ready to Buy</p>
                    <h2>Get the Right Printer Without Guesswork</h2>
                    <p>Share your budget and print needs once. We will help you choose a model that truly fits your home or office setup.</p>
                    <div class="cta-benefits">
                        <span><i class="ri-verified-badge-line" aria-hidden="true"></i>Genuine Warranty Units</span>
                        <span><i class="ri-truck-line" aria-hidden="true"></i>Fast Delivery</span>
                        <span><i class="ri-secure-payment-line" aria-hidden="true"></i>Secure Checkout</span>
                    </div>
                </div>

                <aside class="cta-actions-card">
                    <p class="cta-actions-label">Quick Start</p>
                    <h3>Talk to a Printer Expert</h3>
                    <p>No confusing options. Get clear recommendations in minutes.</p>
                    <div class="hero-buttons">
                        <a class="btn btn-primary" href="printers.php">Get Recommendation</a>
                        <a class="btn btn-outline" href="printers.php">Browse Printers</a>
                    </div>
                    <div class="cta-meta">
                        <article>
                            <strong>10,000+</strong>
                            <span>Happy Customers</span>
                        </article>
                        <article>
                            <strong>4.8&#9733;</strong>
                            <span>Average Rating</span>
                        </article>
                    </div>
                </aside>
            </article>
        </div>
    </section>

    <form class="floating-search-bar" data-floating-search action="printers.php" method="get" aria-label="Quick product search">
        <i class="ri-search-line" aria-hidden="true"></i>
        <input type="search" name="q" placeholder="Search printer model, brand, or category">
        <button type="submit">Search</button>
    </form>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
