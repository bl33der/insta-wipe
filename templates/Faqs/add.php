<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Faq $faq
 */
?>
<div class="container mt-4">
    <div class="row">
        <!-- Side Navigation -->
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><?= __('Actions') ?></h5>
                </div>
                <div class="list-group list-group-flush">
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
                    <h4 class="mb-0"><?= __('Add FAQ') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($faq) ?>

                    <div class="mb-3">
                        <?= $this->Form->control('question', [
                            'label' => 'Question',
                            'class' => 'form-control',
                            'placeholder' => 'Enter the FAQ question here...'
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $this->Form->control('answer', [
                            'label' => 'Answer',
                            'type' => 'textarea',
                            'class' => 'form-control',
                            'rows' => 5,
                            'placeholder' => 'Provide the answer to the question...'
                        ]) ?>
                    </div>

                    <div>
                        <?= $this->Form->button(__('Add FAQ'), ['class' => 'btn btn-success']) ?>
                        <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-secondary ms-2']) ?>
                    </div>

                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
