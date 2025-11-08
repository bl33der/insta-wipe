<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DiscountsFixture
 */
class DiscountsFixture extends TestFixture
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
                'discount_id' => 1,
                'dscount_code' => 'Lorem ipsum dolor sit amet',
                'discount_description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'discount_amount' => 1.5,
                'start_date' => '2025-05-12',
                'end_date' => '2025-05-12',
                'is_active' => 1,
            ],
        ];
        parent::init();
    }
}
