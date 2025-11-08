<?php
/**
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;

$debug = Configure::read('debug');

$this->layout = 'login';
$this->assign('title', 'Login');

$failedAttempts = $this->request->getSession()->read('Login.failedAttempts') ?? 0;
$lastFailedTime = $this->request->getSession()->read('Login.lastFailedTime');
$blockDuration = 30; // seconds
$now = time();
$blocked = $failedAttempts >= 3 && ($now - $lastFailedTime) < $blockDuration;
?>

<div class="container login">
    <div class="row">
        <div class="column column-50 column-offset-25">
            <div class="users form content">

                <?php if (!$blocked): ?>
                    <?= $this->Form->create() ?>

                    <fieldset>
                        <legend>Login</legend>

                        <?= $this->Flash->render() ?>
                        <div id="recaptcha-error" class="flash-message flash-error" style="display: none;"></div>

                        <?php
                        echo $this->Form->control('email', [
                            'type' => 'email',
                            'required' => true,
                            'autofocus' => true,
                        ]);
                        echo $this->Form->control('password', [
                            'type' => 'password',
                            'required' => true,
                        ]);
                        ?>

                        <div class="mb-3 text-center">
                            <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
                        </div>
                    </fieldset>

                    <?= $this->Form->button('Login') ?>
                    <?= $this->Html->link('Forgot password?', ['controller' => 'Auth', 'action' => 'forgetPassword'], ['class' => 'button button-outline']) ?>
                    <?= $this->Form->end() ?>

                    <hr class="hr-between-buttons">

                    <?= $this->Html->link('Go to Homepage', '/', ['class' => 'button button-clear']) ?>
                <?php else: ?>
                    <div class="alert alert-warning text-center">
                        Too many failed login attempts. Please try again in <?= $blockDuration - ($now - $lastFailedTime) ?> seconds.
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<style>
    .flash-message {
        padding: 1rem 1.5rem;
        margin-bottom: 1rem;
        border-radius: 6px;
        font-weight: 500;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        position: relative;
        font-size: 0.95rem;
    }

    .flash-success {
        background-color: #d4edda;
        color: #155724;
        border-left: 5px solid #28a745;
    }

    .flash-error {
        background-color: #f8d7da;
        color: #721c24;
        border-left: 5px solid #dc3545;
    }

    .flash-default {
        background-color: #e2e3e5;
        color: #383d41;
        border-left: 5px solid #6c757d;
    }
</style>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        const errorBox = document.getElementById('recaptcha-error');

        if (form) {
            form.addEventListener('submit', function (event) {
                const recaptchaResponse = grecaptcha.getResponse();
                if (!recaptchaResponse) {
                    event.preventDefault();
                    errorBox.innerText = 'Please complete the CAPTCHA.';
                    errorBox.style.display = 'block';
                } else {
                    errorBox.style.display = 'none';
                }
            });
        }
    });
</script>
