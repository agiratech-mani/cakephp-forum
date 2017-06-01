<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
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
        $this->set(compact('user'));
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
        $this->set(compact('user'));
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
        $this->set('title','Change Password');
        unset($user['password']);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
}
