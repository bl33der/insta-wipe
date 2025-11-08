<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\ORM\ResultSet|\App\Model\Entity\User[] $users
 */
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Manage Admins</h2>
        <?= $this->Html->link('Add Admin', ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </div>

    <?php if (!empty($users->count())): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= h($user->username) ?></td>
                        <td><?= h($user->email) ?></td>
                        <td>
                            <div class="btn-group">
                                <?= $this->Html->link('Edit', ['action' => 'edit', $user->id], ['class' => 'btn btn-warning btn-sm']) ?>
                               <!-- <?= $this->Form->postLink('Delete', ['action' => 'delete', $user->id], [
                                    'class' => 'btn btn-danger btn-sm',
                                    'confirm' => 'Are you sure you want to delete this admin?'
                                ]) ?>-->
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-muted text-center">No admins found.</p>
    <?php endif; ?>
</div>

