<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PartageTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PartageTable Test Case
 */
class PartageTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PartageTable
     */
    public $Partage;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.partage'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Partage') ? [] : ['className' => 'App\Model\Table\PartageTable'];
        $this->Partage = TableRegistry::get('Partage', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Partage);

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
}
