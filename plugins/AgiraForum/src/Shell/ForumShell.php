<?php
namespace AgiraForum\Shell;

use Cake\Console\Shell;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;
use Cake\Log\Log;
/**
 * Forum shell command.
 */
class ForumShell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        Log::debug('Got here');
        $this->out("Available Shells:");
        $this->out();
        $this->out("[AgiraForum] forum auto_close");
        $this->out();
        $this->out("To run this plugin command, type `cake AgiraForum.forum auto_close`");
        $this->out();

    }
    public function autoClose()
    {
        $this->out("Shell start : ".date('Y-m-d h:i:s'));
        $sitename = Configure::read('__site_name');
        $forum_closed_days = Configure::read('__forum_closed_days');
        $baseUrl = Configure::read('App.fullBaseUrl');
        $ForumForums = TableRegistry::get('ForumForums');
        $userObj = TableRegistry::get('Users');
        $forumForums = $ForumForums->find()
                    ->where(['ForumForums.status'=>1,'ForumForums.deleted != '=> 1,'DATE_ADD(ForumForums.created, INTERVAL '.$forum_closed_days.' DAY) < now()'])
                    ->all();
        $this->out("Forum Founded : ".$forumForums->count());
        if($forumForums->count() > 0)
        {
            foreach ($forumForums as $forum) {
                $this->out("Forum Titie: ".$forum->title);
                $forum->status = 3;
                if($ForumForums->save($forum))
                {
                    $user = $userObj->get($forum->user_id);
                    $mail = $user->email;
                    $name = $user->first_name." ".$user->last_name;
                    $this->out(__('Senting Mail to ').$name."<".$user->email.">");
                    $email = new Email();
                    $email->template('AgiraForum.forum_auto_closed');
                    $email->emailFormat('both');
                    $email->from('no-reply@naidim.org',"Agiratech Admin");
                    $email->to($mail, $name);
                    $email->subject('Your forum has been closed!!!');
                    $url = Router::Url(['controller' => 'posts', 'action' => 'view',$forum->slug,'plugin'=>'AgiraForum'],true);
                    $this->out($url);
                    $email->viewVars(['url'=>$url,'forum' => $forum,'user' => $user,'sitename'=>Configure::read('Forum.sitename')]);
                    if ($email->send()) {
                      $this->out(__('Mail successfully sent'));
                    } else {
                      $this->out(__('Error sending email: ') . $email->smtpError);
                    }
                }
                
            }
        }
        $this->out("Shell Ended");
    }
}
