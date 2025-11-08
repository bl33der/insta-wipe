<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Video $video
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
                    <h4 class="mb-0"><?= __('Add New Video') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($video) ?>
                    <div class="mb-3">
                        <?= $this->Form->control('embed', [
                            'label' => 'Embed Code or URL',
                            'class' => 'form-control',
                            'placeholder' => 'Paste video embed code or URL'
                        ]) ?>
                    </div>
                    <div>
                        <?= $this->Form->button(__('Add Video'), ['class' => 'btn btn-success']) ?>
                        <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-secondary ms-2']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
