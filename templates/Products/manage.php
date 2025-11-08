<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Product> $products
 */
?>
<div class="products manage content container mt-5">
    <!-- Top bar: Back button and Sort -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Back to Dashboard -->
        <?= $this->Html->link('Back to Admin Dashboard', ['controller' => 'Users', 'action' => 'index'], ['class' => 'btn btn-outline-secondary']) ?>

        <!-- Sort Controls -->
        <form method="get" class="d-flex align-items-center gap-2 mb-0">
            <label for="sort" class="form-label mb-0">Sort by:</label>
            <select name="sort" id="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="product_name" <?= $this->request->getQuery('sort') === 'product_name' ? 'selected' : '' ?>>Name</option>
                <option value="price" <?= $this->request->getQuery('sort') === 'price' ? 'selected' : '' ?>>Price</option>
            </select>

            <select name="direction" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="asc" <?= $this->request->getQuery('direction') === 'asc' ? 'selected' : '' ?>>Ascending</option>
                <option value="desc" <?= $this->request->getQuery('direction') === 'desc' ? 'selected' : '' ?>>Descending</option>
            </select>
        </form>
    </div>

    <!-- Header and Add Button -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Manage Products</h3>
        <?= $this->Html->link('Add New Product', ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-light">
            <tr>
                <th><?= $this->Paginator->sort('product_name', 'Name') ?></th>
                <th><?= $this->Paginator->sort('price', 'Price (AUD)') ?></th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= h($product->product_name) ?></td>
                    <td>$<?= $this->Number->format($product->price, ['places' => 2]) ?></td>
                    <td>
                        <button class="btn btn-sm toggle-status-btn <?= $product->is_enabled ? 'btn-success' : 'btn-secondary' ?>"
                                data-id="<?= $product->id ?>"
                                data-url="<?= $this->Url->build(['controller' => 'Products', 'action' => 'toggleAvailability', $product->product_id]) ?>">
                            <?= $product->is_enabled ? 'Available' : 'Unavailable' ?>
                        </button>
                    </td>
                    <td class="text-center">
                        <?= $this->Html->link('View', ['action' => 'view', $product->product_id], ['class' => 'btn btn-sm btn-outline-primary me-1']) ?>
                        <?= $this->Html->link('Edit', ['action' => 'edit', $product->product_id], ['class' => 'btn btn-sm btn-outline-secondary me-1']) ?>
                        <?= $this->Form->postLink('Delete', ['action' => 'delete', $product->product_id], [
                            'class' => 'btn btn-sm btn-outline-danger',
                            'confirm' => __('Are you sure you want to delete product #{0}?', $product->product_id)
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="paginator mt-4">
        <ul class="pagination justify-content-center">
            <?= $this->Paginator->first('<< ' . __('First'), ['class' => 'page-link']) ?>
            <?= $this->Paginator->prev('< ' . __('Previous'), ['class' => 'page-link']) ?>
            <?= $this->Paginator->numbers(['class' => 'page-link']) ?>
            <?= $this->Paginator->next(__('Next') . ' >', ['class' => 'page-link']) ?>
            <?= $this->Paginator->last(__('Last') . ' >>', ['class' => 'page-link']) ?>
        </ul>
        <p class="text-center text-muted">
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
        </p>
    </div>
</div>

<!-- Toggle Status Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.toggle-status-btn').forEach(button => {
            button.addEventListener('click', () => {
                const url = button.dataset.url;
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-Token': document.querySelector('meta[name="csrfToken"]').getAttribute('content')
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            const isEnabled = data.is_enabled;
                            button.classList.toggle('btn-success', isEnabled);
                            button.classList.toggle('btn-secondary', !isEnabled);
                            button.textContent = isEnabled ? 'Available' : 'Unavailable';
                        } else {
                            alert('Could not update status. Try again.');
                        }
                    })
                    .catch(() => alert('An error occurred.'));
            });
        });
    });
</script>
