<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg mt-4">
            <div class="card-header bg-primary text-white text-center">
                <h4><?= __('Add Admin') ?></h4>
            </div>
            <div class="card-body">

                <?= $this->Form->create($user, ['class' => 'needs-validation', 'novalidate' => true, 'id' => 'admin-form']) ?>
                
                <div class="mb-3">

                <?= $this->Form->control('username', ['label' => 'Username', 'required' => true, 'class' => 'form-control']) ?>
                </div>
                <div class="mb-3">

                    <?= $this->Form->control('password', [
                        'class' => 'form-control',
                        'label' => ['class' => 'form-label'],
                        'required' => true,
                        'type' => 'password',
                        'placeholder' => 'Enter password'
                    ]); ?>
                </div>
                <div class="mb-3">
                    <?= $this->Form->control('email', ['label' => 'Email Address', 'required' => true, 'class' => 'form-control']) ?>
                </div>
                
                <?= $this->Form->hidden('nonce', ['value' => 0]); ?>
                <?= $this->Form->hidden('nonce_expiry', ['empty' => true]); ?>

                <div class="d-grid">
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success btn-lg']) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>

        <div class="text-center mt-3">
            <?= $this->Html->link(__('Back to Admin dashboard'), ['action' => 'index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('admin-form');  
    const requiredFields = ['username', 'email', 'password']; 

    function validateField(field) {
        const value = field.value.trim();
        let isValid = true;
        let errorMessage = '';

        switch (field.name) {
            case 'username':
                if (!value) {
                    errorMessage = 'User Name is required.';
                    isValid = false;
                } else if (!/^[a-zA-Z\s\-']{2,}$/.test(value)) {
                    errorMessage = 'User Name can only contain letters, spaces, hyphens, or apostrophes.';
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

            case 'password':
                if (!value) {
                    errorMessage = 'Password is required.';
                    isValid = false;
                } else if (value.length < 8) { 
                    errorMessage = 'Password must be at least 8 characters long.';
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
});
</script>
