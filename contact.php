<?php
declare(strict_types=1);

require __DIR__ . '/includes/site-data.php';
require __DIR__ . '/includes/cart.php';

$currentPage = 'contact';
$pageTitle = $company['name'] . ' | Contact';
$pageDescription = 'Get in touch for recommendations, orders, and purchase support.';

$contactFormValues = [
    'name' => '',
    'email' => '',
    'phone' => '',
    'topic' => 'Product Recommendation',
    'message' => '',
];

$contactFormError = null;
$contactFormSuccess = null;
$cartNotice = cartPullNotice();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contactFormValues['name'] = trim((string) ($_POST['name'] ?? ''));
    $contactFormValues['email'] = trim((string) ($_POST['email'] ?? ''));
    $contactFormValues['phone'] = trim((string) ($_POST['phone'] ?? ''));
    $contactFormValues['topic'] = trim((string) ($_POST['topic'] ?? 'Product Recommendation'));
    $contactFormValues['message'] = trim((string) ($_POST['message'] ?? ''));

    if ($contactFormValues['name'] === '' || $contactFormValues['email'] === '' || $contactFormValues['phone'] === '') {
        $contactFormError = 'Please fill all required fields: Name, Email, and Phone.';
    } elseif (!filter_var($contactFormValues['email'], FILTER_VALIDATE_EMAIL)) {
        $contactFormError = 'Please enter a valid email address.';
    } else {
        $contactFormSuccess = 'Thanks! Your request has been submitted successfully. Our team will contact you soon.';
        $contactFormValues = [
            'name' => '',
            'email' => '',
            'phone' => '',
            'topic' => 'Product Recommendation',
            'message' => '',
        ];
    }
}

require __DIR__ . '/includes/header.php';
?>

<main>
    <?php if ($cartNotice !== null): ?>
        <div class="container">
            <p class="cart-notice"><?= e($cartNotice); ?></p>
        </div>
    <?php endif; ?>

    <section class="contact-hero">
        <div class="container contact-hero-grid">
            <div class="contact-hero-copy" data-reveal>
                <p class="section-eyebrow">Contact Desk</p>
                <h1>Talk to Our <span>Enterprise Printer Specialists</span></h1>
                <p>Need help choosing a model, placing a business order, or checking technical compatibility? Our team will guide you with clear and fast recommendations.</p>
                <div class="contact-hero-tags">
                    <span><i class="ri-time-line" aria-hidden="true"></i> Fast Business Response</span>
                    <span><i class="ri-shield-check-line" aria-hidden="true"></i> Verified Purchase Support</span>
                    <span><i class="ri-customer-service-2-line" aria-hidden="true"></i> Real Human Assistance</span>
                </div>
            </div>

            <article class="contact-hero-card" data-reveal>
                <h3>Service Availability</h3>
                <div class="contact-hero-metrics">
                    <article>
                        <strong>24h</strong>
                        <span>First response target</span>
                    </article>
                    <article>
                        <strong>Mon-Sat</strong>
                        <span>Dedicated support window</span>
                    </article>
                    <article>
                        <strong>1:1</strong>
                        <span>Recommendation guidance</span>
                    </article>
                </div>
                <p>For urgent procurement and model selection, call us directly for priority routing.</p>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="container contact-corp-layout">
            <aside class="contact-info-panel" data-reveal>
                <h2>Dedicated Support Channels</h2>
                <p>Reach the right desk faster for pre-sales, procurement, and post-purchase assistance.</p>

                <div class="contact-panel-highlights">
                    <article>
                        <i class="ri-timer-line" aria-hidden="true"></i>
                        <div>
                            <strong>24h</strong>
                            <span>Primary response target</span>
                        </div>
                    </article>
                    <article>
                        <i class="ri-customer-service-2-line" aria-hidden="true"></i>
                        <div>
                            <strong>Mon-Sat</strong>
                            <span>Active support coverage</span>
                        </div>
                    </article>
                </div>

                <div class="contact-info-grid">
                    <article class="contact-info-card">
                        <i class="ri-phone-line" aria-hidden="true"></i>
                        <div>
                            <h3>Phone Support</h3>
                            <a href="tel:+18338178854"><?= e($company['phone']); ?></a>
                        </div>
                    </article>

                    <article class="contact-info-card">
                        <i class="ri-mail-line" aria-hidden="true"></i>
                        <div>
                            <h3>Email Desk</h3>
                            <a href="mailto:<?= e($company['email']); ?>"><?= e($company['email']); ?></a>
                        </div>
                    </article>

                    <article class="contact-info-card">
                        <i class="ri-map-pin-2-line" aria-hidden="true"></i>
                        <div>
                            <h3>Office Address</h3>
                            <p><?= e($company['address']); ?></p>
                        </div>
                    </article>

                    <article class="contact-info-card">
                        <i class="ri-calendar-check-line" aria-hidden="true"></i>
                        <div>
                            <h3>Business Hours</h3>
                            <p><?= e($company['hours']); ?></p>
                        </div>
                    </article>
                </div>

                <article class="contact-escalation-note">
                    <h4>Enterprise Orders &amp; Escalations</h4>
                    <p>For bulk requirements and deployment assistance, mention your expected volume in the form for faster routing.</p>
                </article>
            </aside>

            <div class="contact-form-panel" data-reveal>
                <div class="contact-form-head">
                    <span class="contact-form-badge">Business Enquiry Form</span>
                    <h2>Send Your Requirement</h2>
                    <p>Share your need and our experts will connect with the best-fit recommendation.</p>
                </div>

                <?php if ($contactFormError !== null): ?>
                    <p class="form-alert form-alert--error"><?= e($contactFormError); ?></p>
                <?php endif; ?>
                <?php if ($contactFormSuccess !== null): ?>
                    <p class="form-alert form-alert--success"><?= e($contactFormSuccess); ?></p>
                <?php endif; ?>

                <form action="contact.php" method="post" class="contact-corporate-form">
                    <div class="contact-form-row">
                        <div class="contact-field">
                            <label for="contact-name">Full Name</label>
                            <input id="contact-name" name="name" type="text" placeholder="Enter your full name" value="<?= e($contactFormValues['name']); ?>" required>
                        </div>

                        <div class="contact-field">
                            <label for="contact-email">Email</label>
                            <input id="contact-email" name="email" type="email" placeholder="Enter your email address" value="<?= e($contactFormValues['email']); ?>" required>
                        </div>
                    </div>

                    <div class="contact-form-row">
                        <div class="contact-field">
                            <label for="contact-phone">Phone</label>
                            <input id="contact-phone" name="phone" type="tel" placeholder="Enter your phone number" value="<?= e($contactFormValues['phone']); ?>" required>
                        </div>

                        <div class="contact-field">
                            <label for="contact-topic">Purpose</label>
                            <select id="contact-topic" name="topic">
                                <?php
                                $contactTopics = ['Product Recommendation', 'Order Support', 'Bulk Purchase', 'Warranty Query'];
                                foreach ($contactTopics as $topicOption):
                                    $isSelected = $contactFormValues['topic'] === $topicOption;
                                ?>
                                    <option value="<?= e($topicOption); ?>" <?= $isSelected ? 'selected' : ''; ?>><?= e($topicOption); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <label for="contact-message">Message</label>
                    <textarea id="contact-message" name="message" rows="5" placeholder="Share your printer requirement..."><?= e($contactFormValues['message']); ?></textarea>

                    <div class="contact-form-actions">
                        <button class="btn btn-primary" type="submit">Submit Request</button>
                        <p>Response target: within one business day.</p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
