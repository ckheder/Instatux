<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Conversation Entity
 *
 * @property int $id
 * @property int $participant1
 * @property int $participant2
 * @property bool $statut
 */
class Conversation extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
