<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\ORM\ResultSet|\App\Model\Entity\Cart[] $cartItems
 * @var float $totalAmount
 */

$shippingCost = 10.00;
$grandTotal = $totalAmount;
?>

<div class="container py-5">
    <h2 class="mb-4">Checkout - Billing & Shipping Information</h2>

    <?= $this->Form->create(null, ['class' => 'bg-light p-4 rounded shadow-sm', 'id' => 'checkout-form']) ?>

    <div class="row g-3">
        <div class="col-md-6">
            <?= $this->Form->control('name', ['label' => 'Full Name', 'required' => true, 'class' => 'form-control']) ?>
            <?= $this->Form->control('email', ['label' => 'Email Address', 'required' => true, 'class' => 'form-control']) ?>
            <?= $this->Form->control('address_line', ['label' => 'Street Address', 'required' => true, 'class' => 'form-control']) ?>
            <?= $this->Form->control('city', ['required' => true, 'class' => 'form-control']) ?>
        </div>

        <div class="col-md-6">
            <?= $this->Form->control('state', ['required' => true, 'class' => 'form-control']) ?>
            <?= $this->Form->control('postal_code', ['label' => 'Postal Code', 'required' => true, 'class' => 'form-control']) ?>
            <?= $this->Form->control('country', ['required' => true, 'class' => 'form-control']) ?>
        </div>
    </div>

    <div class="mt-4">
        <h4>Shipping Method</h4>
        <div class="form-check">
            <input class="form-check-input shipping-option" type="radio" name="shipping_method" id="standard" value="11" checked>
            <label class="form-check-label" for="standard">
                Australia Post Standard Postage ($11.00)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input shipping-option" type="radio" name="shipping_method" id="express" value="15">
            <label class="form-check-label" for="express">
                Australia Post Express Postage ($15.00)
            </label>
        </div>
    </div>

    <div class="mt-4">
        <h4>Discount Code</h4>
        <div class="input-group">
            <?= $this->Form->control('discount_code', [
                'label' => false,
                'placeholder' => 'Enter discount code',
                'class' => 'form-control',
                'id' => 'discount-code'
            ]) ?>
            <button type="button" id="apply-discount" class="btn btn-outline-secondary">Apply</button>
        </div>
        <div id="discount-feedback" class="form-text text-danger mt-1"></div>
    </div>

    <div class="mt-5">
        <h4>Order Summary</h4>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Product</th>
                <th class="text-center">Quantity</th>
                <th class="text-end">Price (AUD)</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td><?= h($item->product->product_name) ?></td>
                    <td class="text-center"><?= h($item->quantity) ?></td>
                    <td class="text-end"><?= number_format($item->product->price * $item->quantity, 2) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <h5>Subtotal: AUD <span id="subtotal"><?= number_format($totalAmount, 2) ?></span></h5>
        <h5>Discount: -AUD <span id="discount">0.00</span></h5>
        <h5>Shipping: AUD <span id="shipping-cost">11.00</span></h5>
        <h4>Grand Total: AUD <span id="grand-total"><?= number_format($totalAmount + 11.00, 2) ?></span></h4>
    </div>

    <div class="text-end mt-4">
        <?= $this->Form->button('Proceed to Payment', ['class' => 'btn btn-primary btn-lg']) ?>
    </div>

    <?= $this->Form->end() ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('checkout-form');
        const requiredFields = ['name', 'email', 'address_line', 'city', 'state', 'postal_code', 'country'];

        // Validate individual field
        function validateField(field) {
            const value = field.value.trim();
            let isValid = true;
            let errorMessage = '';

            switch (field.name) {
                case 'name':
                    if (!value) {
                        errorMessage = 'Full Name is required.';
                        isValid = false;
                    } else if (!/^[a-zA-Z\s\-']{2,}$/.test(value)) {
                        errorMessage = 'Full Name can only contain letters, spaces, hyphens, or apostrophes.';
                        isValid = false;
                    }
                    break;
                case 'email':
                    if (!value) {
                        errorMessage = 'Email address is required.';
                        isValid = false;
                    } else if (!/^\S+@\S+\.\S+$/.test(value)) {
                        errorMessage = 'Please enter a valid email address.';
                        isValid = false;
                    }
                    break;
                case 'address_line':
                    if (!value) {
                        errorMessage = 'Street address is required.';
                        isValid = false;
                    } else if (value.length < 5) {
                        errorMessage = 'Street address must be at least 5 characters.';
                        isValid = false;
                    }
                    break;
                case 'city':
                case 'state':
                case 'country':
                    if (!value) {
                        errorMessage = `${capitalize(field.name)} is required.`;
                        isValid = false;
                    } else if (!/^[a-zA-Z\s\-]{2,}$/.test(value)) {
                        errorMessage = `${capitalize(field.name)} must only contain letters and spaces.`;
                        isValid = false;
                    }
                    break;
                case 'postal_code':
                    if (!value) {
                        errorMessage = 'Postal Code is required.';
                        isValid = false;
                    } else if (!/^\d{4,6}$/.test(value)) {
                        errorMessage = 'Postal Code must be 4 to 6 digits.';
                        isValid = false;
                    }
                    break;
            }

            const existingFeedback = field.parentNode.querySelector('.invalid-feedback');
            if (!isValid) {
                field.classList.add('is-invalid');
                if (!existingFeedback) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback';
                    errorDiv.textContent = errorMessage;
                    field.parentNode.appendChild(errorDiv);
                } else {
                    existingFeedback.textContent = errorMessage;
                }
            } else {
                field.classList.remove('is-invalid');
                if (existingFeedback) existingFeedback.remove();
            }

            return isValid;
        }

        function capitalize(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }

        requiredFields.forEach((name) => {
            const input = document.querySelector(`[name="${name}"]`);
            if (input) {
                input.addEventListener('input', () => validateField(input));
            }
        });

        form.addEventListener('submit', function (e) {
            let allValid = true;
            requiredFields.forEach((name) => {
                const input = document.querySelector(`[name="${name}"]`);
                if (input && !validateField(input)) {
                    allValid = false;
                }
            });

            if (!allValid) {
                e.preventDefault();
                alert('Please correct the highlighted errors before continuing.');
            }
        });

        // Handle shipping change
        document.querySelectorAll('.shipping-option').forEach((radio) => {
            radio.addEventListener('change', function () {
                const shippingCost = parseFloat(this.value);
                const subtotal = parseFloat(document.getElementById('subtotal').innerText);
                const discount = parseFloat(document.getElementById('discount').innerText);
                const grandTotal = subtotal - discount + shippingCost;

                document.getElementById('shipping-cost').textContent = shippingCost.toFixed(2);
                document.getElementById('grand-total').textContent = grandTotal.toFixed(2);
            });
        });

        let validCodes = {};

        // Use PHP to build the correct route
        const discountEndpoint = '<?= $this->Url->build("/discounts/active-codes") ?>';

        // Fetch all active codes
        fetch(discountEndpoint)
            .then(res => res.json())
            .then(codes => {
                codes.forEach(c => {
                    validCodes[c.discount_code] = parseFloat(c.discount_amount);
                });
            });

        document.getElementById('apply-discount').addEventListener('click', function () {
            const input = document.getElementById('discount-code');
            const code = input.value.trim();
            const discount = validCodes[code];

            const feedback = document.getElementById('discount-feedback');
            const shipping = parseFloat(document.getElementById('shipping-cost').innerText);
            const subtotal = parseFloat(document.getElementById('subtotal').innerText);

            if (discount) {
                // ✅ Just set the number, label remains in HTML
                document.getElementById('discount').innerText = discount.toFixed(2);
                document.getElementById('grand-total').textContent = (subtotal + shipping - discount).toFixed(2);
                feedback.textContent = 'Discount applied!';
                feedback.classList.remove('text-danger');
                feedback.classList.add('text-success');
            } else {
                feedback.textContent = 'Invalid or expired discount code.';
                feedback.classList.remove('text-success');
                feedback.classList.add('text-danger');
            }
        });
    });
</script>
