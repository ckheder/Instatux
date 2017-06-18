<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Partage Model
 *
 * @method \App\Model\Entity\Partage get($primaryKey, $options = [])
 * @method \App\Model\Entity\Partage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Partage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Partage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Partage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Partage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Partage findOrCreate($search, callable $callback = null, $options = [])
 */
class PartageTable extends Table
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

        $this->table('partage');
        $this->displayField('id_partage');
        $this->primaryKey('id_partage');

        $this->belongsTo('Abonnement', [
            'foreignKey' => 'user_id',
            'bindingKey' => 'suivi'
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
             
        ]);

        $this->belongsTo('Tweet', [
            'foreignKey' => 'tweet_partage',
             
        ]);

        $this->addBehavior('CounterCache', [
            'Tweet' => ['nb_partage']
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
            ->integer('id_partage')
            ->allowEmpty('id_partage', 'create');

        $validator
            ->integer('user_id')
            ->requirePresence('user_id', 'create')
            ->notEmpty('user_id');

        $validator
            ->integer('tweet_partage')
            ->requirePresence('tweet_partage', 'create')
            ->notEmpty('tweet_partage');

        return $validator;
    }
}
