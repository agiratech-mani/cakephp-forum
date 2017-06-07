<?php
namespace AgiraForum\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ForumCategories Model
 *
 * @property \Cake\ORM\Association\HasMany $ForumTopics
 *
 * @method \AgiraForum\Model\Entity\ForumCategory get($primaryKey, $options = [])
 * @method \AgiraForum\Model\Entity\ForumCategory newEntity($data = null, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumCategory[] newEntities(array $data, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \AgiraForum\Model\Entity\ForumCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \AgiraForum\Model\Entity\ForumCategory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ForumCategoriesTable extends Table
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

        $this->table('forum_categories');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ForumTopics', [
            'foreignKey' => 'forum_category_id',
            'className' => 'AgiraForum.ForumTopics'
        ]);
        $this->addBehavior('Sluggable',[
            'field' => 'name',
            'slug' => 'slug',
            'replacement' => '-',
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
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['name'],'Forum Category already exists.'));
        return $rules;
    }
}
