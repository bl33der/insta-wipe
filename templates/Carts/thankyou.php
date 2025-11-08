<?php
/**
 * @var \App\View\AppView $this
 * @var string $message
 */
?>

<div class="container py-5 text-center">
    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-header bg-success text-white">
            <h3 class="mb-0">Order Confirmed</h3>
        </div>
        <div class="card-body">
            <p class="lead"><?= h($message) ?></p>
            <p class="text-muted">We appreciate your business.</p>
            <?= $this->Html->link('Return to Home', ['controller' => 'Pages', 'action' => 'display', 'home'], [
                'class' => 'btn btn-primary mt-3'
            ]) ?>
        </div>
    </div>
</div>
