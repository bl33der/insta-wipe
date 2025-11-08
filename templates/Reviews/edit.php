<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Review $review
 * @var string[]|\Cake\Collection\CollectionInterface $products
 */
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Review</h4>
                    <?= $this->Html->link('← Back to Dashboard', ['controller' => 'Users', 'action' => 'index'], ['class' => 'btn btn-light btn-sm']) ?>
                </div>

                <div class="card-body">
                    <?= $this->Form->create($review, ['class' => 'needs-validation', 'novalidate' => true]) ?>

                    <div class="mb-3">
                        <?= $this->Form->control('product_id', [
                            'label' => 'Product',
                            'options' => $products,
                            'class' => 'form-select',
                            'empty' => '-- Select Product --',
                            'required' => true
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $this->Form->control('reviewer_name', [
                            'label' => 'Reviewer Name',
                            'class' => 'form-control',
                            'required' => true,
                            'maxlength' => 255
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $this->Form->control('rating', [
                            'label' => 'Rating',
                            'type' => 'number',
                            'class' => 'form-control',
                            'min' => 1,
                            'max' => 5,
                            'required' => true
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $this->Form->control('comment', [
                            'label' => 'Comment',
                            'type' => 'textarea',
                            'class' => 'form-control',
                            'rows' => 4,
                            'required' => true
                        ]) ?>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success px-4']) ?>

                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $review->comment],

                            [
                                'confirm' => __('Are you sure you want to delete # {0}?', $review->comment),
                                'class' => 'btn btn-danger',
                                'escape' => false
                            ]
                        ) ?>
                    </div>

                    <?= $this->Form->end() ?>
                </div>
            </div>

            <div class="text-center mt-3">
                <?= $this->Html->link(__('List Reviews'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary']) ?>
            </div>

        </div>
    </div>
</div>

<script>
    // Bootstrap 5 validation (optional)
    (() => {
      'use strict'
      const forms = document.querySelectorAll('.needs-validation')
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
          form.classList.add('was-validated')
        }, false)
      })
    })()
</script>

