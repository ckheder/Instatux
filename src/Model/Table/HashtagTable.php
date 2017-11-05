<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Hashtag Model
 *
 * @method \App\Model\Entity\Hashtag get($primaryKey, $options = [])
 * @method \App\Model\Entity\Hashtag newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Hashtag[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Hashtag|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Hashtag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Hashtag[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Hashtag findOrCreate($search, callable $callback = null, $options = [])
 */
class HashtagTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('hashtag');
        $this->displayField('id');
        $this->primaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('tag', 'create')
            ->notEmpty('tag');

        $validator
            ->requirePresence('nb_tag', 'create')
            ->notEmpty('nb_tag');

        return $validator;
    }
}
