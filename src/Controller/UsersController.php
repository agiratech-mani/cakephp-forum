<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;
use Cake\Mailer\Email;
use Cake\Core\Configure;
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
        $this->Auth->allow(['logout', 'register','password','reset','confirm']);
    }
    public function register()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $confirmation_key = uniqid();
            $this->request->data['confirmation_key'] = $confirmation_key;
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $url = Router::Url(['controller' => 'users', 'action' => 'confirm'], true) . '/' . $confirmation_key;
                $this->sendActivationEmail($url, $user);
                $this->sendNewUserEmail($user);
                $this->Flash->success(__('You have registered successfully. Please check your mail for activation mail.'));
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
                if($user['active'] == 1 && $user['confirmed'] == 1)
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
                    if($user['confirmed'] == 0)
                    {
                        $this->Flash->error('Your email is not verified. Please verify the email.');
                    }
                    else
                    {
                        $this->Flash->error('Your account is inactived please contact admin.');
                    }
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
    public function password()
    {
        if ($this->request->is('post')) {
            $query = $this->Users->findByEmail($this->request->data['email']);
            $user = $query->first();
            if (is_null($user)) {
                $this->Flash->error('Email address does not exist. Please try again');
            } else {
                $passkey = uniqid();
                $url = Router::Url(['controller' => 'users', 'action' => 'reset'], true) . '/' . $passkey;
                $timeout = time() + DAY;
                 if ($this->Users->updateAll(['passkey' => $passkey, 'timeout' => $timeout], ['id' => $user->id])){
                    $this->sendResetEmail($url, $user);
                    $this->redirect(['action' => 'login']);
                } else {
                    $this->Flash->error('Error saving reset passkey/timeout');
                }
            }
        }
    }
    public function reset($passkey = null) {
        if ($passkey) {
            $query = $this->Users->find('all', ['conditions' => ['passkey' => $passkey, 'timeout >' => time()]]);
            $user = $query->first();
            if ($user) {
                if (!empty($this->request->data)) {
                    // Clear passkey and timeout
                    $this->request->data['passkey'] = null;
                    $this->request->data['timeout'] = null;
                    $user = $this->Users->patchEntity($user, $this->request->data);
                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('Your password has been updated.'));
                        return $this->redirect(array('action' => 'login'));
                    } else {
                        $this->Flash->error(__('The password could not be updated. Please, try again.'));
                    }
                }
            } else {
                $this->Flash->error('Invalid or expired passkey. Please check your email or try again');
                $this->redirect(['action' => 'password']);
            }
            unset($user->password);
            $this->set(compact('user'));
        } else {
            $this->redirect('/');
        }
    }
    public function confirm($key = null) {
        if ($key) {
            $query = $this->Users->find('all', ['conditions' => ['confirmation_key' => $key]]);
            $user = $query->first();
            if ($user) {
                $user->confirmation_key = null;
                $user->active = 1;
                $user->confirmed = 1;
                if($this->Users->save($user))
                {
                    $this->Auth->setUser($user);
                    $this->Flash->success(__('Your account activated successfully.'));
                    return $this->redirect(array('action' => 'edit'));
                }
                else {
                    $this->Flash->error('Invalid url. Please check your email or try again');
                    $this->redirect(['action' => 'login']);
                }
            }
            else {
                $this->Flash->error('Invalid url. Please check your email or try again');
                $this->redirect(['action' => 'login']);
            }
        }
        else {
            $this->redirect('/');
        }
    }
}
