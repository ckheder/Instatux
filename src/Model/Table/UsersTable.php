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

        $this->hasMany('Tweet');

        $this->hasMany('Commentaires', [
            'dependent' => true

        ]);

        $this->hasMany('Aime', [
          'foreignKey' => 'username',
          'bindingKey' =>'username',
            'dependent' => true

        ]);

         $this->hasMany('Media', [
            'dependent' => true

        ]);

         $this->hasMany('Abonnement');

        $this->hasMany('Notifications', [
              'foreignKey' => 'username',
              'bindingKey' =>'username',
               'dependent' => true

               ]);

         $this->hasMany('Messagerie');

         $this->hasMany('Conversation', [
           'foreignKey' => 'user_conv'
                ]);

         $this->hasMany('Partage');

         $this->hasOne('Settings', [
           'bindingKey' =>'username',
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
            // traitement des noms réservés
            ->add(
                'username',[
        'notReserved'=>[
            'rule'=>'notReserved',
            'provider'=>'table',
            'message'=>'Ce nom ne peut pas être utlisé.'
         ]
        ])

                        ->add(
                'username',[
        'validFormat'=>[
            'rule'=> array('custom','/^[a-z\d_]{5,20}$/i'),
            'message'=>'Les noms doivent faire entre 5 et 20 caracères et les caractères spéciaux ne sont pas autorisés.'
         ]
        ])

            ->notEmpty('password', "le mot de passe doit être renseigné")
            ->requirePresence('password')

            ->allowEmpty('description')

            ->allowEmpty('lieu')

            ->allowEmpty('website')

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

        public function notReserved($value, array $context) // tableau recensant les noms réservés , utilisé dans le menuco/menuoffline
        {

            return !in_array($value, ['actualites','accueuil','search','settings','notifications','messagerie','abonnement','logout'], false);
}
}
