<div class="container py-5">
    <h2 class="text-center mb-4 faq-heading">Frequently Asked Questions</h2>

    <?= $this->Form->create(null, ['type' => 'get', 'class' => 'mb-4']) ?>
    <?= $this->Form->control('q', [
        'label' => false,
        'placeholder' => 'Search FAQs...',
        'value' => $search,
        'class' => 'form-control search-input',
    ]) ?>
    <?= $this->Form->end() ?>

    <?php if (!empty($faqs) && count($faqs) > 0): ?>
        <div class="accordion" id="faqAccordion">
            <?php foreach ($faqs as $index => $faq): ?>
                <div class="accordion-item faq-item">
                    <h2 class="accordion-header" id="heading<?= $index ?>">
                        <button class="accordion-button collapsed faq-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="false" aria-controls="collapse<?= $index ?>">
                            <?= h($faq->question) ?>
                        </button>
                    </h2>
                    <div id="collapse<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $index ?>" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <?= nl2br(h($faq->answer)) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="faq-no-results">No FAQs found for your search: <strong><?= h($search) ?></strong></p>
    <?php endif; ?>

    <div class="text-center mt-4">
        <?= $this->Html->link('Contact Us', ['controller' => 'Enquiries', 'action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?= $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css') ?>
<?= $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js') ?>

<style>
    
    .faq-heading,
    .faq-button,
    .accordion-body,
    .faq-item,
    .faq-no-results {
        color: #4B3F39 !important;  
    }

    .search-input {
        background-color: #FAF8F4;
        color: #4B3F39;
        border: 1px solid #4B3F39;
    }

    .faq-item {
        background-color: #FAF8F4;
    }

    .faq-button {
        background-color: #FAF8F4;
    }

    .faq-button:not(.collapsed) {
        background-color: #FBD6B6;
    }
</style>
