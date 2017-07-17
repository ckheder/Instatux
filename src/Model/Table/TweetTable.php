<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tweet Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Tweet get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tweet newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Tweet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tweet|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tweet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tweet[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tweet findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TweetTable extends Table
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

        $this->table('tweet');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Abonnement', [
            'foreignKey' => 'user_timeline',
            'bindingKey' => 'suivi'
        ]);

        $this->belongsTo('Users', [
            'bindingKey' => 'username',
             
        ]);

          $this->hasMany('Commentaires');

          $this->hasOne('Partage', [
            'foreignKey' => 'tweet_partage',
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
            ->notEmpty('contenu_tweet')
            ->requirePresence('contenu_tweet');

        $validator
            ->allowEmpty('partage');

        $validator
            ->allowEmpty('nb_commentaire');

        $validator
            ->allowEmpty('nb_partage');
            
 
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));



        return $rules;
    }




}
