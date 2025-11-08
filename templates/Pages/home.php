<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\ORM\ResultSetInterface $approvedReviews
 */
?>

<!-- Full-width Banner Section -->
<div class="text-center mt-5 px-0">
    <!-- Image Slider -->
    <div id="homepageCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active position-relative">
                <!-- Full-width image without container padding -->
                <?= $this->ContentBlock->image('home-banner', [
                    'class' => 'd-block w-100',
                    'style' => 'max-height:500px; object-fit: cover;',
                    'alt' => 'Insta Wipe home banner',
                    'title' => 'Insta wipe home banner'
                ]); ?>
                <div class="carousel-caption position-absolute top-50 start-50 translate-middle text-center">
                    <h1 class="display-4 fw-bold"><?= $this->ContentBlock->html('home-title'); ?></h1>
                    <p class="lead fw-bold"><?= $this->ContentBlock->html('home-content'); ?></p>
<?= $this->Html->link('SHOP NOW', ['controller' => 'Products', 'action' => 'index'], ['class' => 'btn btn-lg fw-bold', 'style' => 'color: #4B3F39; background-color: #FAF8F4; padding: 0.5rem 1rem; border-radius: 0.375rem;']) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 3 Buttons Section with Square Background Images -->
<div class="row mt-5 text-center">
    <div class="col-md-4 mb-3 position-relative">
        <a href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index']) ?>" class="d-block position-relative">
            <div class="ratio ratio-1x1">
                <?= $this->ContentBlock->image('product-image', ['class' => 'd-block w-100 mx-auto', 'style' => 'max-height:500px; object-fit: cover;', 'alt' => 'Insta Wipe products', 'title' => 'Insta wipe products']); ?>
            </div>
            <span class="position-absolute top-50 start-50 translate-middle fs-2 fw-bold" style="color: #4B3F39; background-color: #FAF8F4; padding: 0.5rem 1rem; border-radius: 0.375rem;">Products</span>
            </a>
    </div>

    <div class="col-md-4 mb-3 position-relative">
        <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'display', 'about']) ?>" class="d-block position-relative">
            <div class="ratio ratio-1x1">
                <?= $this->ContentBlock->image('about-image', ['class' => 'd-block w-100 mx-auto', 'style' => 'max-height:500px; object-fit: cover;', 'alt' => 'Insta Wipe about Us', 'title' => 'Insta wipe about us']); ?>
            </div>
            <span class="position-absolute top-50 start-50 translate-middle fs-2 fw-bold" style="color: #4B3F39; background-color: #FAF8F4; padding: 0.5rem 1rem; border-radius: 0.375rem;">About Us</span>
        </a>
    </div>

    <div class="col-md-4 mb-3 position-relative">
        <a href="<?= $this->Url->build(['controller' => 'Enquiries', 'action' => 'add']) ?>" class="d-block position-relative">
            <div class="ratio ratio-1x1">
                <?= $this->ContentBlock->image('contact-image', ['class' => 'd-block w-100 mx-auto', 'style' => 'max-height:500px; object-fit: cover;', 'alt' => 'Insta Wipe contact us', 'title' => 'Insta wipe contact us']); ?>
            </div>
            <span class="position-absolute top-50 start-50 translate-middle fs-2 fw-bold" style="color: #4B3F39; background-color: #FAF8F4; padding: 0.5rem 1rem; border-radius: 0.375rem;">Contact Us</span>
        </a>
    </div>
</div>

