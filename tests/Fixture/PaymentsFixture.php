<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PaymentsFixture
 */
class PaymentsFixture extends TestFixture
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
                'order_date' => '2025-03-24 04:56:40',
                'order_status' => 'Lorem ipsum dolor sit amet',
                'total_amount' => 1.5,
                'payment_id' => 1,
                'payment_method' => 'Lorem ipsum dolor sit amet',
                'payment_date' => '2025-03-24 04:56:40',
            ],
        ];
        parent::init();
    }
}
