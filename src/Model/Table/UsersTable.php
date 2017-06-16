<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Commentaires', [
            'dependent' => true
    
        ]);

        $this->hasMany('Tweet', [
            'dependent' => true]);

         $this->hasMany('Abonnement', [
            'dependent' => true]);

         $this->hasMany('Messagerie');

         $this->hasMany('Partage');

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {

$validator = new Validator();

        $validator
            ->integer('id')
            ->allowEmpty('id', 'create')

      
            ->notEmpty('username', "le nom doit être renseigné")
            ->requirePresence('username')
            ->add(
        'username', 
        ['unique' => [
            'rule' => 'validateUnique', 
            'provider' => 'table', 
            'message' => 'Ce nom est déjà utilisé']
        ]
    )
        
            ->notEmpty('password', "le mot de passe doit être renseigné")
            ->requirePresence('password')

        
            ->notEmpty('description', "une description doit être renseigné")
            ->requirePresence('description')

        
            ->allowEmpty('avatarprofil')
            

        
            ->notEmpty('email', "une adresse mail doit être renseigné")
            ->requirePresence('email')
        ->add(
        'email', 
        ['unique' => [
            'rule' => 'validateUnique', 
            'provider' => 'table', 
            'message' => 'Cette adresse mail est déjà utilisée']
        ]
    );

        

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
        $rules->add($rules->isUnique(['username'],'Cette adresse email est déjà utilisée'));
        $rules->add($rules->isUnique(['email'],'Cette adresse email est déjà utilisée'));
       

        return $rules;
    }

}
