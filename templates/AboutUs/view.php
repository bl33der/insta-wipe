<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AboutU $aboutU
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit About U'), ['action' => 'edit', $aboutU->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete About U'), ['action' => 'delete', $aboutU->id], ['confirm' => __('Are you sure you want to delete # {0}?', $aboutU->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List About Us'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New About U'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="aboutUs view content">
            <h3><?= h($aboutU->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($aboutU->id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Content') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($aboutU->content)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>