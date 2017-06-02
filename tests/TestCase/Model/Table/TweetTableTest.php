<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TweetTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TweetTable Test Case
 */
class TweetTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TweetTable
     */
    public $Tweet;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tweet',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Tweet') ? [] : ['className' => 'App\Model\Table\TweetTable'];
        $this->Tweet = TableRegistry::get('Tweet', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tweet);

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
