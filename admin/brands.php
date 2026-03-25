<?php
declare(strict_types=1);

$adminTitle = 'Brand Option';
$adminPage = 'brands';

require __DIR__ . '/includes/header.php';
?>

<section class="admin-panel">
    <div class="admin-panel-head">
        <h2>Brands</h2>
        <button class="admin-btn admin-btn-primary" type="button">Add Brand</button>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Brand Name</th>
                    <th>Support Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#B-301</td>
                    <td>HP</td>
                    <td>support@hp.com</td>
                    <td><span class="status-pill status-live">Active</span></td>
                    <td><a href="#">Edit</a></td>
                </tr>
                <tr>
                    <td>#B-302</td>
                    <td>Canon</td>
                    <td>support@canon.com</td>
                    <td><span class="status-pill status-live">Active</span></td>
                    <td><a href="#">Edit</a></td>
                </tr>
                <tr>
                    <td>#B-303</td>
                    <td>Brother</td>
                    <td>support@brother.com</td>
                    <td><span class="status-pill status-live">Active</span></td>
                    <td><a href="#">Edit</a></td>
                </tr>
                <tr>
                    <td>#B-304</td>
                    <td>Epson</td>
                    <td>support@epson.com</td>
                    <td><span class="status-pill status-draft">Draft</span></td>
                    <td><a href="#">Edit</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
