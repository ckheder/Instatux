<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Media Model
 *
 * @method \App\Model\Entity\Media get($primaryKey, $options = [])
 * @method \App\Model\Entity\Media newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Media[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Media|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Media patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Media[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Media findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MediaTable extends Table
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

        $this->setTable('media');
        $this->setDisplayField('id_media');
        $this->setPrimaryKey('id_media');

                $this->belongsTo('Users', [
            'foreignKey' => 'owner',
             
        ]);

        $this->belongsTo('Tweet', [
            'foreignKey' => 'tweet_media',
             
        ]);

        $this->addBehavior('Timestamp');
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
            ->integer('id_media')
            ->allowEmpty('id_media', 'create');

        $validator
            ->scalar('nom_media')
            ->requirePresence('nom_media', 'create')
            ->notEmpty('nom_media');

        $validator
            ->integer('tweet_media')
            ->requirePresence('tweet_media', 'create')
            ->notEmpty('tweet_media');

        $validator
            ->scalar('user_id')
            ->maxLength('user_id', 50)
            ->requirePresence('user_id', 'create')
            ->notEmpty('user_id');

        return $validator;
    }
}
