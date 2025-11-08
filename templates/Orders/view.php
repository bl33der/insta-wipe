<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>

<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Order #<?= h($order->order_id) ?> Details</h4>
        </div>
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tr>
                    <th scope="row">User</th>
                    <td>
                        <?php if (!empty($order->user)) : ?>
                            <?= $this->Html->link(
                                h($order->user->username ?? 'User #' . $order->user->user_id),
                                ['controller' => 'Users', 'action' => 'view', $order->user->user_id]
                            ) ?>
                            <br>
                            <small class="text-muted"><?= h($order->user->email ?? $order->email ?? '') ?></small>
                        <?php else: ?>
                            <span class="text-muted">Guest</span><br>
                            <small class="text-muted"><?= h($order->email ?? 'No email provided') ?></small>
                        <?php endif; ?>
                    </td>

                </tr>
                <tr>
                    <th scope="row">Order Status</th>
                    <td>
                        <?= $this->Form->create(null, [
                            'url' => ['controller' => 'Orders', 'action' => 'updateStatus', $order->order_id],
                            'class' => 'd-flex align-items-center gap-2',
                            'type' => 'post'
                        ]) ?>

                        <?= $this->Form->control('order_status', [
                            'label' => false,
                            'type' => 'select',
                            'options' => [
                                'Pending' => 'Pending',
                                'Processing' => 'Processing',
                                'Shipped' => 'Shipped',
                                'Delivered' => 'Delivered',
                                'Cancelled' => 'Cancelled'
                            ],
                            'default' => $order->order_status,
                            'class' => 'form-select form-select-sm w-auto mb-0'
                        ]) ?>

                        <?= $this->Form->button('Update', ['class' => 'btn btn-sm btn-primary']) ?>

                        <?= $this->Form->end() ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Payment Method</th>
                    <td><?= h($order->payment_method ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th scope="row">Stripe Charge ID</th>
                    <td><?= h($order->stripe_charge_id ?? 'Not recorded') ?></td>
                </tr>
                <tr>
                    <th scope="row">Total Amount</th>
                    <td>$<?= $this->Number->format($order->total_amount ?? 0, ['places' => 2]) ?></td>
                </tr>
                <tr>
                    <th scope="row">Shipping Address</th>
                    <td><?= nl2br(h($order->shipping_address ?? 'N/A')) ?></td>
                </tr>
                <tr>
                    <th scope="row">Ordered At</th>
                    <td><?= h(date('n/j/y, g:i A', strtotime($order->ordered_at))) ?></td>
                </tr>
                <tr>
                    <th scope="row">Cost Breakdown</th>
                    <td>
                        <?php
                        $cartItems = json_decode($order->cart_data, true) ?? [];
                        $calculatedSubtotal = 0;
                        foreach ($cartItems as $item) {
                            $price = $item['price'] ?? 0;
                            $quantity = $item['quantity'] ?? 1;
                            $calculatedSubtotal += $price * $quantity;
                        }

                        $finalTotal = floatval($order->total_amount);
                        $discountUsed = $calculatedSubtotal > $finalTotal ? ($calculatedSubtotal - $finalTotal) : 0;
                        $shippingEstimate = $finalTotal - $calculatedSubtotal + $discountUsed;

                        $shippingLabel = $order->shipping_method ?? 'Shipping';

                        echo '<ul class="mb-0 ps-3">';
                        echo '<li><strong>Subtotal:</strong> $' . number_format($calculatedSubtotal, 2) . '</li>';
                        echo '<li><strong>Discount:</strong> -$' . number_format($discountUsed, 2) . '</li>';
                        echo '<li><strong>Shipping:</strong> ' . h($shippingLabel) . '</li>';
                        echo '<li><strong>Total Charged:</strong> $' . number_format($finalTotal, 2) . '</li>';
                        echo '</ul>';
                        ?>
                    </td>
                </tr>

            </table>
        </div>
    </div>

    <?php
    $cartItems = json_decode($order->cart_data, true);
    if (is_array($cartItems) && !empty($cartItems)): ?>
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Items Ordered</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end">Price (AUD)</th>
                        <th class="text-end">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cartItems as $item):
                        $productName = $item['product'] ?? $item['product_name'] ?? 'N/A';
                        $quantity = $item['quantity'] ?? 1;
                        $price = $item['price'] ?? 0;
                        ?>
                        <tr>
                            <td><?= h($productName) ?></td>
                            <td class="text-center"><?= h($quantity) ?></td>
                            <td class="text-end">$<?= number_format($price, 2) ?></td>
                            <td class="text-end">$<?= number_format($price * $quantity, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning mt-4" role="alert">
            No item data available for this order.
        </div>
    <?php endif; ?>
</div>

<?= $this->Html->link(__('Back to Order Dashboard'), ['controller' => 'Orders', 'action' => 'index'], ['class' => 'btn btn-outline-secondary']) ?>
