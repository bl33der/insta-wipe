<?php
/**
 * @var \App\View\AppView $this
 * @var string $message
 * @var string $subject
 * @var string $email
 * @var \Cake\I18n\DateTime $created
 * @var string $id
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= h($subject) ?></title>
</head>
<body>
<h2>New Enquiry Received</h2>

<p><strong>Enquiry ID:</strong> <?= h($id) ?></p>
<p><strong>Received:</strong> <?= $created->format('d M Y H:i:s') ?></p>
<p><strong>From:</strong> <?= h($email) ?></p>

<h3>Message Content:</h3>
<div style="border:1px solid #ddd; padding:15px; margin:10px 0;">
    <?= nl2br(h($message)) ?>
</div>

<hr>

<p style="color:#666;">
    This enquiry was submitted through the website contact form.<br>
    Please respond within 24-48 business hours.
</p>
</body>
</html>
