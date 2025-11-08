<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Payment $payment
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Payment'), ['action' => 'edit', $payment->payment_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Payment'), ['action' => 'delete', $payment->payment_id], ['confirm' => __('Are you sure you want to delete # {0}?', $payment->payment_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Payments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Payment'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="payments view content">
            <h3><?= h($payment->payment_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Order') ?></th>
                    <td><?= $payment->hasValue('order') ? $this->Html->link($payment->order->order_id, ['controller' => 'Orders', 'action' => 'view', $payment->order->order_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Status') ?></th>
                    <td><?= h($payment->order_status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Payment Method') ?></th>
                    <td><?= h($payment->payment_method) ?></td>
                </tr>
                <tr>
                    <th><?= __('Total Amount') ?></th>
                    <td><?= $payment->total_amount === null ? '' : $this->Number->format($payment->total_amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Payment Id') ?></th>
                    <td><?= $this->Number->format($payment->payment_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Date') ?></th>
                    <td><?= h($payment->order_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Payment Date') ?></th>
                    <td><?= h($payment->payment_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>