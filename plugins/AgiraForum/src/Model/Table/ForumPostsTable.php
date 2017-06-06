<?php
namespace AgiraForum\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumPosts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ForumForums
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \AgiraForum\Model\Entity\ForumPost get($primaryKey, $options = [])
 * @method \AgiraForum\Model\Entity\ForumPost newEntity($data = null, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumPost[] newEntities(array $data, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumPost|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AgiraForum\Model\Entity\ForumPost patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumPost[] patchEntities($entities, array $data, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumPost findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ForumPostsTable extends Table
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

        $this->table('forum_posts');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'ForumForums' => ['forum_post_count']
        ]);

        $this->belongsTo('ForumForums', [
            'foreignKey' => 'forum_forum_id',
            'joinType' => 'INNER',
            'className' => 'AgiraForum.ForumForums'
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
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->existsIn(['forum_forum_id'], 'ForumForums'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
