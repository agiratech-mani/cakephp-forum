<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\I18n\FrozenTime;
use Cake\I18n\FrozenDate;
use Cake\Routing\Router;
use Cake\Mailer\Email;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ]
                ],
                'ADmad/HybridAuth.HybridAuth' => [
                    // All keys shown below are defaults
                    'fields' => [
                        'provider' => 'provider',
                        'openid_identifier' => 'openid_identifier',
                        'email' => 'email'
                    ],

                    'profileModel' => 'ADmad/HybridAuth.SocialProfiles',
                    'profileModelFkField' => 'user_id',

                    'userModel' => 'Users',

                    // The URL Hybridauth lib should redirect to after authentication.
                    // If no value is specified you are redirect to this plugin's
                    // HybridAuthController::authenticated() which handles persisting
                    // user info to AuthComponent and redirection.
                    'hauth_return_to' => null
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login',
                'prefix' => false,
                'plugin'=>false
            ],
            // 'loginRedirect' => [
            //     'controller' => 'Users',
            //     'action' => 'index'
            // ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
                'plugin'=>false
            ],
            'authorize' => 'Controller',
            'unauthorizedRedirect' => $this->referer() // If unauthorized, return them to page they were just on
        ]);
        // if($this->Auth->user('role') == 'admin' || $this->Auth->user('role') == 'moderator')
        // {
        //     $this->Auth->loginRedirect = array('controller' => 'Users', 'action' => 'index','prefix'=>'admin');
        // }
        // else
        // {
        //     $this->Auth->loginRedirect = array('controller' => 'Users', 'action' => 'edit','prefix'=>false);
        // }
        // Allow the display action so our pages controller
        // continues to work.
        $this->Auth->allow(['display']);
        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
        $authUser = $this->Auth->user();
        $this->set("authUser", $authUser);
        $this->set("backLink", $this->referer());
        
        Time::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any mutable DateTime
        FrozenTime::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any immutable DateTime
        Date::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any mutable Date
        FrozenDate::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');
        
    }
    public function beforeFilter(Event $event)
    {   
        parent::beforeFilter($event);
        $this->fetchSettings();
    }
    public function isAuthorized($user)
    {
        $action = $this->request->param('action');
        $controller = $this->request->param('controller');

        if(isset($this->request->prefix) && ($this->request->prefix == 'admin')){
            if($this->Auth->user()){
                if($this->Auth->user('role') == 'admin' || $this->Auth->user('role') == 'moderator'){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        if (in_array($action, ['index', 'add', 'edit','view'])) {
            return true;
        }
        
        return true;
    }
    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    protected function sendNewUserEmail($user) {
        $adminmail = Configure::read('App.admin_email');
        $email = new Email();
        $email->template('newuser');
        $email->emailFormat('both');
        $email->from(Configure::read('__from_email'),Configure::read('__from_name'));
        $email->to($adminmail, 'Admin');
        $email->subject('New user registered');
        $email->viewVars(['user' => $user,'sitename'=>Configure::read('__site_name')]);
        if ($email->send()) {
            //$this->Flash->success(__('Check your email for your accoactivation link'));
        } else {
            $this->Flash->error(__('Error sending email: ') . $email->smtpError);
        }
    }
    protected function sendUserCreatedEmail($user,$password,$url) {
        $mail = $user->email;
        $name = $user->first_name." ".$user->last_name;
        $email = new Email();
        $email->template('user_created');
        $email->emailFormat('both');
        $email->from(Configure::read('__from_email'),Configure::read('__from_name'));
        $email->to($mail, $name);
        $email->subject('Welcome to '.Configure::read('__site_name'));
        $email->viewVars(['url'=>$url,'user' => $user,'password'=>$password,'sitename'=>Configure::read('__site_name')]);
        if ($email->send()) {
            //$this->Flash->success(__('Check your email for your accoactivation link'));
        } else {
            $this->Flash->error(__('Error sending email: ') . $email->smtpError);
        }
    }

    protected function sendActivationEmail($url, $user) {
        $email = new Email();
        $email->template('activation_mail');
        $email->emailFormat('both');
        $email->from(Configure::read('__from_email'),Configure::read('__from_name'));
        $email->to($user->email, $user->first_name);
        $email->subject('Please confirm your email for account activation');
        $email->viewVars(['url' => $url, 'user' => $user,'sitename'=>Configure::read('__site_name')]);
        if ($email->send()) {
            //$this->Flash->success(__('Check your email for your accoactivation link'));
        } else {
            $this->Flash->error(__('Error sending email: ') . $email->smtpError);
        }
    }
    protected function sendResetEmail($url, $user) {
        $email = new Email();
        $email->template('resetpw');
        $email->emailFormat('both');
        $email->from(Configure::read('__from_email'),Configure::read('__from_name'));
        $email->to($user->email, $user->first_name);
        $email->subject('Reset your password');
        $email->viewVars(['url' => $url, 'user' => $user,'sitename'=>Configure::read('__site_name')]);
        if ($email->send()) {
            $this->Flash->success(__('Check your email for your reset password link'));
        } else {
            $this->Flash->error(__('Error sending email: ') . $email->smtpError);
        }
    }
    public function fetchSettings()
    {
        $Settings = TableRegistry::get('Settings');
        $settings = $Settings->find()->all();
        
        foreach ($settings as $setting) {
            Configure::write("__".$setting->key, $setting->pair);
        }
    }

}
