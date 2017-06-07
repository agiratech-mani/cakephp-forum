<?php
namespace AgiraForum\Controller;

use AgiraForum\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * ForumForums Controller
 *
 * @property \AgiraForum\Model\Table\ForumPostsTable $ForumForums
 */
class ForumPostsController extends AppController
{
    public function userPosts($id = null)
    {
        $user = $this->Auth->user();
        //$ForumPosts = TableRegistry::get('ForumPosts');
        $this->paginate = [
            'contain' => ['Users', 'ForumForums'],
            'conditions' => ['ForumPosts.user_id'=>$user['id'],'ForumPosts.is_original !='=>1]
        ];
        $forumPosts = $this->paginate($this->ForumPosts);
        $title = "Posts";
        $this->set('title', $title);
        $this->set(compact('forumPosts'));
        return $this->render('ForumForums/posts');
    }
    
}