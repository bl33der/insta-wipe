<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Cart> $carts
 */
?>
<div class="carts index content py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="bi bi-cart4"></i> Your Cart</h3>
    </div>

    <?php if (empty($carts)): ?>
        <div class="alert alert-info text-center">
            Your cart is currently empty.
        </div>
    <?php else: ?>
        <div class="table-responsive shadow-sm rounded mb-3">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th class="text-center">Remove</th>
                </tr>
                </thead>
                <tbody>
                <?php $total = 0; ?>
                <?php foreach ($carts as $cart): ?>
                    <?php
                    $price = $cart->product->price ?? 0;
                    $subtotal = $price * $cart->quantity;
                    $total += $subtotal;
                    ?>
                    <tr>
                        <td>
                            <?= $this->Html->link(h($cart->product->product_name), ['controller' => 'Products', 'action' => 'view', $cart->product_id], ['class' => 'fw-bold text-decoration-none']) ?>
                        </td>
                        <td>
                            <?php if (!empty($cart->product->img_url) && file_exists(WWW_ROOT . $cart->product->img_url)): ?>
                                <?= $this->Html->image('/' . $cart->product->img_url, ['style' => 'width: 60px; height: 60px; object-fit: cover;', 'class' => 'rounded']) ?>
                            <?php else: ?>
                                <div class="bg-light d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">No Image</div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= $this->Form->create(null, ['url' => ['action' => 'updateQuantity', $cart->id], 'class' => 'd-flex align-items-center', 'style' => 'gap: 0.5rem']) ?>
                            <button type="submit" name="change" value="-1" class="btn btn-sm btn-outline-secondary">-</button>
                            <span><?= $this->Number->format($cart->quantity) ?></span>
                            <button type="submit" name="change" value="1" class="btn btn-sm btn-outline-secondary">+</button>
                            <?= $this->Form->end() ?>
                        </td>
                        <td>$<?= $this->Number->format($price) ?></td>
                        <td>$<?= $this->Number->format($subtotal) ?></td>
                        <td class="text-center">
                            <?= $this->Form->postLink('<i class="bi bi-trash"></i>', ['action' => 'delete', $cart->id], [
                                'class' => 'btn btn-sm btn-outline-danger',
                                'confirm' => __('Are you sure you want to remove this item?'),
                                'escape' => false
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr class="table-secondary fw-bold">
                    <td colspan="4" class="text-end">Total:</td>
                    <td colspan="2">$<?= $this->Number->format($total) ?></td>
                </tr>
                </tbody>
            </table>
        </div>

        <!-- Proceed to Checkout -->
        <div class="text-end">
            <?= $this->Html->link('Proceed to Checkout', ['controller' => 'Carts', 'action' => 'checkout'], [
                'class' => 'btn btn-primary btn-lg'
            ]) ?>
        </div>
    <?php endif; ?>
</div>
