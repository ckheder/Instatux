<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AbonnementTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AbonnementTable Test Case
 */
class AbonnementTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AbonnementTable
     */
    public $Abonnement;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.abonnement'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Abonnement') ? [] : ['className' => 'App\Model\Table\AbonnementTable'];
        $this->Abonnement = TableRegistry::get('Abonnement', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Abonnement);

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
