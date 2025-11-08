<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'user_id' => 1,
                'username' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'nonce' => 'Lorem ipsum dolor sit amet',
                'nonce_expiry' => '2025-03-26 03:58:11',
                'created' => '2025-03-26 03:58:11',
                'modified' => '2025-03-26 03:58:11',
            ],
        ];
        parent::init();
    }
}
