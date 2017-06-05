<?php
namespace AgiraForum\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
/**
 * ForumForums Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ForumTopics
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $ForumPosts
 *
 * @method \AgiraForum\Model\Entity\ForumForum get($primaryKey, $options = [])
 * @method \AgiraForum\Model\Entity\ForumForum newEntity($data = null, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumForum[] newEntities(array $data, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumForum|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AgiraForum\Model\Entity\ForumForum patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumForum[] patchEntities($entities, array $data, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumForum findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ForumForumsTable extends Table
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

        $this->table('forum_forums');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Sluggable');
        $this->belongsTo('ForumTopics', [
            'foreignKey' => 'forum_topic_id',
            'joinType' => 'INNER',
            'className' => 'AgiraForum.ForumTopics'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Users'
        ]);
        $this->hasMany('ForumPosts', [
            'foreignKey' => 'forum_forum_id',
            'className' => 'AgiraForum.ForumPosts',
            'sort' => ['id'>'asc']
        ]);
        $this->belongsToMany('ForumTags', [
            'foreignKey' => 'forum_forum_id',
            'targetForeignKey' => 'forum_tag_id',
            'joinTable' => 'forum_forums_forum_tags'
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        // $validator
        //     ->requirePresence('content', 'create')
        //     ->notEmpty('content');

        // $validator
        //     ->integer('status')
        //     ->requirePresence('status', 'create')
        //     ->notEmpty('status');

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
        $rules->add($rules->existsIn(['forum_topic_id'], 'ForumTopics'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
