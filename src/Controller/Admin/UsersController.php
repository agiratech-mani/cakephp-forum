<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{
    public function isAuthorized($user)
    {
        $action = $this->request->param('action');
        $controller = $this->request->param('controller');
        if(isset($this->request->prefix) && ($this->request->prefix == 'admin')){
            if($this->Auth->user()){
                if($this->Auth->user('role') == 'admin'){
                    return true;
                }
                else 
                if (in_array($action, ['edit','changePassword'])) 
                {
                    return true;
                }
                else
                {
                    return $this->redirect(['controller' => 'ForumForums', 'action' => 'index','prefix'=>'admin','plugin'=>'AgiraForum']);
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        return parent::isAuthorized($user);
    }
    public function index()
    {
        $users = $this->paginate($this->Users);
        $title = 'Users';
        $this->set(compact('users','title'));
        $this->set('_serialize', ['users']);
    }

    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $title = 'Create new User';
        $this->set(compact('user','title'));
        $this->set('_serialize', ['user']);
    }
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $title = "Edit User - ".$user->username;
        $this->set(compact('user','title'));
        $this->set('_serialize', ['user']);
    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
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
        $title = "Change Password";
        unset($user['password']);
        $this->set(compact('user','title'));
        $this->set('_serialize', ['user']);
    }
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $title = "Profile: ".$user->username;
        $this->set(compact('user','title'));

    }
}
