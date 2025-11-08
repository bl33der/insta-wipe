<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VideosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VideosTable Test Case
 */
class VideosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VideosTable
     */
    protected $Videos;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Videos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Videos') ? [] : ['className' => VideosTable::class];
        $this->Videos = $this->getTableLocator()->get('Videos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Videos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\VideosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
