<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Back to Dashboard -->
        <?= $this->Html->link('Back to Admin Dashboard', ['controller' => 'Users', 'action' => 'index'], ['class' => 'btn btn-outline-secondary']) ?>

        <!-- Sort Controls -->
        <form method="get" class="d-flex align-items-center gap-2">
            <label for="sort" class="form-label mb-0">Sort by:</label>
            <select name="sort" id="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="discount_id" <?= $this->request->getQuery('sort') === 'discount_id' ? 'selected' : '' ?>>ID</option>
                <option value="discount_code" <?= $this->request->getQuery('sort') === 'discount_code' ? 'selected' : '' ?>>Code</option>
                <option value="discount_amount" <?= $this->request->getQuery('sort') === 'discount_amount' ? 'selected' : '' ?>>Amount</option>
                <option value="start_date" <?= $this->request->getQuery('sort') === 'start_date' ? 'selected' : '' ?>>Start Date</option>
                <option value="end_date" <?= $this->request->getQuery('sort') === 'end_date' ? 'selected' : '' ?>>End Date</option>
                <option value="is_active" <?= $this->request->getQuery('sort') === 'is_active' ? 'selected' : '' ?>>Status</option>
            </select>

            <select name="direction" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="asc" <?= $this->request->getQuery('direction') === 'asc' ? 'selected' : '' ?>>Ascending</option>
                <option value="desc" <?= $this->request->getQuery('direction') === 'desc' ? 'selected' : '' ?>>Descending</option>
            </select>
        </form>
    </div>

    <div class="table-responsive shadow-sm">
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-dark">
            <tr>
                <th><?= $this->Paginator->sort('discount_id', 'ID') ?></th>
                <th><?= $this->Paginator->sort('discount_code', 'Code') ?></th>
                <th><?= $this->Paginator->sort('discount_amount', 'Amount (AUD)') ?></th>
                <th><?= $this->Paginator->sort('start_date') ?></th>
                <th><?= $this->Paginator->sort('end_date') ?></th>
                <th><?= $this->Paginator->sort('is_active', 'Status') ?></th>
                <th class="text-center"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($discounts as $discount): ?>
                <tr>
                    <td><?= $this->Number->format($discount->discount_id) ?></td>
                    <td><?= h($discount->discount_code) ?></td>
                    <td>$<?= $this->Number->format($discount->discount_amount) ?></td>
                    <td><?= h($discount->start_date) ?></td>
                    <td><?= h($discount->end_date) ?></td>
                    <td>
                        <span class="badge <?= $discount->is_active ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $discount->is_active ? 'Active' : 'Inactive' ?>
                        </span>
                    </td>
                    <td class="d-flex justify-content-center gap-1">
                        <?= $this->Html->link('View', ['action' => 'view', $discount->discount_id], ['class' => 'btn btn-sm btn-info']) ?>
                        <?= $this->Html->link('Edit', ['action' => 'edit', $discount->discount_id], ['class' => 'btn btn-sm btn-warning']) ?>
                        <?= $this->Form->postLink(
                            'Delete',
                            ['action' => 'delete', $discount->discount_id],
                            [
                                'class' => 'btn btn-sm btn-danger',
                                'confirm' => __('Are you sure you want to delete #{0}?', $discount->discount_id)
                            ]
                        ) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <div>
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} of {{count}} total')) ?>
        </div>
        <ul class="pagination mb-0">
            <?= $this->Paginator->first('«') ?>
            <?= $this->Paginator->prev('‹') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('›') ?>
            <?= $this->Paginator->last('»') ?>
        </ul>
    </div>
</div>
