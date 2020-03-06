<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Conversation Model
 *
 * @method \App\Model\Entity\Conversation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Conversation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Conversation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Conversation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Conversation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Conversation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Conversation findOrCreate($search, callable $callback = null, $options = [])
 */
class ConversationTable extends Table
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

        $this->table('conversation');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Messagerie');

        $this->belongsTo('Users', [
          'foreignKey' => 'user_conv',
          'bindingkey' => 'username'
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
            ->requirePresence('user_conv', 'create')
            ->notEmpty('user_conv');

                        // type_conv : multiple/duo

         $validator
            ->requirePresence('type_conv', 'create')
            ->notEmpty('type_conv');

        $validator
            ->requirePresence('statut', 'create')
            ->notEmpty('statut');

        return $validator;
    }
}
