<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cart $cart
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Cart'), ['action' => 'edit', $cart->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Cart'), ['action' => 'delete', $cart->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cart->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Carts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Cart'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="carts view content">
            <h3><?= h($cart->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $cart->hasValue('product') ? $this->Html->link($cart->product->product_id, ['controller' => 'Products', 'action' => 'view', $cart->product->product_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($cart->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= $this->Number->format($cart->quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($cart->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($cart->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>