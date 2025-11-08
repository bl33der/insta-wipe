<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Order> $orders
 */
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <?= $this->Html->link('Back to Order Dashboard', ['controller' => 'Users', 'action' => 'index'], ['class' => 'btn btn-outline-secondary']) ?>

        <form method="get" class="d-flex align-items-center gap-2">
            <label for="sort" class="form-label mb-0">Sort by:</label>
            <select name="sort" id="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="order_id" <?= $this->request->getQuery('sort') === 'order_id' ? 'selected' : '' ?>>Order ID</option>
                <option value="email" <?= $this->request->getQuery('sort') === 'email' ? 'selected' : '' ?>>Email</option>
                <option value="order_date" <?= $this->request->getQuery('sort') === 'order_date' ? 'selected' : '' ?>>Date</option>
                <option value="total_amount" <?= $this->request->getQuery('sort') === 'total_amount' ? 'selected' : '' ?>>Total</option>
                <option value="order_status" <?= $this->request->getQuery('sort') === 'order_status' ? 'selected' : '' ?>>Status</option>
            </select>

            <select name="direction" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="asc" <?= $this->request->getQuery('direction') === 'asc' ? 'selected' : '' ?>>Ascending</option>
                <option value="desc" <?= $this->request->getQuery('direction') === 'desc' ? 'selected' : '' ?>>Descending</option>
            </select>
        </form>
    </div>

    <div class="table-responsive shadow-sm rounded border bg-white">
        <table class="table table-bordered table-hover align-middle text-center mb-0">
            <thead class="table-dark">
            <tr>
                <th><?= $this->Paginator->sort('order_id', 'Order ID') ?></th>
                <th><?= $this->Paginator->sort('email', 'Email') ?></th>
                <th><?= $this->Paginator->sort('order_date', 'Date') ?></th>
                <th><?= $this->Paginator->sort('total_amount', 'Total (AUD)') ?></th>
                <th><?= $this->Paginator->sort('order_status', 'Status') ?></th>
                <th class="text-nowrap">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $this->Number->format($order->order_id) ?></td>
                    <td><?= h($order->email ?? 'Guest') ?></td>

                    <td>
                        <?= h(
                            (new \DateTime($order->ordered_at, new \DateTimeZone('UTC')))
                                ->setTimezone(new \DateTimeZone('Australia/Melbourne'))
                                ->format('n/j/y, g:i A')
                        ) ?>
                    </td>
                    <td><?= $order->total_amount !== null ? '$' . $this->Number->format($order->total_amount, ['places' => 2]) : '-' ?></td>
                    <td>
                        <form method="POST" action="/team115-app_fit3048/insta_wipe/orders/update-status/<?= h($order->order_id) ?>">
                            <input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken') ?>">
                            <select name="order_status" class="form-select form-select-sm d-inline-block w-auto">
                                <option value="Pending" <?= $order->order_status === 'Pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="Processing" <?= $order->order_status === 'Processing' ? 'selected' : '' ?>>Processing</option>
                                <option value="Shipped" <?= $order->order_status === 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                                <option value="Delivered" <?= $order->order_status === 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                                <option value="Cancelled" <?= $order->order_status === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary ms-1">Update</button>
                        </form>
                    </td>

                    <td>
                        <div class="btn-group btn-group-sm">
                            <?= $this->Html->link('View', ['action' => 'view', $order->order_id], ['class' => 'btn btn-info']) ?>

                            <?php if (!empty($order->email)) : ?>
                                <?php
                                $mailtoUrl = 'https://mail.google.com/mail/?view=cm&fs=1'
                                    . '&to=' . urlencode($order->email)
                                    . '&su=' . urlencode('Regarding Your InstaWipe Order #' . $order->order_id)
                                    . '&body=' . urlencode(
                                        "Dear Customer,\n\nThank you for your order with InstaWipe. Your order ID is #" . $order->order_id . ".\n\nIf you have any questions or need support, feel free to reply to this email.\n\nBest regards,\nInstaWipe Team"
                                    );
                                ?>
                                <a href="<?= $mailtoUrl ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary">Contact</a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div></div>
        <nav>
            <ul class="pagination mb-0 gap-1">
                <li class="page-item"><?= $this->Paginator->first('« First', ['class' => 'page-link']) ?></li>
                <li class="page-item"><?= $this->Paginator->prev('‹ Prev', ['class' => 'page-link']) ?></li>
                <li class="page-item">
                    <?= $this->Paginator->numbers([
                        'class' => 'page-link',
                        'before' => '<li class="page-item">',
                        'after' => '</li>',
                        'modulus' => 3,
                        'currentClass' => 'active',
                        'currentTag' => 'li'
                    ]) ?>
                </li>
                <li class="page-item"><?= $this->Paginator->next('Next ›', ['class' => 'page-link']) ?></li>
                <li class="page-item"><?= $this->Paginator->last('Last »', ['class' => 'page-link']) ?></li>
            </ul>
        </nav>
        <div class="text-muted small">
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
        </div>
    </div>
</div>

