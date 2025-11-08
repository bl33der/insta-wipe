<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Video> $videos
 */
?>
<div class="videos index content container mt-5">
    <!-- Top bar: Back button and Sort -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Back to Dashboard -->
        <?= $this->Html->link('Back to Admin Dashboard', ['controller' => 'Users', 'action' => 'index'], ['class' => 'btn btn-outline-secondary']) ?>

        <!-- Sort Controls -->
        <form method="get" class="d-flex align-items-center gap-2 mb-0">
            <label for="sort" class="form-label mb-0">Sort by:</label>
            <select name="sort" id="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="id" <?= $this->request->getQuery('sort') === 'id' ? 'selected' : '' ?>>ID</option>
                <option value="created" <?= $this->request->getQuery('sort') === 'created' ? 'selected' : '' ?>>Created</option>
                <option value="modified" <?= $this->request->getQuery('sort') === 'modified' ? 'selected' : '' ?>>Modified</option>
            </select>

            <select name="direction" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="asc" <?= $this->request->getQuery('direction') === 'asc' ? 'selected' : '' ?>>Ascending</option>
                <option value="desc" <?= $this->request->getQuery('direction') === 'desc' ? 'selected' : '' ?>>Descending</option>
            </select>
        </form>
    </div>

    <!-- Header and Add Button -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Manage Videos</h3>
        <?= $this->Html->link(__('Add New Video'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-light">
            <tr>
                <th><?= $this->Paginator->sort('ID', 'id') ?></th>
                <th><?= $this->Paginator->sort('Created', 'created') ?></th>
                <th><?= $this->Paginator->sort('Modified', 'modified') ?></th>
                <th class="text-center"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($videos as $video): ?>
                <tr>
                    <td><?= $this->Number->format($video->id) ?></td>
                    <td><?= h($video->created) ?></td>
                    <td><?= h($video->modified) ?></td>
                    <td class="text-center">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $video->id], ['class' => 'btn btn-sm btn-outline-primary me-1']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $video->id], ['class' => 'btn btn-sm btn-outline-secondary me-1']) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $video->id],
                            [
                                'class' => 'btn btn-sm btn-outline-danger',
                                'confirm' => __('Are you sure you want to delete video # {0}?', $video->id),
                            ]
                        ) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="paginator mt-4">
        <ul class="pagination justify-content-center">
            <li class="page-item"><?= $this->Paginator->first('<< ' . __('First'), ['class' => 'page-link']) ?></li>
            <li class="page-item"><?= $this->Paginator->prev('< ' . __('Previous'), ['class' => 'page-link']) ?></li>
            <?= $this->Paginator->numbers([
                'class' => 'page-link',
                'currentTag' => 'span',
                'currentClass' => 'page-link active',
                'tag' => 'li'
            ]) ?>
            <li class="page-item"><?= $this->Paginator->next(__('Next') . ' >', ['class' => 'page-link']) ?></li>
            <li class="page-item"><?= $this->Paginator->last(__('Last') . ' >>', ['class' => 'page-link']) ?></li>
        </ul>
        <p class="text-center text-muted">
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
        </p>
    </div>
</div>
