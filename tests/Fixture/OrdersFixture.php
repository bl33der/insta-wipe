<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrdersFixture
 */
class OrdersFixture extends TestFixture
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
                'order_id' => 1,
                'user_id' => 1,
                'order_date' => '2025-03-17 01:13:07',
                'total_amount' => 1.5,
                'order_status' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
