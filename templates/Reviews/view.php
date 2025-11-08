<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Review $review
 */
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Review Details</h4>
                    <?= $this->Html->link('← Back to Dashboard', ['controller' => 'Users', 'action' => 'index'], ['class' => 'btn btn-light btn-sm']) ?>
                </div>
                <div class="card-body">
                    <h5 class="text-center mb-4"><?= h($review->reviewer_name) ?></h5>
                    <table class="table table-bordered">
                        <tr>
                            <th class="w-25">Product</th>
                            <td>
                                <?= $review->hasValue('product')
                                    ? $this->Html->link(h($review->product->product_name), ['controller' => 'Products', 'action' => 'view', $review->product->product_id])
                                    : '—' ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Reviewer</th>
                            <td><?= h($review->reviewer_name) ?></td>
                        </tr>
                        <tr>
                            <th>Rating</th>
                            <td>
                                <?php for ($i = 0; $i < $review->rating; $i++): ?>
                                    <span class="text-warning">&#9733;</span>
                                <?php endfor; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Date Submitted</th>
                            <td><?= h($review->created->format('d M Y, H:i A')) ?></td>
                        </tr>
                        <tr>
                            <th>Last Modified</th>
                            <td><?= h($review->modified->format('d M Y, H:i A')) ?></td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <h6>Comment</h6>
                        <blockquote class="blockquote ps-3 border-start border-primary">
                            <?= $this->Text->autoParagraph(h($review->comment)) ?>
                        </blockquote>
                    </div>

                    <?php if (!empty($review->img_url)): ?>
                        <div class="mt-4 text-center">
                            <h6>Attached Image</h6>
                            <?= $this->Html->image('/' . h($review->img_url), [
                                'alt' => 'Review Image',
                                'style' => 'max-height: 250px; max-width: 100%; object-fit: contain;',
                                'class' => 'rounded shadow'
                            ]) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
