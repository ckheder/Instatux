<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Aime Model
 *
 * @method \App\Model\Entity\Aime get($primaryKey, $options = [])
 * @method \App\Model\Entity\Aime newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Aime[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Aime|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Aime patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Aime[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Aime findOrCreate($search, callable $callback = null, $options = [])
 */
class AimeTable extends Table
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

        $this->setTable('aime');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

                $this->belongsTo('Tweet', [
            'foreignKey' => 'tweet_aime',
            'dependent' => true

        ]);

                 $this->belongsTo('Users', [
            'foreignKey' => 'username',
            'bindingKey' => 'username',
            'dependent' => true

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

            ->allowEmpty('username');

        $validator
            ->integer('tweet_aime')
            ->requirePresence('tweet_aime', 'create')
            ->notEmpty('tweet_aime');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        

        return $rules;
    }
}
