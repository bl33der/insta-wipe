<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Review $review
 * @var string[] $products
 * @var array $allProductDetails
 */
$reviewSubmitted = $this->request->getSession()->consume('ReviewSubmitted');
?>
<div id="captchaFlash" class="alert alert-danger d-none text-center" role="alert">
    Please complete the CAPTCHA before submitting.
</div>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0"><?= __('Add Review') ?></h4>
                </div>
                <div class="card-body">
                    <?= $this->Form->create($review, [
                        'id' => 'reviewForm',
                        'novalidate' => true,
                        'type' => 'file'
                    ]) ?>

                    <div class="mb-3">
                        <?= $this->Form->control('product_id', [
                            'options' => $products,
                            'label' => 'Product',
                            'class' => 'form-select',
                            'required' => true,
                            'empty' => false,
                            'default' => 1
                        ]) ?>
                        <div class="invalid-feedback" id="productError">Please select a product.</div>

                        <div class="mt-3 text-center">
                            <img id="productPreview" src="" alt="Product Preview" class="img-fluid d-none rounded shadow" style="max-height: 200px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <?= $this->Form->control('reviewer_name', [
                            'label' => 'Your Name',
                            'id' => 'reviewer_name',
                            'class' => 'form-control',
                            'required' => true,
                            'maxlength' => 50,
                            'pattern' => '^[A-Za-z ]{3,50}$',
                            'title' => 'Only letters and spaces, 3–50 characters',
                            'escape' => false,
                            'onkeypress' => "return /^[A-Za-z ]$/.test(String.fromCharCode(event.which));",
                            'placeholder' => 'Enter your name...'
                        ]) ?>
                        <div class="invalid-feedback d-block text-danger small mt-1" id="nameError" style="display: none;">
                            Name must be 3–50 letters only. No numbers or special characters.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Rating</label>
                        <div class="star-rating">
                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                <input type="radio" name="rating" id="star<?= $i ?>" value="<?= $i ?>" required />
                                <label for="star<?= $i ?>" title="<?= $i ?> stars">&#9733;</label>
                            <?php endfor; ?>
                        </div>
                        <div class="invalid-feedback d-block" id="ratingError" style="display:none;">Please select a rating.</div>
                    </div>

                    <div class="mb-3">
                        <?= $this->Form->control('comment', [
                            'label' => 'Comment',
                            'class' => 'form-control',
                            'type' => 'textarea',
                            'rows' => 4,
                            'maxlength' => 500,
                            'required' => true,
                            'title' => 'Max 500 characters'
                        ]) ?>
                        <div class="invalid-feedback" id="commentError">Comment is required (max 500 characters).</div>
                    </div>

                    <div class="mb-3">
                        <label for="img_url" class="form-label">Upload Image (optional, JPG/PNG)</label>
                        <?= $this->Form->file('img_url', [
                            'class' => 'form-control',
                            'accept' => 'image/jpeg,image/png'
                        ]) ?>
                    </div>

                    <div class="mb-3 text-center">
                        <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI" data-callback="enableSubmit"></div>
                        <div id="recaptcha-error" class="text-danger mt-2 d-none">Please verify you're not a robot.</div>
                    </div>

                    <div class="text-center">
                        <?= $this->Form->button(__('Submit Review'), ['class' => 'btn btn-success px-4', 'id' => 'submitReviewBtn']) ?>
                    </div>

                    <?= $this->Form->end() ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($reviewSubmitted): ?>
    <div id="reviewSuccessModal" class="popup-overlay" style="display: flex;">
        <div class="popup-content">
            <h3 class="mb-3">Thank you for your feedback!</h3>
            <p>Would you like to return to the homepage?</p>
            <div class="popup-buttons mt-4">
                <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'home']) ?>" class="btn btn-success me-2">Yes</a>
                <button class="btn btn-secondary" onclick="closePopup()">No</button>
            </div>
        </div>
    </div>
<?php endif; ?>

<style>
    .card {
  background-color: #FAF8F4 !important;
  color: #4B3F39 !important;
}

