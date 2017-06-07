<?php
namespace AgiraForum\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumTopics Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ForumCategories
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \AgiraForum\Model\Entity\ForumTopic get($primaryKey, $options = [])
 * @method \AgiraForum\Model\Entity\ForumTopic newEntity($data = null, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumTopic[] newEntities(array $data, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumTopic|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AgiraForum\Model\Entity\ForumTopic patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumTopic[] patchEntities($entities, array $data, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumTopic findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ForumTopicsTable extends Table
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

        $this->table('forum_topics');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Sluggable',[
            'field' => 'name',
            'slug' => 'slug',
            'replacement' => '-',
        ]);
        $this->belongsTo('ForumCategories', [
            'foreignKey' => 'forum_category_id',
            'joinType' => 'INNER',
            'className' => 'AgiraForum.ForumCategories'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Users'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

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
        $rules->add($rules->existsIn(['forum_category_id'], 'ForumCategories'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->isUnique(['name'],'Forum Topic already exists.'));
        return $rules;
    }
}
