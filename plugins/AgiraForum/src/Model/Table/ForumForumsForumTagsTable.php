<?php
namespace AgiraForum\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumForumsForumTags Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ForumForums
 * @property \Cake\ORM\Association\BelongsTo $ForumTags
 *
 * @method \AgiraForum\Model\Entity\ForumForumsForumTag get($primaryKey, $options = [])
 * @method \AgiraForum\Model\Entity\ForumForumsForumTag newEntity($data = null, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumForumsForumTag[] newEntities(array $data, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumForumsForumTag|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AgiraForum\Model\Entity\ForumForumsForumTag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumForumsForumTag[] patchEntities($entities, array $data, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumForumsForumTag findOrCreate($search, callable $callback = null, $options = [])
 */
class ForumForumsForumTagsTable extends Table
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

        $this->table('forum_forums_forum_tags');
        $this->primaryKey('id');
        $this->belongsTo('ForumForums', [
            'foreignKey' => 'forum_forum_id',
            'joinType' => 'INNER',
            'className' => 'AgiraForum.ForumForums'
        ]);
        $this->belongsTo('ForumTags', [
            'foreignKey' => 'forum_tag_id',
            'joinType' => 'INNER',
            'className' => 'AgiraForum.ForumTags'
        ]);
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
        $rules->add($rules->existsIn(['forum_tag_id'], 'ForumTags'));

        return $rules;
    }
}
