<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConversationTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConversationTable Test Case
 */
class ConversationTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConversationTable
     */
    public $Conversation;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.conversation'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Conversation') ? [] : ['className' => 'App\Model\Table\ConversationTable'];
        $this->Conversation = TableRegistry::get('Conversation', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Conversation);

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
