<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AimeTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AimeTable Test Case
 */
class AimeTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AimeTable
     */
    public $Aime;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.aime'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Aime') ? [] : ['className' => AimeTable::class];
        $this->Aime = TableRegistry::get('Aime', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Aime);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
