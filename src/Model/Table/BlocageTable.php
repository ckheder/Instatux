<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Blocage Model
 *
 * @method \App\Model\Entity\Blocage get($primaryKey, $options = [])
 * @method \App\Model\Entity\Blocage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Blocage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Blocage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Blocage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Blocage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Blocage findOrCreate($search, callable $callback = null, $options = [])
 */
class BlocageTable extends Table
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

        $this->setTable('blocage');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

               $this->belongsTo('Users', [
            'foreignKey' => 'bloquer',
            'bindingKey' => 'username'
            
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
            ->scalar('bloqueur')
            ->requirePresence('bloqueur', 'create')
            ->notEmpty('bloqueur');

        $validator
            ->scalar('bloquer')
            ->requirePresence('bloquer', 'create')
            ->notEmpty('bloquer');

        return $validator;
    }
}
