<div class="container py-5">
    <div class="row">
        <!-- Actions Sidebar -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <strong>Actions</strong>
                </div>
                <div class="card-body">
                    <?= $this->Form->postLink(
                        'Delete Product',
                        ['action' => 'delete', $product->product_id],
                        [
                            'class' => 'btn btn-danger w-100 mb-2',
                            'confirm' => 'Are you sure you want to delete #' . $product->product_id . '?'
                        ]
                    ) ?>
                    <?= $this->Html->link('Back to Product List', ['action' => 'manage'], ['class' => 'btn btn-outline-secondary w-100']) ?>
                </div>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Edit Product</h4>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($product, ['type' => 'file', 'id' => 'editProductForm']) ?>

                    <div class="mb-3">
                        <?= $this->Form->label('product_name', 'Product Name') ?>
                        <?= $this->Form->control('product_name', [
                            'label' => false,
                            'class' => 'form-control',
                            'required' => true,
                            'minlength' => 3,
                            'placeholder' => 'Enter product name'
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $this->Form->label('price', 'Price ($)') ?>
                        <?= $this->Form->control('price', [
                            'label' => false,
                            'type' => 'number',
                            'step' => '0.01',
                            'min' => '0',
                            'class' => 'form-control',
                            'placeholder' => 'Enter price',
                            'required' => true
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $this->Form->label('stock_quantity', 'Stock Quantity') ?>
                        <?= $this->Form->control('stock_quantity', [
                            'label' => false,
                            'type' => 'number',
                            'min' => '0',
                            'step' => '1',
                            'class' => 'form-control',
                            'placeholder' => 'Enter stock quantity',
                            'required' => true
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $this->Form->label('description', 'Description') ?>
                        <?= $this->Form->control('description', [
                            'type' => 'textarea',
                            'label' => false,
                            'class' => 'form-control',
                            'maxlength' => '1000',
                            'placeholder' => 'Optional description...'
                        ]) ?>
                    </div>

                    <div class="mb-4">
                        <?= $this->Form->label('img_url', 'Upload New Image (JPEG/PNG only)') ?>
                        <?= $this->Form->control('img_url', [
                            'type' => 'file',
                            'label' => false,
                            'accept' => 'image/png, image/jpeg',
                            'class' => 'form-control'
                        ]) ?>
                    </div>

                    <div class="d-grid">
                        <?= $this->Form->button('Update Product', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Image validation
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('editProductForm');
        form.addEventListener('submit', function (e) {
            const fileInput = form.querySelector('input[type="file"]');
            if (fileInput && fileInput.files.length > 0) {
                const file = fileInput.files[0];
                const validTypes = ['image/jpeg', 'image/png'];
                const validExtensions = ['.jpg', '.jpeg', '.png'];
                const fileName = file.name.toLowerCase();
                const isTypeValid = validTypes.includes(file.type);
                const isExtValid = validExtensions.some(ext => fileName.endsWith(ext));

                if (!isTypeValid && !isExtValid) {
                    e.preventDefault();
                    alert('Please upload a JPEG or PNG image.');
                }
            }
        });
    });
</script>
