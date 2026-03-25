<?php
declare(strict_types=1);

$adminTitle = 'Dashboard';
$adminPage = 'dashboard';

require __DIR__ . '/includes/header.php';
?>

<section class="admin-stats">
    <article class="admin-card">
        <p>Total Products</p>
        <strong>128</strong>
        <span>Across all categories</span>
    </article>
    <article class="admin-card">
        <p>Pending Orders</p>
        <strong>34</strong>
        <span>Needs dispatch update</span>
    </article>
    <article class="admin-card">
        <p>Support Tickets</p>
        <strong>09</strong>
        <span>Customer help requests</span>
    </article>
    <article class="admin-card">
        <p>Revenue (This Month)</p>
        <strong>$24.8K</strong>
        <span>Estimated summary</span>
    </article>
</section>

<section class="admin-panel">
    <div class="admin-panel-head">
        <h2>Quick Actions</h2>
        <a class="admin-btn admin-btn-primary" href="products.php">Open Product Option</a>
    </div>
    <div class="admin-actions-grid">
        <article class="admin-action-card">
            <h3>Manage Products</h3>
            <p>Add, update, or review product entries quickly from one place.</p>
            <a href="products.php">Go to Products</a>
        </article>
        <article class="admin-action-card">
            <h3>Dashboard Overview</h3>
            <p>Track store snapshots, status counts, and key panel updates.</p>
            <a href="index.php">Refresh Overview</a>
        </article>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
