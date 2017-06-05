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
            //     'action' => 'index',
            //     'prefix' => false
            // ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
                'plugin'=>false
            ],
            'authorize' => 'Controller',
            'unauthorizedRedirect' => $this->referer() // If unauthorized, return them to page they were just on
        ]);
        if($this->Auth->user('role') == 'admin')
        {
            $this->Auth->loginRedirect = array('controller' => 'Users', 'action' => 'index','prefix'=>'admin');
        }
        else
        {
            $this->Auth->loginRedirect = array('controller' => 'Users', 'action' => 'edit','prefix'=>false);
        }
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
        
        Time::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any mutable DateTime
        FrozenTime::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any immutable DateTime
        Date::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any mutable Date
        FrozenDate::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');
        
    }
    public function isAuthorized($user)
    {
        $action = $this->request->param('action');


        if(isset($this->request->prefix) && ($this->request->prefix == 'admin')){
            if($this->Auth->user()){
                if($this->Auth->user('role') == 'admin'){
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
}
