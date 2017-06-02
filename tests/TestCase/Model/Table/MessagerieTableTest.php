<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MessagerieTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MessagerieTable Test Case
 */
class MessagerieTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MessagerieTable
     */
    public $Messagerie;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.messagerie',
        'app.users',
        'app.commentaires',
        'app.tweet',
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
        $config = TableRegistry::exists('Messagerie') ? [] : ['className' => 'App\Model\Table\MessagerieTable'];
        $this->Messagerie = TableRegistry::get('Messagerie', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Messagerie);

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
