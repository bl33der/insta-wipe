<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enquiry $enquiry
 */
?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg p-4" style="background-color: #FAF8F4; color: #4B3F39;">
            <h3 class="text-center mb-4"  color: #4B3F39; padding: 1rem; border-radius: 0.5rem;">
                <?= __('Contact Us') ?>
            </h3>


            <?= $this->Form->create($enquiry, ['id' => 'enquiryForm']) ?>
            <fieldset>
                <div class="mb-3">
                    <?= $this->Form->label('email', 'Your Email') ?>
                    <?= $this->Form->control('email', [
                        'label' => false,
                        'class' => 'form-control',
                        'placeholder' => 'Enter your email...',
                        'required' => true,
                        'type' => 'email',
                        'pattern' => '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$',
                        'title' => 'Enter a valid email address'
                    ]) ?>
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>

                <div class="mb-3">
                    <?= $this->Form->label('subject', 'Subject') ?>
                    <?= $this->Form->control('subject', [
                        'label' => false,
                        'class' => 'form-control',
                        'placeholder' => 'Enter a subject...',
                        'required' => true,
                        'pattern' => '^[a-zA-Z0-9 .,!?\(\)\-]{5,100}$',
                        'title' => 'Subject should be 5–100 characters and can include letters, numbers, and basic punctuation'
                    ]) ?>
                    <div class="invalid-feedback">Subject must be 5–100 characters. No special symbols like < > & " allowed.</div>
                </div>


                <div class="mb-3">
                    <?= $this->Form->label('message', 'Message') ?>
                    <?= $this->Form->control('message', [
                        'label' => false,
                        'class' => 'form-control',
                        'placeholder' => 'Write your message...',
                        'rows' => 5,
                        'required' => true,
                        'maxlength' => 300,
                        'pattern' => '^[a-zA-Z0-9 .,!?()"\'' . '\\\\-]{10,300}$',
                        'title' => 'Message should be 10–300 characters. Avoid < > & symbols.'
                    ]) ?>
                    <div class="invalid-feedback">Message must be 10–300 characters. Symbols like < > & are not allowed.</div>
                </div>



                <div class="mb-3 text-center">
                    <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
                    <div id="recaptcha-error" class="text-danger mt-2 d-none">Please complete the reCAPTCHA.</div>
                </div>
            </fieldset>

            <div class="text-center">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary w-100']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<!-- Popup Modal -->
<div id="popupModal" class="popup-overlay" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.5); justify-content:center; align-items:center; z-index:9999;">
    <div class="popup-content bg-white p-4 rounded shadow" style="max-width:400px; text-align:center;">
        <h4 class="mb-3">Thank you!</h4>
        <p>Your enquiry has been submitted. We'll get in touch via email.</p>
        <div class="popup-buttons d-flex justify-content-around mt-4">
            <button onclick="redirectToHome()" class="btn btn-primary">Back to Home</button>
            <button onclick="closePopup()" class="btn btn-outline-secondary">Stay on Page</button>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('enquiryForm');
        const email = form.querySelector("input[name='email']");
        const subject = form.querySelector("input[name='subject']");
        const message = form.querySelector("textarea[name='message']");
        const recaptchaError = document.getElementById('recaptcha-error');

        function validateField(field) {
            const feedback = field.parentElement.querySelector('.invalid-feedback');
            if (!field.checkValidity()) {
                field.classList.add('is-invalid');
                if (feedback) feedback.classList.remove('d-none');
            } else {
                field.classList.remove('is-invalid');
                if (feedback) feedback.classList.add('d-none');
            }
        }

        function checkRecaptcha() {
            const response = document.querySelector('.g-recaptcha-response');
            if (!response || response.value.trim() === '') {
                recaptchaError.classList.remove('d-none');
                return false;
            }
            recaptchaError.classList.add('d-none');
            return true;
        }

        // Real-time validation
        [email, subject, message].forEach(field => {
            field.addEventListener('input', () => validateField(field));
        });

        const observer = new MutationObserver(() => {
            const response = document.querySelector('.g-recaptcha-response');
            if (response && response.value.trim() !== '') {
                recaptchaError.classList.add('d-none');
            }
        });
        observer.observe(document.body, { childList: true, subtree: true });

        form.addEventListener('submit', function (e) {
            let valid = true;
            [email, subject, message].forEach(field => {
                validateField(field);
                if (!field.checkValidity()) valid = false;
            });

            if (!checkRecaptcha()) valid = false;

            if (!valid) {
                e.preventDefault();
                return false;
            }

            // Allow the form to submit normally
        });
    });

    function closePopup() {
        document.getElementById("popupModal").style.display = "none";
    }

    function redirectToHome() {
        window.location.href = "<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'home']) ?>";
    }
</script>

<!-- Popup trigger if submission was successful -->
<?php if (!empty($showPopup)): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById("popupModal").style.display = "flex";
        });
    </script>
<?php endif; ?>

<!-- Styles -->
<style>
    .is-invalid {
        border-color: #dc3545 !important;
    }
    .invalid-feedback {
        display: none;
        color: #dc3545;
        font-size: 0.875rem;
    }
</style>
