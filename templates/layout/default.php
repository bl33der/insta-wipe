<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'Insta Wipe';
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="<?= $this->Url->webroot('favicon_io/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $this->Url->webroot('favicon_io/favicon-16x16.png') ?>">
    <link rel="apple-touch-icon" href="<?= $this->Url->webroot('favicon_io/apple-touch-icon.png') ?>">
    <link rel="manifest" href="<?= $this->Url->webroot('favicon_io/site.webmanifest') ?>">
    <link rel="shortcut icon" href="<?= $this->Url->webroot('favicon_io/favicon.ico') ?>">

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $this->ContentBlock->text('website-title'); ?>: <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>
    <meta name="description" content="A small stain removal wipe that instantly cleans clothing stains on the go.">
    <meta name="keywords" content="Insta Wipe, InstaWipe, cleaning wipes, cleaning product, fast acting, pocket sized, stain clean, very effective, wide range of stains, best cleaning wipe, best cleaning product, convinence, cleanliness .">
    <meta name="author" content="Insta Wipe">
    <link rel="canonical" href="<?= $this->Url->build(null, ['fullBase' => true]) ?>">

    <meta property="og:title" content="Insta Wipe - Clean with Confidence">
    <meta property="og:description" content="Explore our range of eco-friendly cleaning products for every surface.">
    <meta property="og:image" content="<?= $this->Url->webroot('img/og-image.jpg') ?>">
    <meta property="og:url" content="<?= $this->Url->build(null, ['fullBase' => true]) ?>">
    <meta property="og:type" content="website">

    <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>

    <?= $this->Html->css('styles') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->Html->script('script') ?>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Nunito Sans', sans-serif;
        }
    </style>
</head>
<body style="background-color: #EBDDD2;">

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #FBD6B6;">
    <div class="container">
        <a class="navbar-brand" href="<?= $this->Url->build('/') ?>" style="color: #4B3F39;">Insta Wipe</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if ($this->Identity->isLoggedIn()) : ?>
                    <li class="nav-item">
                        <?= $this->Html->link('Logout', ['plugin' => false,'controller' => 'Auth', 'action' => 'logout'], ['class' => 'nav-link', 'style' => 'color: #4B3F39;']) ?> <!-- Warm Mocha for links -->
                    </li>
                    <li class="nav-item">
                    <?= $this->Html->link('Dashboard', ['plugin' => false,'controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link', 'style' => 'color: #4B3F39;']) ?>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <?= $this->Html->link('Products', ['plugin' => false,'controller' => 'Products', 'action' => 'index'], ['class' => 'nav-link', 'style' => 'color: #4B3F39;']) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('About Us', ['plugin' => false,'controller' => 'Pages', 'action' => 'display', 'about'], ['class' => 'nav-link', 'style' => 'color: #4B3F39;']) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('Contact Us', ['plugin' => false,'controller' => 'Enquiries', 'action' => 'add'], ['class' => 'nav-link', 'style' => 'color: #4B3F39;']) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link(
                        '<span class="position-relative d-inline-block">
                        <i class="bi bi-cart3 fs-5" style="color: #4B3F39;"></i>' .
                        (!empty($cartCount) ? '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem; padding: 0.3em 0.45em;">' . $cartCount . '</span>' : '') .
                        '</span>',
                        ['plugin' => false,'controller' => 'Carts', 'action' => 'index'],
                        ['class' => 'nav-link px-3', 'escape' => false, 'title' => 'View Cart', 'style' => 'color: #4B3F39;']
                    ) ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="main">
    <div class="container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
</main>

<footer class="footer" style="background-color: #4B3F39; color: #FAF8F4; padding: 2rem 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5 style="color: #FAF8F4;">Get Help</h5>
                <ul class="list-unstyled">
                    <li><?= $this->Html->link('FAQs', ['controller' => 'Faqs', 'action' => 'index'], ['class' => 'text-light text-decoration-none']) ?></li>
                    <li><?= $this->Html->link('Contact Us', ['plugin' => false, 'controller' => 'Enquiries', 'action' => 'add'], ['class' => 'text-light text-decoration-none']) ?></li>
                </ul>
            </div>
            <div class="col-md-4 mb-3">
                <h5 style="color: #FAF8F4;">About Us</h5>
                <ul class="list-unstyled">
                    <li><?= $this->Html->link('Our Story', ['plugin' => false, 'controller' => 'Pages', 'action' => 'display', 'about'], ['class' => 'text-light text-decoration-none']) ?></li>
                    <li><?= $this->Html->link('Products', ['plugin' => false, 'controller' => 'Products', 'action' => 'index'], ['class' => 'text-light text-decoration-none']) ?></li>
                    <li><?= $this->Html->link('Reviews', ['plugin' => false, 'controller' => 'Reviews', 'action' => 'add'], ['class' => 'text-light text-decoration-none']) ?></li>
                </ul>
            </div>
            <div class="col-md-4 mb-3">
                <h5 style="color: #FAF8F4;">Information</h5>
                <ul class="list-unstyled">
                    <li><?= $this->Html->link('Privacy Policy', ['plugin' => false, 'controller' => 'Pages', 'action' => 'display', 'privacy'], ['class' => 'text-light text-decoration-none']) ?></li>
                    <li><?= $this->Html->link('Terms & Conditions', ['plugin' => false, 'controller' => 'Pages', 'action' => 'display', 'terms'], ['class' => 'text-light text-decoration-none']) ?></li>
                </ul>
            </div>
        </div>
        <div class="text-center mt-4 small" style="color: #FAF8F4;">
            <?= $this->ContentBlock->text('copyright-message'); ?>
        </div>
    </div>
</footer>

<!-- Required Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
