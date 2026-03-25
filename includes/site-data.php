<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$company = [
    'name' => 'Total IT Assist INC',
    'email' => 'support@totalitassistinc.com',
    'phone' => '+1-833-817-8854',
    'address' => '946 Ferm Ave, Orlando, Florida 32814-6098',
    'hours' => 'Mon - Sat, 9:00 AM to 7:00 PM',
];

$navLinks = [
    ['label' => 'Home', 'href' => 'index.php', 'key' => 'home'],
    ['label' => 'Printers', 'href' => 'printers.php', 'key' => 'printers'],
    ['label' => 'About', 'href' => 'about.php', 'key' => 'about'],
    ['label' => 'Contact', 'href' => 'contact.php', 'key' => 'contact'],
];

$categories = [
    ['icon' => 'IJ', 'title' => 'Inkjet', 'text' => 'Best for rich color printing and photo work.'],
    ['icon' => 'LS', 'title' => 'Laser', 'text' => 'High-speed and low-maintenance office output.'],
    ['icon' => 'WF', 'title' => 'Wireless', 'text' => 'Seamless printing from mobile and laptop devices.'],
    ['icon' => 'A1', 'title' => 'All-in-One', 'text' => 'Print, scan, and copy with one compact machine.'],
];

$products = [
    ['name' => 'HP OfficeJet Pro 8125e', 'price' => '$179.00', 'old_price' => '$219.00', 'rating' => '4.8', 'badge' => 'Best Seller', 'type' => 'All-in-One'],
    ['name' => 'Canon PIXMA G3270', 'price' => '$159.00', 'old_price' => '$189.00', 'rating' => '4.6', 'badge' => 'Hot Deal', 'type' => 'Ink Tank'],
    ['name' => 'Epson EcoTank ET-2850', 'price' => '$239.00', 'old_price' => '$279.00', 'rating' => '4.7', 'badge' => 'Top Rated', 'type' => 'High Volume'],
    ['name' => 'HP LaserJet Pro 4001n', 'price' => '$329.00', 'old_price' => '$369.00', 'rating' => '4.7', 'badge' => 'Office Pick', 'type' => 'Laser'],
    ['name' => 'Canon imageCLASS MF3010', 'price' => '$199.00', 'old_price' => '$229.00', 'rating' => '4.5', 'badge' => 'Value Pick', 'type' => 'Mono Laser'],
    ['name' => 'Epson WorkForce Pro WF-3820', 'price' => '$169.00', 'old_price' => '$209.00', 'rating' => '4.6', 'badge' => 'Limited Stock', 'type' => 'Wireless'],
];

$comparisonRows = [
    ['feature' => 'Print Speed', 'hp' => '22 ppm', 'canon' => '18 ppm', 'epson' => '20 ppm'],
    ['feature' => 'Wireless', 'hp' => 'Yes', 'canon' => 'Yes', 'epson' => 'Yes'],
    ['feature' => 'Auto Duplex', 'hp' => 'Yes', 'canon' => 'No', 'epson' => 'Yes'],
    ['feature' => 'Cost per Page', 'hp' => 'Low', 'canon' => 'Medium', 'epson' => 'Low'],
    ['feature' => 'Best For', 'hp' => 'Office', 'canon' => 'Home', 'epson' => 'High Volume'],
];

$storyCards = [
    ['title' => 'Home Setup', 'caption' => 'Compact and low-noise printers for family and study use.'],
    ['title' => 'Office Setup', 'caption' => 'Secure and high-volume models for business workflows.'],
    ['title' => 'Creative Setup', 'caption' => 'Photo-grade color options for designers and creators.'],
];

$testimonials = [
    ['initials' => 'AR', 'name' => 'Ariana R.', 'role' => 'Freelancer', 'review' => 'Clean layout, easy checkout, and clear product comparison.'],
    ['initials' => 'MK', 'name' => 'Marcus K.', 'role' => 'Office Manager', 'review' => 'Looks and feels like a polished shopping website.'],
    ['initials' => 'SP', 'name' => 'Sarah P.', 'role' => 'Business Owner', 'review' => 'Professional UI and smooth browsing across sections.'],
];

$shopBenefits = [
    'Secure checkout with trusted payment flow',
    'Same-day dispatch on selected products',
    'Dedicated support for setup and recommendations',
];

$year = (new DateTimeImmutable())->format('Y');

if (!function_exists('e')) {
    function e(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}
