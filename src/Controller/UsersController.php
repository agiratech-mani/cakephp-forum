<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['logout', 'register']);
    }
    public function register()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
    public function view()
    {
        $authUser = $this->Auth->user();
        $id = $authUser['id'];
        $user = $this->Users->get($id);

        $this->set('user', $user);
        
        $this->set('_serialize', ['user']);
    }

    public function edit()
    {
        $authUser = $this->Auth->user();
        $id = $authUser['id'];
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'edit']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set('title','Edit Profile');
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
    public function login()
    {
        $this->set('title','Login');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            
            if ($user) {
                if($user['active'] == 1)
                {
                    $this->Auth->setUser($user);
                    if($user['role'] == 'admin' || $user['role'] ==  'moderator')
                    {
                        return $this->redirect(['action' => 'index','prefix'=>'admin']);
                    }
                    else
                    {
                        return $this->redirect(['controller' => 'Users', 'action' => 'edit','prefix'=>false]);
                    }
                }
                else
                {
                    $this->Auth->logout();
                    $this->Flash->error('Your account is inactived please contact admin.');
                }
            }
            else
            {
                $this->Flash->error('Your username or password is incorrect.');
            }
        }
    }

    public function logout()
    {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }
    public function changePassword()
    {
        $user = $this->Users->get($this->Auth->user('id'));
        if (!empty($this->request->data))
        {
            $user = $this->Users->patchEntity($user, 
                [
                    'old_password' => $this->request->data['old_password'], 
                    'password' => $this->request->data['password'], 
                    'password' => $this->request->data['password'], 
                    'confirm_password' => $this->request->data['confirm_password']
                ], 
                [
                    'validate' => 'password'
                ]);
            if ($this->Users->save($user))
            {
                $this->Flash->success('The password is successfully changed');
                $this->redirect('/profile');
            }
            else
            {
                $this->Flash->error('There was an error during the save!');
            }
        }
        $this->set('title','Change Password');
        unset($user['password']);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
    
}
