<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Add New Discount</h4>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($discount) ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <?= $this->Form->control('discount_code', [
                                'class' => 'form-control',
                                'label' => 'Discount Code',
                                'required' => true
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->Form->control('discount_amount', [
                                'class' => 'form-control',
                                'label' => 'Amount (AUD)',
                                'required' => true
                            ]) ?>
                        </div>
                        <div class="col-12">
                            <?= $this->Form->control('discount_description', [
                                'type' => 'textarea',
                                'rows' => 3,
                                'class' => 'form-control',
                                'label' => 'Description'
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->Form->control('start_date', [
                                'class' => 'form-control',
                                'type' => 'date',
                                'label' => 'Start Date'
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->Form->control('end_date', [
                                'class' => 'form-control',
                                'type' => 'date',
                                'label' => 'End Date'
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->Form->control('is_active', [
                                'type' => 'checkbox',
                                'label' => 'Is Active',
                                'class' => 'form-check-input mt-2'
                            ]) ?>
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
                        <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-secondary ms-2']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
