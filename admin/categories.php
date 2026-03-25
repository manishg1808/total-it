<?php
declare(strict_types=1);

$adminTitle = 'Category Option';
$adminPage = 'categories';

require __DIR__ . '/includes/header.php';
?>

<section class="admin-panel">
    <div class="admin-panel-head">
        <h2>Categories</h2>
        <button class="admin-btn admin-btn-primary" type="button">Add Category</button>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#C-201</td>
                    <td>Inkjet Printers</td>
                    <td>Best for color documents and photo quality output.</td>
                    <td><span class="status-pill status-live">Active</span></td>
                    <td><a href="#">Edit</a></td>
                </tr>
                <tr>
                    <td>#C-202</td>
                    <td>Laser Printers</td>
                    <td>Fast and efficient printing for office workloads.</td>
                    <td><span class="status-pill status-live">Active</span></td>
                    <td><a href="#">Edit</a></td>
                </tr>
                <tr>
                    <td>#C-203</td>
                    <td>Wireless Printers</td>
                    <td>Mobile and laptop friendly wireless print solutions.</td>
                    <td><span class="status-pill status-live">Active</span></td>
                    <td><a href="#">Edit</a></td>
                </tr>
                <tr>
                    <td>#C-204</td>
                    <td>All-in-One Printers</td>
                    <td>Print, scan, and copy in a single compact device.</td>
                    <td><span class="status-pill status-draft">Draft</span></td>
                    <td><a href="#">Edit</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
