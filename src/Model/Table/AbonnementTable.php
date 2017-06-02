<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Abonnement Model
 *
 * @method \App\Model\Entity\Abonnement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Abonnement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Abonnement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Abonnement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Abonnement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Abonnement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Abonnement findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AbonnementTable extends Table
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

        $this->table('abonnement');
        $this->displayField('id');
        $this->primaryKey('id');


        $this->addBehavior('Timestamp');

       $this->belongsTo('Users', [
            'foreignKey' => 'suivi',
            
        ]);
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
            ->integer('user_id')
            ->requirePresence('user_id', 'create')
            ->notEmpty('user_id');

        $validator
            ->integer('suivi')
            ->requirePresence('suivi', 'create')
            ->notEmpty('suivi');

        return $validator;
    }




}
