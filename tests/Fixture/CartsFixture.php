<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CartsFixture
 */
class CartsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'product_id' => 1,
                'quantity' => 1,
                'created' => '2025-03-22 13:46:45',
                'modified' => '2025-03-22 13:46:45',
            ],
        ];
        parent::init();
    }
}
