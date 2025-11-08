<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Faq> $faqs
 */
?>
<div class="faqs index content container mt-5">
    <!-- Top bar: Back button and Sort -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Back to Dashboard -->
        <?= $this->Html->link('Back to Admin Dashboard', ['controller' => 'Users', 'action' => 'index'], ['class' => 'btn btn-outline-secondary']) ?>

        <!-- Sort Controls -->
        <form method="get" class="d-flex align-items-center gap-2 mb-0">
            <label for="sort" class="form-label mb-0">Sort by:</label>
            <select name="sort" id="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="question" <?= $this->request->getQuery('sort') === 'question' ? 'selected' : '' ?>>Question</option>
                <option value="answer" <?= $this->request->getQuery('sort') === 'answer' ? 'selected' : '' ?>>Answer</option>
            </select>

            <select name="direction" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="asc" <?= $this->request->getQuery('direction') === 'asc' ? 'selected' : '' ?>>Ascending</option>
                <option value="desc" <?= $this->request->getQuery('direction') === 'desc' ? 'selected' : '' ?>>Descending</option>
            </select>
        </form>
    </div>

    <!-- Header and Add Button -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Manage FAQs</h3>
        <?= $this->Html->link('Add New FAQ', ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-light">
            <tr>
                <th><?= $this->Paginator->sort('question', 'Question') ?></th>
                <th><?= $this->Paginator->sort('answer', 'Answer') ?></th>
                <th class="text-center"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($faqs as $faq): ?>
                <tr>
                    <td style="max-width: 300px;" class="text-truncate"><?= h($faq->question) ?></td>
                    <td style="max-width: 400px;" class="text-truncate"><?= h($faq->answer) ?></td>
                    <td class="text-center">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $faq->id], ['class' => 'btn btn-sm btn-outline-primary me-1']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $faq->id], ['class' => 'btn btn-sm btn-outline-secondary me-1']) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $faq->id],
                            [
                                'class' => 'btn btn-sm btn-outline-danger',
                                'confirm' => __('Are you sure you want to delete this FAQ?')
                            ]
                        ) ?>
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
