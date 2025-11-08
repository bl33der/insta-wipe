<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div class="container py-4">
    <div class="row">
        <div class="col-md-9 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex align-items-center">
                    <a href="javascript:history.back()" class="me-3 text-decoration-none" title="Go Back">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <h3 class="mb-0"><?= h($product->product_name) ?></h3>
                </div>
                <div class="card-body">
                    <?php
                    $imagePath = '/' . h($product->img_url);
                    $absolutePath = WWW_ROOT . $product->img_url;
                    ?>

                    <?php if (!empty($product->img_url) && file_exists($absolutePath)): ?>
                        <div class="text-center mb-4">
                            <?= $this->Html->image($imagePath, [
                                'alt' => h($product->product_name),
                                'style' => 'max-height: 250px; object-fit: cover;',
                                'class' => 'img-fluid rounded'
                            ]) ?>
                        </div>
                    <?php endif; ?>

                    <table class="table table-bordered">
                        <tr>
                            <th><?= __('Product Name') ?></th>
                            <td><?= h($product->product_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Price') ?></th>
                            <td>$<?= $product->price === null ? '0.00' : $this->Number->format($product->price) ?></td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <h5><?= __('Description') ?></h5>
                        <div class="border rounded p-3 bg-light">
                            <?= $this->Text->autoParagraph(h($product->description)) ?>
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <?= $this->Form->create(null, [
                            'url' => ['controller' => 'Carts', 'action' => 'add', $product->product_id],
                            'class' => 'd-inline'
                        ]) ?>
                        <?= $this->Form->hidden('quantity', ['value' => 1]) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
