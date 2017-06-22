<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;

/**
 * Commentaires Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Tweets
 *
 * @method \App\Model\Entity\Commentaire get($primaryKey, $options = [])
 * @method \App\Model\Entity\Commentaire newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Commentaire[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Commentaire|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Commentaire patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Commentaire[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Commentaire findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CommentairesTable extends Table
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

        $this->table('commentaires');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Tweet', [
            'foreigKey' => 'tweet_id',

        ]);

               $this->addBehavior('CounterCache', [
            'Tweet' => ['nb_commentaire']
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
            ->requirePresence('comm', 'create')
            ->notEmpty('comm');

        $validator
            ->requirePresence('user_id')
            ->notEmpty('user_id');

        $validator
            ->requirePresence('tweet_id')
            ->notEmpty('tweet_id');

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
        $rules->add($rules->existsIn(['tweet_id'], 'Tweet'));

        return $rules;
    }

}
