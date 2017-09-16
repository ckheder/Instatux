<?php
namespace App\Test\TestCase\Controller;

use App\Controller\SettingsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\SettingsController Test Case
 */
class SettingsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.settings',
        'app.users',
        'app.commentaires',
        'app.tweet',
        'app.abonnement',
        'app.partage',
        'app.messagerie',
        'app.conversation'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
