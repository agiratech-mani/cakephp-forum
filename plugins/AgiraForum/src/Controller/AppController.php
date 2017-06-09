<?php

namespace AgiraForum\Controller;

use App\Controller\AppController as BaseController;
use Cake\Core\Configure;
use Cake\Routing\Router;
use Cake\Mailer\Email;
class AppController extends BaseController
{
		protected function sendAdminNewForumNotify($forumForum)
		{
			$adminmail = Configure::read('Forum.adminmail');
			$email = new Email();
      $email->template('AgiraForum.admin_forum_add');
      $email->emailFormat('both');
      $email->from('no-reply@naidim.org',"Agiratech Admin");
      $email->to($adminmail, "Admin");
      $email->subject('New forum added');
      $url = Router::Url(['controller' => 'posts', 'action' => 'view',$forumForum->slug], true);
      $email->viewVars(['url'=>$url,'forum' => $forumForum,'sitename'=>Configure::read('__site_name')]);
      if ($email->send()) {
          //$this->Flash->success(__('Check your email for your accoactivation link'));
      } else {
          $this->Flash->error(__('Error sending email: ') . $email->smtpError);
      }
		}
		protected function sendNewPostNotify($post)
		{
			$mail = $post->forum_forum->user->email;
			$name = $post->forum_forum->user->first_name." ".$post->forum_forum->user->last_name;
			$email = new Email();
      $email->template('AgiraForum.new_post');
      $email->emailFormat('both');
      $email->from('no-reply@naidim.org',"Agiratech Admin");
      $email->to($mail, $name);
      $email->subject('New comment posted');
      $url = Router::Url(['controller' => 'posts', 'action' => 'view',$post->forum_forum->slug], true).'#Comment-'.$post->id;
      $email->viewVars(['url'=>$url,'post' => $post,'sitename'=>Configure::read('__site_name')]);
      if ($email->send()) {
          //$this->Flash->success(__('Check your email for your accoactivation link'));
      } else {
          $this->Flash->error(__('Error sending email: ') . $email->smtpError);
      }
		}
		protected function sendForumClosedNotify($forum)
		{
			$mail = $forum->user->email;
			$name = $forum->user->first_name." ".$forum->user->last_name;
			$email = new Email();
      $email->template('AgiraForum.forum_closed');
      $email->emailFormat('both');
      $email->from('no-reply@naidim.org',"Agiratech Admin");
      $email->to($mail, $name);
      $email->subject('Your forum has been closed by '.$this->Auth->user('role'));
      $url = Router::Url(['controller' => 'posts', 'action' => 'view',$forum->slug], true);
      $email->viewVars(['url'=>$url,'forum' => $forum,'user' => $this->Auth->user(),'sitename'=>Configure::read('__site_name')]);
      if ($email->send()) {
          //$this->Flash->success(__('Check your email for your accoactivation link'));
      } else {
          $this->Flash->error(__('Error sending email: ') . $email->smtpError);
      }
		}
		protected function sendForumDeletedNotify($forum)
		{
			$mail = $forum->user->email;
			$name = $forum->user->first_name." ".$forum->user->last_name;
			$email = new Email();
      $email->template('AgiraForum.forum_deleted');
      $email->emailFormat('both');
      $email->from(Configure::read('__from_email'),Configure::read('__from_name'));
      $email->to($mail, $name);
      $email->subject('Your forum has been deleted by '.$this->Auth->user('role'));
      $url = Router::Url(['controller' => 'posts', 'action' => 'view',$forum->slug], true);
      $email->viewVars(['url'=>$url,'forum' => $forum,'user' => $this->Auth->user(),'sitename'=>Configure::read('__site_name')]);
      if ($email->send()) {
          //$this->Flash->success(__('Check your email for your accoactivation link'));
      } else {
          $this->Flash->error(__('Error sending email: ') . $email->smtpError);
      }
		}
}