<!-- Approved Reviews Section -->
<section class="py-5 text-center" style="background-color: #D7A6A1;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-white mb-0">What Our Clients Say</h2>
<!--            <select id="reviewSort" class="form-select w-auto">-->
<!--                <option value="date_desc">Sort by Date (Newest)</option>-->
<!--                <option value="date_asc">Sort by Date (Oldest)</option>-->
<!--                <option value="rating_desc">Sort by Rating (Highest)</option>-->
<!--                <option value="rating_asc">Sort by Rating (Lowest)</option>-->
<!--            </select>-->
        </div>

        <div id="reviewCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($approvedReviews as $index => $review): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="d-flex justify-content-center">
                            <div class="col-md-6 d-flex align-items-stretch">
                                <div class="card shadow-sm text-start w-100 d-flex flex-column justify-content-between"
                                     style="background-color: #EBDDD2; aspect-ratio: 1 / 1; min-height: 260px; max-height: 280px; border: none;">
                                    <?php if (!empty($review->img_url) && file_exists(WWW_ROOT . $review->img_url)): ?>
                                        <?= $this->Html->image('/' . $review->img_url, [
                                            'alt' => 'Product image',
                                            'class' => 'img-fluid rounded shadow-sm mt-4',
                                            'style' => 'max-height: 160px; object-fit: cover;'
                                        ]) ?>
                                    <?php endif; ?>

                                    <div class="p-3">
                                        <p class="text-dark mb-2" style="font-size: 0.9rem;">
                                            <span class="fw-bold">“</span>
                                            <?= h($review->comment) ?>
                                            <span class="fw-bold">”</span>
                                        </p>

                                        <div class="mb-1" style="font-size: 1.2rem;">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <span class="<?= $i <= $review->rating ? 'text-warning' : 'text-secondary' ?>">&#9733;</span>
                                            <?php endfor; ?>
                                        </div>

                                        <div>
                                            <span class="fw-bold text-dark">– <?= h($review->reviewer_name) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#reviewCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#reviewCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

<!-- Sorting Script -->
<!--<script>-->
<!--    document.getElementById('reviewSort').addEventListener('change', function () {-->
<!--        const sortBy = this.value;-->
<!--        const container = document.getElementById('reviewsContainer');-->
<!---->
<!--        // Get flat list of all review cards-->
<!--        const allCards = Array.from(container.querySelectorAll('.review-card'));-->
<!---->
<!--        // Sort logic-->
<!--        const sortedCards = allCards.sort((a, b) => {-->
<!--            const dateA = new Date(a.dataset.date);-->
<!--            const dateB = new Date(b.dataset.date);-->
<!--            const ratingA = parseInt(a.dataset.rating);-->
<!--            const ratingB = parseInt(b.dataset.rating);-->
<!---->
<!--            switch (sortBy) {-->
<!--                case 'date_asc':-->
<!--                    return dateA - dateB;-->
<!--                case 'date_desc':-->
<!--                    return dateB - dateA;-->
<!--                case 'rating_asc':-->
<!--                    return ratingA - ratingB;-->
<!--                case 'rating_desc':-->
<!--                    return ratingB - ratingA;-->
<!--                default:-->
<!--                    return 0;-->
<!--            }-->
<!--        });-->
<!---->
<!--        // Clear existing content-->
<!--        container.innerHTML = '';-->
<!---->
<!--        // Chunk sorted cards into groups of 2-->
<!--        const chunkSize = 2;-->
<!--        for (let i = 0; i < sortedCards.length; i += chunkSize) {-->
<!--            const chunk = sortedCards.slice(i, i + chunkSize);-->
<!--            const isActive = i === 0 ? 'active' : '';-->
<!---->
<!--            const row = document.createElement('div');-->
<!--            row.className = `carousel-item ${isActive}`;-->
<!---->
<!--            const rowInner = document.createElement('div');-->
<!--            rowInner.className = 'row justify-content-center';-->
<!---->
<!--            chunk.forEach(card => {-->
<!--                const col = document.createElement('div');-->
<!--                col.className = 'col-md-6 mb-4 d-flex align-items-stretch';-->
<!--                col.appendChild(card);-->
<!--                rowInner.appendChild(col);-->
<!--            });-->
<!---->
<!--            row.appendChild(rowInner);-->
<!--            container.appendChild(row);-->
<!--        }-->
<!--    });-->
<!--</script>-->

<style>
    @media (max-width: 768px) {
        #homepageCarousel .carousel-item img {
            width: 100vw;
            height: auto;
        }
    }
</style>
