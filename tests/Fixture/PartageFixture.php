<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PartageFixture
 *
 */
class PartageFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'partage';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id_partage' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'partageur' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'tweet_partage' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'partageur' => ['type' => 'index', 'columns' => ['partageur'], 'length' => []],
            'tweet_partage' => ['type' => 'index', 'columns' => ['tweet_partage'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id_partage'], 'length' => []],
            'partage_ibfk_1' => ['type' => 'foreign', 'columns' => ['partageur'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'partage_ibfk_2' => ['type' => 'foreign', 'columns' => ['tweet_partage'], 'references' => ['tweet', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id_partage' => 1,
            'partageur' => 1,
            'tweet_partage' => 1
        ],
    ];
}
