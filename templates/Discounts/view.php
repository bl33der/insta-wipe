<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h5 class="mb-0">Discount #<?= h($discount->discount_id) ?></h5>
                    <div class="btn-group">
                        <?= $this->Html->link('Edit', ['action' => 'edit', $discount->discount_id], ['class' => 'btn btn-sm btn-light']) ?>
                        <?= $this->Form->postLink('Delete', ['action' => 'delete', $discount->discount_id], [
                            'class' => 'btn btn-sm btn-danger',
                            'confirm' => __('Are you sure you want to delete # {0}?', $discount->discount_id)
                        ]) ?>
                        <?= $this->Html->link('Back to List', ['action' => 'index'], ['class' => 'btn btn-sm btn-secondary']) ?>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered mb-4">
                        <tr>
                            <th scope="row">Discount Code</th>
                            <td><?= h($discount->discount_code) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Discount Amount</th>
                            <td>$<?= $this->Number->format($discount->discount_amount) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Start Date</th>
                            <td><?= h($discount->start_date) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">End Date</th>
                            <td><?= h($discount->end_date) ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Is Active</th>
                            <td>
                                <span class="badge <?= $discount->is_active ? 'bg-success' : 'bg-secondary' ?>">
                                    <?= $discount->is_active ? 'Yes' : 'No' ?>
                                </span>
                            </td>
                        </tr>
                    </table>

                    <div>
                        <h6>Description</h6>
                        <p class="text-muted"><?= $this->Text->autoParagraph(h($discount->discount_description)) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
