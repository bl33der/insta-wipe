<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enquiry $enquiry
 */
?>
<div class="enquiry-container">
    <div class="side-panel">
        <h4 class="side-heading">Actions</h4>
        <?= $this->Html->link(__('Back to Enquiries Management'), ['action' => 'index'], ['class' => 'button button-list']) ?>
        <?= $this->Html->link(__('Back to Admin Dashboard'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'button button-dashboard']) ?>
    </div>

    <div class="content-panel">
        <div class="enquiry-header">
            <h2><?= __('Enquiry Details') ?></h2>
        </div>

        <table class="styled-table">
            <tr>
                <th><?= __('Email') ?></th>
                <td><?= h($enquiry->email) ?></td>
            </tr>
            <tr>
                <th><?= __('Subject') ?></th>
                <td><?= h($enquiry->subject) ?></td>
            </tr>
            <tr>
                <th><?= __('Created') ?></th>
                <td><?= h($enquiry->created->format('d M Y, H:i A')) ?></td>
            </tr>
        </table>

        <div class="message-box">
            <strong><?= __('Message') ?></strong>
            <blockquote>
                <?= $this->Text->autoParagraph(h($enquiry->message)); ?>
            </blockquote>
        </div>

        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?= h($enquiry->email) ?>&su=Re:%20<?= urlencode($enquiry->subject) ?>&body=Dear%20<?= h(explode('@', $enquiry->email)[0]) ?>,%0A%0AThank%20you%20for%20your%20enquiry%20regarding%20'<?= urlencode($enquiry->subject) ?>'.%0A%0A[Your%20response%20here]%0A%0ARegards,%0AInstaWipe%20Support"
           target="_blank"
           rel="noopener noreferrer"
           class="btn btn-success mt-3">
            Reply via Gmail
        </a>
    </div>
</div>

<style>
    .enquiry-container {
        display: flex;
        gap: 20px;
        align-items: flex-start;
        max-width: 900px;
        margin: auto;
    }

    .side-panel {
        width: 20%;
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
    }

    .side-heading {
        margin-bottom: 10px;
        font-size: 16px;
        font-weight: bold;
    }

    .button {
        display: block;
        text-align: center;
        padding: 8px;
        margin-bottom: 10px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 14px;
    }

    .button-list {
        background: #007bff;
        color: #fff;
    }

    .button-dashboard {
        background: #6c757d;
        color: #fff;
    }

    .button:hover {
        opacity: 0.8;
    }

    .content-panel {
        width: 75%;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .styled-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .styled-table th, .styled-table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .styled-table th {
        background: #f8f9fa;
        font-weight: bold;
    }

    .message-box {
        margin-top: 20px;
        padding: 15px;
        background: #f1f1f1;
        border-left: 5px solid #007bff;
        border-radius: 5px;
    }
</style>
