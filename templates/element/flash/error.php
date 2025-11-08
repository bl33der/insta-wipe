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
<div class="flash-message error" onclick="this.classList.add('hidden')">
    <span class="icon">✖</span>
    <?= $message ?>
</div>

<style>
.flash-message.error {
    background-color: #f8d7da;
    color: #721c24;
    padding: 14px 20px;
    margin: 20px 0;
    border-left: 5px solid #dc3545;
    border-radius: 6px;
    font-family: sans-serif;
    font-size: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    animation: fadeInSlide 0.4s ease-out;
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.flash-message.error .icon {
    font-size: 18px;
    color: #721c24;
}

.flash-message.error.hide {
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
        const flash = document.querySelector('.flash-message.error');
        if (flash) flash.classList.add('hidden');
    }, 4000);
</script>
