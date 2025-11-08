<div class="products index content py-5">
    <h2 class="text-center mb-5">Our products</h2>

    <?php if (!empty($videos)): ?>
    <?php foreach ($videos as $video): ?>
        <?php if (!empty($video->embed)): ?>
            <?php
            preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video->embed, $matches);
            $videoID = isset($matches[1]) ? $matches[1] : '';
            if ($videoID): ?>
                <div style="display: flex; justify-content: center; width: 100%; margin: 0 auto; padding: 20px 0;">
                    <iframe src="https://www.youtube.com/embed/<?= $videoID ?>"
                            title="YouTube video player"
                            width="800" height="450"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            style="border: none; max-width: 100%; max-height: 100%; overflow: hidden;">
                    </iframe>
                </div>
            <?php else: ?>
                <p>Invalid YouTube URL</p>
            <?php endif; ?>
        <?php else: ?>
            <p>No video available.</p>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

    <!-- Display products -->
    <?php foreach ($products as $product): ?>
        <div class="container d-flex justify-content-center">
            <div class="card shadow-lg mb-4 <?= $product->is_enabled ? '' : 'disabled-product' ?>"
                 style="max-width: 800px; width: 100%; background-color: #FAF8F4; border-radius: 15px; transition: transform 0.3s ease, box-shadow 0.3s ease;">

                <?php
                $imagePath = '/' . h($product->img_url);
                $absolutePath = WWW_ROOT . $product->img_url;
                ?>

                <?php if (!empty($product->img_url) && file_exists($absolutePath)): ?>
                    <?php if ($product->is_enabled): ?>
                        <?= $this->Html->link(
                            $this->Html->image($imagePath, [
                                'alt' => h($product->product_name),
                                'class' => 'card-img-top img-fluid rounded-top',
                                'style' => 'height: 400px; object-fit: cover;'
                            ]),
                            ['controller' => 'Products', 'action' => 'view', $product->product_id],
                            ['escape' => false]
                        ) ?>
                    <?php else: ?>
                        <div class="card-img-top" style="height: 400px; object-fit: cover;">
                            <?= $this->Html->image($imagePath, [
                                'alt' => h($product->product_name),
                                'style' => 'filter: grayscale(100%); width: 100%; height: 100%; object-fit: cover; border-radius: 15px 15px 0 0;'
                            ]) ?>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 400px; border-radius: 15px 15px 0 0;">
                        <span class="text-muted fs-4">No Image Available</span>
                    </div>
                <?php endif; ?>

                <div class="card-body px-5 py-4 text-center" style="color: #4B3F39;">
                    <h3 class="card-title mb-3">
                        <?php if ($product->is_enabled): ?>
                            <?= $this->Html->link(
                                h($product->product_name),
                                ['controller' => 'Products', 'action' => 'view', $product->product_id],
                                ['class' => 'text-decoration-none text-dark']
                            ) ?>
                        <?php else: ?>
                            <span class="text-muted" style="cursor: not-allowed;">
                                <?= h($product->product_name) ?>
                            </span>
                        <?php endif; ?>
                    </h3>

                    <p class="card-text fs-5 mb-3"><strong>Price:</strong> $<?= $this->Number->format($product->price) ?></p>

                    <div class="my-3">
                        <?php if ($product->is_enabled): ?>
                            <?= $this->Form->create(null, [
                                'url' => ['controller' => 'Carts', 'action' => 'add', $product->product_id],
                                'class' => 'd-inline-block'
                            ]) ?>
                            <?= $this->Form->hidden('quantity', ['value' => 1]) ?>
                            <?= $this->Html->link('Add to Cart',
                                ['controller' => 'Carts', 'action' => 'add', $product->product_id],
                                ['class' => 'btn btn-lg btn-primary px-4 rounded-pill d-inline-block mt-2']
                            ) ?>
                            <?= $this->Form->end() ?>
                        <?php else: ?>
                            <span class="badge bg-secondary fs-6 px-3 py-2 rounded-pill">Currently Unavailable</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<style>
    .disabled-product {
        opacity: 0.6;
        pointer-events: none;
    }
    .disabled-product .card {
        background-color: #f8f9fa;
    }
    .disabled-product img {
        filter: grayscale(100%);
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-primary:hover {
        background-color: #4B3F39;
        border-color: #4B3F39;
    }

    .badge {
        font-size: 0.875rem;
    }
</style>
