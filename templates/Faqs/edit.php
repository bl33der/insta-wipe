<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Faq $faq
 */
?>
<div class="container mt-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><?= __('Actions') ?></h5>
                </div>
                <div class="list-group list-group-flush">
                    <?= $this->Form->postLink(
                        ('Delete'),
                        ['action' => 'delete', $faq->id],
                        [
                            'confirm' => __('Are you sure you want to delete # {0}?', $faq->id),
                            'class' => 'list-group-item list-group-item-action text-danger'
                        ]
                    ) ?>
                    <?= $this->Html->link(
                        ('Back'),
                        ['action' => 'index'],
                        ['class' => 'list-group-item list-group-item-action']
                    ) ?>
                </div>
            </div>
        </div>

        <!-- Form Area -->
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><?= __('Edit FAQ') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($faq) ?>

                    <div class="mb-3">
                        <?= $this->Form->control('question', [
                            'label' => 'Question',
                            'class' => 'form-control',
                            'placeholder' => 'Enter the FAQ question'
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $this->Form->control('answer', [
                            'label' => 'Answer',
                            'type' => 'textarea',
                            'class' => 'form-control',
                            'placeholder' => 'Provide a clear and helpful answer',
                            'rows' => 4
                        ]) ?>
                    </div>

                    <div>
                        <?= $this->Form->button(__('Save Changes'), ['class' => 'btn btn-success']) ?>
                        <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-secondary ms-2']) ?>
                    </div>

                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
