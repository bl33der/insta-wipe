<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Back to Dashboard -->
        <?= $this->Html->link('Back to Admin Dashboard', ['controller' => 'Users', 'action' => 'index'], ['class' => 'btn btn-outline-secondary btn-sm']) ?>

        <!-- Sort Controls -->
        <form method="get" class="d-flex gap-2 align-items-center mb-0">
            <label class="me-2 mb-0">Sort by:</label>
            <select name="sort" class="form-select form-select-sm" style="width: 150px;" onchange="this.form.submit()">
                <option value="id" <?= $this->request->getQuery('sort') === 'id' ? 'selected' : '' ?>>ID</option>
                <option value="email" <?= $this->request->getQuery('sort') === 'email' ? 'selected' : '' ?>>Email</option>
                <option value="subject" <?= $this->request->getQuery('sort') === 'subject' ? 'selected' : '' ?>>Subject</option>
                <option value="created" <?= $this->request->getQuery('sort') === 'created' ? 'selected' : '' ?>>Created</option>
                <option value="is_resolved" <?= $this->request->getQuery('sort') === 'is_resolved' ? 'selected' : '' ?>>Resolved</option>
            </select>

            <select name="direction" class="form-select form-select-sm" style="width: 120px;" onchange="this.form.submit()">
                <option value="asc" <?= $this->request->getQuery('direction') === 'asc' ? 'selected' : '' ?>>Ascending</option>
                <option value="desc" <?= $this->request->getQuery('direction') === 'desc' ? 'selected' : '' ?>>Descending</option>
            </select>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-dark">
            <tr>
                <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                <th><?= $this->Paginator->sort('email', 'Email') ?></th>
                <th><?= $this->Paginator->sort('subject', 'Subject') ?></th>
                <th><?= $this->Paginator->sort('created', 'Date Submitted') ?></th>
                <th><?= $this->Paginator->sort('is_resolved', 'Resolved') ?></th>
                <th><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($enquiries as $enquiry): ?>
                <tr>
                    <td><?= h($enquiry->id) ?></td>
                    <td><?= h($enquiry->email) ?></td>
                    <td><?= h($enquiry->subject) ?></td>
                    <td><?= h($enquiry->created->format('d M Y, H:i A')) ?></td>
                    <td>
                        <?php if ($enquiry->is_resolved): ?>
                            <span class="badge bg-success">Yes</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">No</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-nowrap">
                        <?= $this->Html->link('View', ['action' => 'view', $enquiry->id], ['class' => 'btn btn-info btn-sm me-1']) ?>

                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?= h($enquiry->email) ?>&su=Re:%20<?= urlencode($enquiry->subject) ?>&body=Dear%20<?= h(explode('@', $enquiry->email)[0]) ?>,%0A%0AThank%20you%20for%20your%20enquiry%20regarding%20'<?= urlencode($enquiry->subject) ?>'.%0A%0A[Your%20response%20here]%0A%0ARegards,%0AInstaWipe%20Support"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn btn-success btn-sm me-1">
                            Reply
                        </a>

                        <?php if (!$enquiry->is_resolved): ?>
                            <?= $this->Form->postLink('Mark as Done', ['action' => 'markResolved', $enquiry->id], [
                                'class' => 'btn btn-secondary btn-sm',
                                'confirm' => 'Mark this enquiry as resolved?'
                            ]) ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="paginator mt-3">
        <ul class="pagination">
            <?= $this->Paginator->first('<<') ?>
            <?= $this->Paginator->prev('<') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('>') ?>
            <?= $this->Paginator->last('>>') ?>
        </ul>
        <p class="text-muted">
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
        </p>
    </div>
</div>
