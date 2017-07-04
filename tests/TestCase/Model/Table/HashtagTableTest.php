<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HashtagTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HashtagTable Test Case
 */
class HashtagTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HashtagTable
     */
    public $Hashtag;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.hashtag'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Hashtag') ? [] : ['className' => 'App\Model\Table\HashtagTable'];
        $this->Hashtag = TableRegistry::get('Hashtag', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Hashtag);

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
