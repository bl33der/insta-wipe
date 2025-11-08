<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white text-center">
                    <h3><?= __('Add Product') ?></h3>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($product, ['type' => 'file', 'class' => 'needs-validation', 'novalidate' => true]) ?>

                    <div class="mb-3">
                        <?= $this->Form->control('product_name', [
                            'label' => 'Product Name',
                            'class' => 'form-control',
                            'required' => true,
                            'minlength' => 3,
                            'maxlength' => 100,
                            'pattern' => '^[A-Za-z ]{3,100}$',
                            'title' => 'Product name must be 3–100 letters only (no numbers or symbols)'
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $this->Form->control('price', [
                            'label' => 'Price ($)',
                            'class' => 'form-control',
                            'type' => 'number',
                            'required' => true,
                            'step' => '0.01',
                            'min' => 0.01,
                            'max' => 9999.99,
                            'title' => 'Enter a price between 0.01 and 9999.99'
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $this->Form->control('description', [
                            'label' => 'Description',
                            'class' => 'form-control',
                            'type' => 'textarea',
                            'rows' => 3,
                            'required' => true,
                            'minlength' => 10,
                            'maxlength' => 500,
                            'title' => 'Description should be 10–500 characters'
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <label for="img_url" class="form-label">Product Image (jpg or jpeg only)</label>
                        <?= $this->Form->file('img_url', [
                            'class' => 'form-control',
                            'accept' => '.jpg,.jpeg,image/jpeg',
                            'required' => true
                        ]) ?>
                    </div>

                    <div class="text-center">
                        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success px-4']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>

        <div class="text-center mt-3">
        <?= $this->Html->link(__('Back to Admin Dashboard'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    </div>
</div>

<script>
    const fileInput = document.querySelector('input[type="file"]');

    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const validTypes = ['image/jpeg'];
            const validExtensions = ['.jpg', '.jpeg'];
            const fileName = file.name.toLowerCase();

            const isTypeValid = validTypes.includes(file.type);
            const isExtValid = validExtensions.some(ext => fileName.endsWith(ext));

            if (!isTypeValid || !isExtValid) {
                alert('Only JPG or JPEG files are allowed.');
                fileInput.value = ''; // Clear the file input
                const existingPreview = document.getElementById('preview-image');
                if (existingPreview) existingPreview.remove();
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                let preview = document.getElementById('preview-image');
                if (!preview) {
                    preview = document.createElement('img');
                    preview.id = 'preview-image';
                    preview.className = 'img-fluid mt-3 rounded shadow d-block';
                    preview.style.maxHeight = '200px';
                    fileInput.parentElement.appendChild(preview);
                }
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }
    });

    // Real-time validation feedback
    document.querySelectorAll('input, textarea').forEach(input => {
        input.addEventListener('input', function () {
            this.setCustomValidity('');
            if (!this.checkValidity()) {
                this.reportValidity();
            }
        });
    });

    // Prevent invalid form submission
    document.querySelector('.needs-validation').addEventListener('submit', function (event) {
        if (!this.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const fields = Array.from(document.querySelectorAll('.form-control')).filter(el => el.type !== 'submit');

        fields.forEach((field, index) => {
            field.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' && field.tagName !== 'TEXTAREA') {
                    e.preventDefault();
                    const next = fields[index + 1];
                    if (next) {
                        next.focus();
                    }
                }
            });
        });
    });
</script>
