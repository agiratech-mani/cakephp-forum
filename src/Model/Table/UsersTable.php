<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Validation\Validator;


/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $Bookmarks
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
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

        $this->hasMany('ADmad/HybridAuth.SocialProfiles');

        \Cake\Event\EventManager::instance()->on('HybridAuth.newUser', [$this, 'createUser']);
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
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name', 'Please fill this field');
        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name', 'Please fill this field');
        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email', 'Please fill this field');
        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username', 'Please fill this field')
            ->add('username', [
                'length' => [
                'rule' => ['minLength',8],
                'message' => 'Username need to be at least 8 characters long',
                ]
            ]);

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password', 'Please fill this field')
            ->add('password', [
                'length' => [
                'rule' => ['minLength',8],
                'message' => 'Password need to be at least 8 characters long',
                ]
            ])
            ->add('password', [
                    'compare' => [
                        'rule' => ['compareWith', 'confirm_password'],
                        'message'=>"Password should match confirm password!"
                        ]
                    ]);
        $validator
            ->requirePresence('confirm_password', 'create')
            ->notEmpty('password', 'Please fill this field');

        return $validator;
    }
    public function validationPassword(Validator $validator) 
    {
        $validator->add('old_password', 'custom', ['rule' => function($value, $context) {
            $user = $this->get($context['data']['id']);
            if ($user) {
                if ((new DefaultPasswordHasher)->check($value, $user -> password)) {
                    return true;
                }
            }
            return false;
        }, 'message' => 'The old password does not match the current password!' ])->notEmpty('old_password');

       $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password', 'Please fill this field')
            ->add('password', [
                'length' => [
                'rule' => ['minLength',8],
                'message' => 'Password need to be at least 8 characters long',
                ]
            ]) ->add('password', [
                    'compare' => [
                        'rule' => ['compareWith', 'confirm_password'],
                        'message'=>"Password should match confirm password!"
                        ]
                    ]);
        $validator
            ->notEmpty('confirm_password', 'Please fill this field')
            ->add('confirm_password', [
                'length' => [
                'rule' => ['minLength',8],
                'message' => 'Password need to be at least 8 characters long',
                ]
            ])
           ;
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
        $rules->add($rules->isUnique(['email'],'Email already taken by someone.'));
        $rules->add($rules->isUnique(['username'],'User already exists.'));
        
        return $rules;
    }
    public function createUser(\Cake\Event\Event $event) {
        // Entity representing record in social_profiles table
        $profile = $event->data()['profile'];

        // Make sure here that all the required fields are actually present

        $user = $this->newEntity(['email' => $profile->email]);
        $user = $this->newEntity(['first_name' => $profile->first_name]);
        $user = $this->newEntity(['last_name' => $profile->last_name]);
        $user = $this->newEntity(['role' => 'user']);
        $user = $this->newEntity(['username' => $profile->email]);
        $user = $this->newEntity(['active' => 1]);
        $user = $this->save($user);

        if (!$user) {
            throw new \RuntimeException('Unable to save new user');
        }

        return $user;
    }
    
}
