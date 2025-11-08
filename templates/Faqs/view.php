<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Faq $faq
 */
?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><?= __('Actions') ?></h5>
                </div>
                <div class="list-group list-group-flush">
                    <?= $this->Html->link(
                        __('Edit'),
                        ['action' => 'edit', $faq->id],
                        ['class' => 'list-group-item list-group-item-action']
                    ) ?>
                    <?= $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $faq->id],
                        [
                            'confirm' => __('Are you sure you want to delete # {0}?', $faq->id),
                            'class' => 'list-group-item list-group-item-action text-danger'
                        ]
                    ) ?>
                    <?= $this->Html->link(
                        __('Back'),
                        ['action' => 'index'],
                        ['class' => 'list-group-item list-group-item-action']
                    ) ?>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><?= h($faq->question) ?></h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw"><?= __('Question') ?></label>
                        <div class="form-control bg-light"><?= h($faq->question) ?></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw"><?= __('Answer') ?></label>
                        <div class="form-control bg-light" style="min-height: 150px; white-space: pre-line;">
                            <?= h($faq->answer) ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw"><?= __('ID') ?></label>
                        <div class="form-control bg-light"><?= $this->Number->format($faq->id) ?></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
