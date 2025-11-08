<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Edit Discount</h4>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($discount) ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <?= $this->Form->control('discount_code', [
                                'label' => 'Discount Code',
                                'class' => 'form-control',
                                'required' => true
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->Form->control('discount_amount', [
                                'label' => 'Amount (AUD)',
                                'class' => 'form-control',
                                'required' => true
                            ]) ?>
                        </div>
                        <div class="col-12">
                            <?= $this->Form->control('discount_description', [
                                'label' => 'Description',
                                'type' => 'textarea',
                                'rows' => 3,
                                'class' => 'form-control'
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->Form->control('start_date', [
                                'label' => 'Start Date',
                                'type' => 'date',
                                'class' => 'form-control'
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->Form->control('end_date', [
                                'label' => 'End Date',
                                'type' => 'date',
                                'class' => 'form-control'
                            ]) ?>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check">
                                <?= $this->Form->control('is_active', [
                                    'label' => 'Is Active',
                                    'type' => 'checkbox',
                                    'class' => 'form-check-input',
                                    'labelOptions' => ['class' => 'form-check-label'],
                                    'templates' => [
                                        'inputContainer' => '{{content}}'
                                    ]
                                ]) ?>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
                        <div>
                            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-secondary me-2']) ?>
                            <?= $this->Form->postLink(
                                __('Delete'),
                                ['action' => 'delete', $discount->discount_id],
                                ['class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $discount->discount_id)]
                            ) ?>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
