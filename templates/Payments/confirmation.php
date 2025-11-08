<div class="container text-center py-5">
    <div class="alert alert-success">
        <h2>Thank you for your order!</h2>
        <p>Your payment has been successfully processed.</p>
        <p>An order confirmation email has been sent to your provided email address.</p>
    </div>

    <div class="mt-4">
    <?= $this->Html->link('Return to Home', ['controller' => 'Pages', 'action' => 'display', 'home'], ['class' => 'btn btn-primary']) ?>
    </div>
</div>
