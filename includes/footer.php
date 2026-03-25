<?php
declare(strict_types=1);
?>
    <footer class="footer">
        <div class="container">
            <section class="footer-cta">
                <div>
                    <p class="section-eyebrow section-eyebrow--light">Stay Updated</p>
                    <h3>Get Deals, Product Updates, and Buying Tips</h3>
                    <p>Join our newsletter and receive curated printer recommendations and weekly offers.</p>
                </div>
                <form action="#" method="post" class="footer-subscribe">
                    <input type="email" name="email" placeholder="Enter your email">
                    <button class="btn btn-primary" type="submit">Subscribe</button>
                </form>
            </section>

            <div class="footer-grid">
                <div>
                    <h3><?= e($company['name']); ?></h3>
                    <p>Professional shopping destination for home and business printers with trusted support.</p>
                </div>

                <div>
                    <h4>Orders</h4>
                    <a href="#">Track Your Order</a>
                    <a href="#">Return Your Order</a>
                    <a href="printers.php">Shop Printers</a>
                    <a href="contact.php">Customer Support</a>
                    <a href="contact.php">Book an Appointment</a>
                </div>

                <div>
                    <h4>Company</h4>
                    <a href="index.php">Home</a>
                    <a href="printers.php">Printers</a>
                    <a href="about.php">About Us</a>
                    <a href="contact.php">Contact</a>
                </div>

                <div>
                    <h4>Policies</h4>
                    <button class="footer-link-button" type="button" data-policy-open>Privacy Policy</button>
                    <button class="footer-link-button" type="button" data-terms-open>Terms &amp; Conditions</button>
                    <button class="footer-link-button" type="button" data-shipping-open>Shipping Policy</button>
                    <button class="footer-link-button" type="button" data-refund-open>Refund Policy</button>
                </div>

                <div>
                    <h4>Contact</h4>
                    <p><?= e($company['address']); ?></p>
                    <a href="tel:+18338178854"><?= e($company['phone']); ?></a>
                    <a href="mailto:<?= e($company['email']); ?>"><?= e($company['email']); ?></a>
                    <p><?= e($company['hours']); ?></p>
                </div>
            </div>
        </div>
        <div class="container footer-bottom">
            <p>&copy; <?= e($year); ?> <?= e($company['name']); ?>. All rights reserved.</p>
        </div>
    </footer>

    <div class="policy-modal" data-policy-modal hidden>
        <div class="policy-modal__backdrop" data-policy-close></div>
        <div class="policy-modal__panel" role="dialog" aria-modal="true" aria-labelledby="privacy-policy-title">
            <div class="policy-modal__header">
                <div class="policy-modal__title">
                    <p class="policy-modal__label">Data Protection</p>
                    <h3 id="privacy-policy-title">Privacy Policy</h3>
                </div>
                <div class="policy-modal__actions">
                    <button class="policy-modal__icon-btn" type="button" aria-label="Print Privacy Policy" data-policy-print>
                        <svg viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                            <path d="M7 8V3h10v5H7zm8-3H9v1h6V5zm4 5a3 3 0 0 1 3 3v4h-4v4H6v-4H2v-4a3 3 0 0 1 3-3h14zm-3 9v-5H8v5h8zm2-4h2v-2a1 1 0 0 0-1-1h-1v3z"></path>
                        </svg>
                    </button>
                    <button class="policy-modal__icon-btn" type="button" aria-label="Close Privacy Policy" data-policy-close>
                        <span>&times;</span>
                    </button>
                </div>
            </div>
            <div class="policy-modal__body">
                <div class="policy-modal__content" data-policy-content>
                    Privacy Policy content loading...
                </div>
            </div>
        </div>
    </div>

    <div class="policy-modal policy-modal--refund" data-refund-modal hidden>
        <div class="policy-modal__backdrop" data-refund-close></div>
        <div class="policy-modal__panel" role="dialog" aria-modal="true" aria-labelledby="refund-policy-title">
            <div class="policy-modal__header">
                <div class="policy-modal__title">
                    <p class="policy-modal__label">Returns &amp; Exchanges</p>
                    <h3 id="refund-policy-title">Refund Policy</h3>
                </div>
                <div class="policy-modal__actions">
                    <button class="policy-modal__icon-btn" type="button" aria-label="Print Refund Policy" data-refund-print>
                        <svg viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                            <path d="M7 8V3h10v5H7zm8-3H9v1h6V5zm4 5a3 3 0 0 1 3 3v4h-4v4H6v-4H2v-4a3 3 0 0 1 3-3h14zm-3 9v-5H8v5h8zm2-4h2v-2a1 1 0 0 0-1-1h-1v3z"></path>
                        </svg>
                    </button>
                    <button class="policy-modal__icon-btn" type="button" aria-label="Close Refund Policy" data-refund-close>
                        <span>&times;</span>
                    </button>
                </div>
            </div>
            <div class="policy-modal__body">
                <div class="policy-modal__content" data-refund-content>
                    Refund Policy content loading...
                </div>
            </div>
        </div>
    </div>

    <div class="policy-modal policy-modal--shipping" data-shipping-modal hidden>
        <div class="policy-modal__backdrop" data-shipping-close></div>
        <div class="policy-modal__panel" role="dialog" aria-modal="true" aria-labelledby="shipping-policy-title">
            <div class="policy-modal__header">
                <div class="policy-modal__title">
                    <p class="policy-modal__label">Logistics &amp; Delivery</p>
                    <h3 id="shipping-policy-title">Shipping Policy</h3>
                </div>
                <div class="policy-modal__actions">
                    <button class="policy-modal__icon-btn" type="button" aria-label="Print Shipping Policy" data-shipping-print>
                        <svg viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                            <path d="M7 8V3h10v5H7zm8-3H9v1h6V5zm4 5a3 3 0 0 1 3 3v4h-4v4H6v-4H2v-4a3 3 0 0 1 3-3h14zm-3 9v-5H8v5h8zm2-4h2v-2a1 1 0 0 0-1-1h-1v3z"></path>
                        </svg>
                    </button>
                    <button class="policy-modal__icon-btn" type="button" aria-label="Close Shipping Policy" data-shipping-close>
                        <span>&times;</span>
                    </button>
                </div>
            </div>
            <div class="policy-modal__body">
                <div class="policy-modal__content" data-shipping-content>
                    Shipping Policy content loading...
                </div>
            </div>
        </div>
    </div>

    <div class="policy-modal policy-modal--terms" data-terms-modal hidden>
        <div class="policy-modal__backdrop" data-terms-close></div>
        <div class="policy-modal__panel" role="dialog" aria-modal="true" aria-labelledby="terms-policy-title">
            <div class="policy-modal__header">
                <div class="policy-modal__title">
                    <p class="policy-modal__label">Legal Agreement</p>
                    <h3 id="terms-policy-title">Terms &amp; Conditions</h3>
                </div>
                <div class="policy-modal__actions">
                    <button class="policy-modal__icon-btn" type="button" aria-label="Print Terms and Conditions" data-terms-print>
                        <svg viewBox="0 0 24 24" focusable="false" aria-hidden="true">
                            <path d="M7 8V3h10v5H7zm8-3H9v1h6V5zm4 5a3 3 0 0 1 3 3v4h-4v4H6v-4H2v-4a3 3 0 0 1 3-3h14zm-3 9v-5H8v5h8zm2-4h2v-2a1 1 0 0 0-1-1h-1v3z"></path>
                        </svg>
                    </button>
                    <button class="policy-modal__icon-btn" type="button" aria-label="Close Terms and Conditions" data-terms-close>
                        <span>&times;</span>
                    </button>
                </div>
            </div>
            <div class="policy-modal__body">
                <div class="policy-modal__content" data-terms-content>
                    Terms and Conditions content loading...
                </div>
            </div>
        </div>
    </div>

    <div class="policy-modal policy-modal--appointment" data-appointment-modal hidden>
        <div class="policy-modal__backdrop" data-appointment-close></div>
        <div class="policy-modal__panel appointment-modal-panel" role="dialog" aria-modal="true" aria-labelledby="appointment-title">
            <div class="policy-modal__header">
                <div class="policy-modal__title">
                    <p class="policy-modal__label">Quick Consultation</p>
                    <h3 id="appointment-title">Request an Appointment</h3>
                    <p class="appointment-subtitle">Fill in your details below. Our team will review your request and get back to you via email or phone.</p>
                </div>
                <div class="policy-modal__actions">
                    <button class="policy-modal__icon-btn" type="button" aria-label="Close Appointment Form" data-appointment-close>
                        <span>&times;</span>
                    </button>
                </div>
            </div>
            <div class="policy-modal__body">
                <form class="appointment-form" data-appointment-form>
                    <div class="appointment-form-grid">
                        <div class="appointment-field">
                            <label for="appointment-name">Full Name</label>
                            <input id="appointment-name" name="name" type="text" placeholder="Enter your name">
                        </div>

                        <div class="appointment-field">
                            <label for="appointment-email">Email Address *</label>
                            <input id="appointment-email" name="email" type="email" placeholder="Enter your email" required>
                        </div>

                        <div class="appointment-field">
                            <label for="appointment-phone">Phone Number *</label>
                            <input id="appointment-phone" name="phone" type="tel" placeholder="Enter phone number" required>
                        </div>

                        <div class="appointment-field">
                            <label for="appointment-model">Printer Model</label>
                            <input id="appointment-model" name="model" type="text" placeholder="Enter model number">
                        </div>

                        <div class="appointment-field appointment-field--full">
                            <label for="appointment-message">Message</label>
                            <textarea id="appointment-message" name="message" placeholder="Write your requirement or query"></textarea>
                        </div>
                    </div>

                    <button class="btn btn-primary appointment-submit" type="submit">Submit Request</button>
                    <p class="appointment-status" data-appointment-status hidden>Thanks! Your appointment request has been submitted.</p>
                </form>
            </div>
        </div>
    </div>

    <button class="scroll-top-btn" type="button" aria-label="Scroll to top" data-scroll-top>
        <i class="ri-arrow-up-line" aria-hidden="true"></i>
    </button>

    <script src="assets/js/main.js"></script>
</body>
</html>
