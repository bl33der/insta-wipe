<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\ORM\ResultSet|\App\Model\Entity\User[] $users
 * @var \Cake\ORM\ResultSet|\App\Model\Entity\Product[] $products
 * @var \Cake\ORM\ResultSet|\App\Model\Entity\Enquiry[] $enquiries
 * @var \Cake\ORM\ResultSet|\App\Model\Entity\Review[] $reviews
 */
?>

<?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')) ?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Admin Dashboard</h2>

    <div class="row g-4">
        <!-- Orders Tile -->
        <div class="col-md-6 col-xl-4">
            <div class="card shadow-sm h-100">
                <div class="card-body tile-trigger" data-target="#collapseOrders">
                    <h5 class="card-title">Orders</h5>
                    <p class="card-text text-muted">Manage orders & contact customer.</p>
                    <?= $this->Html->link('Go', ['controller' => 'Orders', 'action' => 'index'], ['class' => 'btn btn-outline-primary mt-2']) ?>
                </div>
            </div>
        </div>

        <!-- Admin Tile -->
        <div class="col-md-6 col-xl-4">
            <div class="card shadow-sm h-100">
                <div class="card-body tile-trigger" data-target="#collapseAdmins">
                    <h5 class="card-title">Admins</h5>
                    <p class="card-text text-muted">Manage admin accounts.</p>
                    <?= $this->Html->link('Go', ['controller' => 'Users', 'action' => 'manage'], ['class' => 'btn btn-outline-primary mt-2']) ?>
                </div>
            </div>
        </div>

        <!-- Products Tile -->
        <div class="col-md-6 col-xl-4">
            <div class="card shadow-sm h-100">
                <div class="card-body tile-trigger" data-target="#collapseProducts">
                    <h5 class="card-title">Products</h5>
                    <p class="card-text text-muted">Manage products and availibility.</p>
                    <?= $this->Html->link('Go', ['controller' => 'Products', 'action' => 'manage'], ['class' => 'btn btn-outline-primary mt-2']) ?>
                </div>
            </div>
        </div>


        <!-- Enquiries Tile -->
        <div class="col-md-6 col-xl-4">
            <div class="card shadow-sm h-100">
                <div class="card-body tile-trigger" data-target="#collapseEnquiries">
                    <h5 class="card-title">Enquiries</h5>
                    <p class="card-text text-muted">Manage enquiries.</p>
                    <?= $this->Html->link('Go', ['controller' => 'Enquiries', 'action' => 'index'], ['class' => 'btn btn-outline-primary mt-2']) ?>
                </div>
            </div>
        </div>

        <!-- Reviews Tile -->
        <div class="col-md-6 col-xl-4">
            <div class="card shadow-sm h-100">
                <div class="card-body tile-trigger" data-target="#collapseReviews">
                    <h5 class="card-title">Reviews</h5>
                    <p class="card-text text-muted">Publish, unpublish and manage reviews.</p>
                    <?= $this->Html->link('Go', ['controller' => 'Reviews', 'action' => 'index'], ['class' => 'btn btn-outline-primary mt-2']) ?>
                </div>
            </div>
        </div>

        <!-- Discounts Tile -->
        <div class="col-md-6 col-xl-4">
            <div class="card shadow-sm h-100">
                <div class="card-body tile-trigger" data-target="#collapseDiscounts">
                    <h5 class="card-title">Discount Codes</h5>
                    <p class="card-text text-muted">Manage discount codes.</p>
                    <?= $this->Html->link('Go', ['controller' => 'Discounts', 'action' => 'index'], ['class' => 'btn btn-outline-primary mt-2']) ?>
                </div>
            </div>
        </div>

        <!-- CMS Tile -->
        <div class="col-md-6 col-xl-4">
            <div class="card shadow-sm h-100">
                <div class="card-body tile-trigger" data-target="#collapseWebsite">
                    <h5 class="card-title">Website Customisation</h5>
                    <p class="card-text text-muted">Customise the website.</p>
                    <?= $this->Html->link('Go', ['plugin' => 'ContentBlocks', 'controller' => 'ContentBlocks', 'action' => 'index'], ['class' => 'btn btn-outline-primary mt-2']) ?>
                </div>
            </div>
        </div>

        <!-- FAQs Tile -->
        <div class="col-md-6 col-xl-4">
            <div class="card shadow-sm h-100">
                <div class="card-body tile-trigger" data-target="#collapseFaq">
                    <h5 class="card-title">FAQs</h5>
                    <p class="card-text text-muted">Manage frequently asked questions.</p>
                    <?= $this->Html->link('Go', ['controller' => 'Faqs', 'action' => 'manage'], ['class' => 'btn btn-outline-primary mt-2']) ?>
                </div>
            </div>
        </div>

        <!-- Videos Tile -->
        <div class="col-md-6 col-xl-4">
            <div class="card shadow-sm h-100">
                <div class="card-body tile-trigger" data-target="#collapseVideos">
                    <h5 class="card-title">Videos</h5>
                    <p class="card-text text-muted">Add new video or manage existing ones.</p>
                    <?= $this->Html->link('Go', ['controller' => 'Videos', 'action' => 'index'], ['class' => 'btn btn-outline-primary mt-2']) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Original Accordion Sections -->
    <div class="accordion mt-5" id="adminDashboardAccordion">
        <!-- All original collapsible content goes here unchanged -->
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const csrfToken = document.querySelector('meta[name="csrfToken"]').content;

        document.querySelectorAll('.tile-trigger').forEach(tile => {
            tile.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const target = document.querySelector(targetId);
                if (target) {
                    const collapse = new bootstrap.Collapse(target, {
                        toggle: true
                    });
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        document.querySelectorAll('.delete-product-btn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const url = this.dataset.url;

                if (!confirm('Are you sure you want to delete this product?')) return;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-Token': csrfToken,
                        'Accept': 'application/json'
                    }
                })
                    .then(res => {
                        if (res.ok) {
                            document.getElementById('product-row-' + id).remove();
                        } else {
                            alert('Failed to delete product.');
                        }
                    });
            });
        });

        document.querySelectorAll('.toggle-status-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const url = this.dataset.url;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-Token': csrfToken,
                        'Accept': 'application/json'
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            this.classList.toggle('btn-success');
                            this.classList.toggle('btn-secondary');
                            this.textContent = data.is_enabled ? 'Enabled' : 'Disabled';
                        }
                    });
            });
        });
    });
</script>
