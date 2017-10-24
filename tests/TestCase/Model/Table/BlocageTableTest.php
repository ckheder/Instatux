<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BlocageTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BlocageTable Test Case
 */
class BlocageTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BlocageTable
     */
    public $Blocage;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.blocage'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Blocage') ? [] : ['className' => BlocageTable::class];
        $this->Blocage = TableRegistry::get('Blocage', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Blocage);

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