.card-header {
  background-color: #D7A6A1 !important;
  color: #4B3F39 !important;
}
    .star-rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: start;
    }
    .star-rating input[type="radio"] {
        display: none;
    }
    .star-rating label {
        font-size: 2rem;
        color: #ccc;
        cursor: pointer;
        transition: color 0.2s;
        margin: 0 0.1rem;
    }
    .star-rating input:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #ffc107;
    }
    .form-select,
    .form-control {
        border-radius: 5px;
    }
    .popup-overlay {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
    .popup-content {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        text-align: center;
        max-width: 400px;
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
    }
</style>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('reviewForm');
        const nameInput = form.querySelector('input[name="reviewer_name"]');
        const commentInput = form.querySelector('textarea[name="comment"]');
        const ratingInputs = form.querySelectorAll('input[name="rating"]');
        const productSelect = form.querySelector('select[name="product_id"]');
        const productError = document.getElementById('productError');
        const nameError = document.getElementById('nameError');
        const commentError = document.getElementById('commentError');
        const ratingError = document.getElementById('ratingError');
        const captchaFlash = document.getElementById('recaptcha-error');
        const productPreview = document.getElementById('productPreview');
        const productImages = <?= json_encode($allProductDetails) ?>;

        // Block all copy/paste/cut/contextmenu and shortcuts
        [nameInput, commentInput].forEach(input => {
            input.addEventListener('copy', e => e.preventDefault());
            input.addEventListener('paste', e => e.preventDefault());
            input.addEventListener('cut', e => e.preventDefault());
            input.addEventListener('contextmenu', e => e.preventDefault());
            input.addEventListener('keydown', function (e) {
                if ((e.ctrlKey || e.metaKey) && ['v', 'c', 'x'].includes(e.key.toLowerCase())) {
                    e.preventDefault();
                }
                if (e.shiftKey && e.key === 'Insert') {
                    e.preventDefault();
                }
            });
        });

        nameInput.addEventListener('input', () => {
            const cleaned = nameInput.value.replace(/[^A-Za-z ]/g, '');
            if (cleaned !== nameInput.value) nameInput.value = cleaned;
            const valid = /^[A-Za-z ]{3,50}$/.test(nameInput.value.trim());
            nameInput.classList.toggle('is-invalid', !valid);
            nameError.style.display = valid ? 'none' : 'block';
        });

        commentInput.addEventListener('input', () => {
            const valid = commentInput.value.trim().length > 0 && commentInput.value.length <= 500;
            commentInput.classList.toggle('is-invalid', !valid);
            commentError.style.display = valid ? 'none' : 'block';
        });

        productSelect.addEventListener('change', () => {
            const valid = productSelect.value !== '';
            productSelect.classList.toggle('is-invalid', !valid);
            productError.style.display = valid ? 'none' : 'block';

            const selectedId = productSelect.value;
            if (productImages[selectedId]?.img) {
                productPreview.src = '/img/' + productImages[selectedId]['img'];
                productPreview.classList.remove('d-none');
            } else {
                productPreview.classList.add('d-none');
            }
        });

        ratingInputs.forEach(input => {
            input.addEventListener('change', () => {
                const valid = Array.from(ratingInputs).some(i => i.checked);
                ratingError.style.display = valid ? 'none' : 'block';
            });
        });

        form.addEventListener('submit', function (e) {
            const nameValid = /^[A-Za-z ]{3,50}$/.test(nameInput.value.trim());
            const commentValid = commentInput.value.trim().length > 0 && commentInput.value.length <= 500;
            const ratingValid = Array.from(ratingInputs).some(i => i.checked);
            const productValid = productSelect.value !== '';
            const captchaResponse = grecaptcha.getResponse();

            nameInput.classList.toggle('is-invalid', !nameValid);
            nameError.style.display = nameValid ? 'none' : 'block';

            commentInput.classList.toggle('is-invalid', !commentValid);
            commentError.style.display = commentValid ? 'none' : 'block';

            productSelect.classList.toggle('is-invalid', !productValid);
            productError.style.display = productValid ? 'none' : 'block';

            ratingError.style.display = ratingValid ? 'none' : 'block';

            if (!captchaResponse) {
                e.preventDefault();
                captchaFlash.classList.remove('d-none');
                captchaFlash.scrollIntoView({ behavior: 'smooth' });
                return;
            } else {
                captchaFlash.classList.add('d-none');
            }

            if (!(nameValid && commentValid && ratingValid && productValid)) {
                e.preventDefault();
            }
        });

        const modal = document.getElementById('reviewSuccessModal');
        if (modal) modal.style.display = 'flex';
    });
</script>

<script>
    function enableSubmit() {
        const btn = document.getElementById('submitReviewBtn');
        btn.disabled = false;
    }

    document.addEventListener('DOMContentLoaded', function () {
        const submitBtn = document.getElementById('submitReviewBtn');
        submitBtn.disabled = true;
    });
</script>

