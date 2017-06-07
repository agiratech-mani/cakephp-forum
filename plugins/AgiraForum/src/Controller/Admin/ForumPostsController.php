<?php
namespace AgiraForum\Controller\Admin;

use AgiraForum\Controller\AppController;
use Cake\ORM\TableRegistry;
class ForumPostsController extends AppController
{
    public function index($forumId = NULL)
    {
        $forumForum = $this->ForumPosts->ForumForums->get($forumId);

        $this->paginate = [
            'conditions' => [
                'ForumPosts.forum_forum_id' => $forumId,
                'ForumPosts.status !=' => 2,
            ],
            'contain' => ['ForumForums', 'Users'],
            'order'=>['ForumPosts.id' => 'asc']
        ];
        $forumPosts = $this->paginate($this->ForumPosts);
        $title = "Contents - ".$forumForum->title;
        $this->set(compact('forumPosts','title'));
        $this->set('_serialize', ['forumPosts']);
    }
    public function edit($id = null)
    {
        $forumPost = $this->ForumPosts->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $forumPost = $this->ForumPosts->patchEntity($forumPost, $this->request->data);
            if ($this->ForumPosts->save($forumPost)) {
                $this->Flash->success(__('The forum post has been saved.'));

                return $this->redirect(['action' => 'index',$forumPost->forum_forum_id]);
            }
            $this->Flash->error(__('The forum forum could not be saved. Please, try again.'));
        }
        $statuses = [0=>'Disable',1=>'Active',2=>'Delete'];
        $this->set(compact('forumPost','statuses'));
        $this->set('_serialize', ['forumPost']);
    }
    public function changeStatus($id = NULL,$status = NULL)
    {
        $ForumPosts = TableRegistry::get('ForumPosts');
        $forumPost = $ForumPosts->get($id);
        if(!empty($forumPost))
        {
            $forumPost->status = $status;
            $ForumPosts->save($forumPost);
            if($status == 2)
            {
                $this->Flash->success(__('Forum content deleted successfully.'));
            }
            else
            {
                $this->Flash->success(__('Forum content status changed successfully.'));
            }
            
        }
         return $this->redirect(['action' => 'index',$forumPost->forum_forum_id]);
    }
}