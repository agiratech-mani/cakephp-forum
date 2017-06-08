<?php
namespace AgiraForum\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumPostLikes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $ForumPosts
 *
 * @method \AgiraForum\Model\Entity\ForumPostLike get($primaryKey, $options = [])
 * @method \AgiraForum\Model\Entity\ForumPostLike newEntity($data = null, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumPostLike[] newEntities(array $data, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumPostLike|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AgiraForum\Model\Entity\ForumPostLike patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumPostLike[] patchEntities($entities, array $data, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumPostLike findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ForumPostLikesTable extends Table
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

        $this->table('forum_post_likes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('CounterCache', [
            'ForumPosts' => ['like_count']
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Users'
        ]);
        $this->belongsTo('ForumPosts', [
            'foreignKey' => 'forum_post_id',
            'joinType' => 'INNER',
            'className' => 'AgiraForum.ForumPosts'
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
        $rules->add($rules->existsIn(['forum_post_id'], 'ForumPosts'));

        return $rules;
    }
}
