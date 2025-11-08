<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

class ContentBlocksSeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'parent' => 'global',
                'label' => 'Website Title',
                'description' => 'Shown on the home page, as well as any tabs in the users browser.',
                'slug' => 'website-title',
                'type' => 'text',
                'value' => 'ugie-cake/cakephp-content-blocks-example-app',
            ],
            [
                'parent' => 'home',
                'label' => 'Home page Title',
                'description' => 'The title of home page.',
                'slug' => 'home-title',
                'type' => 'html',
                'value' => 'Insta Wipe',
            ],
            [
                'parent' => 'home',
                'label' => 'Home Page Content',
                'description' => 'The main content shown in the centre of the home page.',
                'slug' => 'home-content',
                'type' => 'html',
                'value' => 'Cleaning Wipes',
            ],
            [
                'parent' => 'home',
                'label' => 'Banner Image',
                'description' => 'Shown in the centre of the home page',
                'slug' => 'home-banner',
                'type' => 'image',
            ],
            [
                'parent' => 'home',
                'label' => 'Products Image',
                'description' => 'Image shown for products section on home page',
                'slug' => 'product-image',
                'type' => 'image',
            ],
            [
                'parent' => 'home',
                'label' => 'About Us Image',
                'description' => 'Image shown for about us section on home page',
                'slug' => 'about-image',
                'type' => 'image',
            ],
            [
                'parent' => 'home',
                'label' => 'Contact Us Image',
                'description' => 'Image shown for contact us section on home page',
                'slug' => 'contact-image',
                'type' => 'image',
            ],
            [
                'parent' => 'global',
                'label' => 'Copyright Message',
                'description' => 'Copyright information shown at the bottom of the home page.',
                'slug' => 'copyright-message',
                'type' => 'text',
                'value' => '(c) Copyright 2023, Insta Wipe',
            ],
            [
                'parent' => 'About Us',
                'label' => 'About Us Message',
                'description' => 'Business description',
                'slug' => 'about-message',
                'type' => 'html',
                'value' => 'About Insta Wipe',
            ],
            [
                'parent' => 'About Us',
                'label' => 'Business Image',
                'description' => 'Business image in about us section',
                'slug' => 'business-image',
                'type' => 'image',
            ],
        ];

        $table = $this->table('content_blocks');
        $table->insert($data)->save();
    }
}