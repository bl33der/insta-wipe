<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="flash-message success" onclick="this.classList.add('hide')">
    <span class="icon">✔</span>
    <?= $message ?>
</div>

<style>
.flash-message.success {
    background-color: #d1f3da;
    color: #276738;
    padding: 14px 20px;
    margin: 20px 0;
    border-left: 5px solid #3bb54a;
    border-radius: 6px;
    font-family: sans-serif;
    font-size: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.06);
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    animation: fadeInSlide 0.4s ease-out;
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.flash-message.success .icon {
    font-weight: bold;
    font-size: 18px;
    color: #1e7e34;
}

.flash-message.success.hide {
    opacity: 0;
    transform: translateY(-10px);
    pointer-events: none;
}

@keyframes fadeInSlide {
    from {
        opacity: 0;
        transform: translateY(-8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
    setTimeout(() => {
        const flash = document.querySelector('.flash-message.success');
        if (flash) flash.classList.add('hide');
    }, 4000);
</script>
