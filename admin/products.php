<?php
declare(strict_types=1);

$adminTitle = 'Product Option';
$adminPage = 'products';

require __DIR__ . '/includes/header.php';
?>

<section class="admin-panel">
    <div class="admin-panel-head">
        <h2>Products</h2>
        <button class="admin-btn admin-btn-primary" type="button">Add Product</button>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#P-101</td>
                    <td>HP OfficeJet Pro 8125e</td>
                    <td>All-in-One</td>
                    <td>$179.00</td>
                    <td><span class="status-pill status-live">Active</span></td>
                    <td><a href="#">Edit</a></td>
                </tr>
                <tr>
                    <td>#P-102</td>
                    <td>Canon PIXMA G3270</td>
                    <td>Ink Tank</td>
                    <td>$159.00</td>
                    <td><span class="status-pill status-live">Active</span></td>
                    <td><a href="#">Edit</a></td>
                </tr>
                <tr>
                    <td>#P-103</td>
                    <td>Epson EcoTank ET-2850</td>
                    <td>Wireless</td>
                    <td>$239.00</td>
                    <td><span class="status-pill status-draft">Draft</span></td>
                    <td><a href="#">Edit</a></td>
                </tr>
                <tr>
                    <td>#P-104</td>
                    <td>Brother HL-L2390DW</td>
                    <td>Laser</td>
                    <td>$214.00</td>
                    <td><span class="status-pill status-live">Active</span></td>
                    <td><a href="#">Edit</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
