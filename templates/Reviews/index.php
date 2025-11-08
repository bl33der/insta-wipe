<div class="container my-4">
    <h2 class="mb-3">Reviews</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Back to Dashboard -->
        <?= $this->Html->link('Back to Admin Dashboard', ['controller' => 'Users', 'action' => 'index'], ['class' => 'btn btn-outline-secondary']) ?>

        <!-- Sort Controls -->
        <form method="get" class="d-flex align-items-center gap-2">
            <label for="sort" class="form-label mb-0">Sort by:</label>
            <select name="sort" id="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="created" <?= $this->request->getQuery('sort') === 'created' ? 'selected' : '' ?>>Date</option>
                <option value="rating" <?= $this->request->getQuery('sort') === 'rating' ? 'selected' : '' ?>>Rating</option>
                <option value="reviewer_name" <?= $this->request->getQuery('sort') === 'reviewer_name' ? 'selected' : '' ?>>Reviewer Name</option>
            </select>

            <select name="direction" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="asc" <?= $this->request->getQuery('direction') === 'asc' ? 'selected' : '' ?>>Ascending</option>
                <option value="desc" <?= $this->request->getQuery('direction') === 'desc' ? 'selected' : '' ?>>Descending</option>
            </select>
        </form>
    </div>

    <div class="table-responsive shadow-sm rounded border bg-white">
        <table class="table table-hover mb-0">
            <thead class="table-light">
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('product_id') ?></th>
                <th><?= $this->Paginator->sort('reviewer_name') ?></th>
                <th><?= $this->Paginator->sort('rating') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="text-center"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($reviews as $review): ?>
                <tr>
                    <td><?= $this->Number->format($review->id) ?></td>
                    <td>
                        <?= $review->hasValue('product')
                            ? $this->Html->link($review->product->product_id, ['controller' => 'Products', 'action' => 'view', $review->product->product_id])
                            : '-' ?>
                    </td>
                    <td><?= h($review->reviewer_name) ?></td>
                    <td><?= $this->Number->format($review->rating) ?></td>
                    <td><?= h($review->created->format('d M Y, H:i A')) ?></td>
                    <td><?= h($review->modified->format('d M Y, H:i A')) ?></td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm" role="group">
                            <?= $this->Html->link('View', ['action' => 'view', $review->id], ['class' => 'btn btn-outline-secondary']) ?>
                            <?= $this->Html->link('Edit', ['action' => 'edit', $review->id], ['class' => 'btn btn-outline-primary']) ?>
                            <?= $this->Form->postLink('Delete', ['action' => 'delete', $review->comment], [
                                'confirm' => __('Are you sure you want to delete # {0}?', $review->comment),
                                'class' => 'btn btn-outline-danger'
                            ]) ?>
                            <?= $this->Form->postLink(
                                $review->is_approved ? 'Unpublish' : 'Publish',
                                ['action' => 'approve', $review->id],
                                [
                                    'confirm' => 'Are you sure you want to change this review\'s visibility?',
                                    'class' => $review->is_approved ? 'btn btn-outline-secondary' : 'btn btn-outline-success'
                                ]
                            ) ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <div class="pagination">
            <ul class="pagination mb-0">
                <?= $this->Paginator->first('<<') ?>
                <?= $this->Paginator->prev('<') ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next('>') ?>
                <?= $this->Paginator->last('>>') ?>
            </ul>
        </div>
        <div class="text-muted small">
            <?= $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total') ?>
        </div>
    </div>
</div>
