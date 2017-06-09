<?php
namespace AgiraForum\Controller;

use AgiraForum\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * ForumForums Controller
 *
 * @property \AgiraForum\Model\Table\ForumForumsTable $ForumForums
 */
class ForumForumsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index','view']);
    }
    public function index()
    {
        
        $this->paginate = [
            'contain' => ['ForumTopics', 'Users'],
            'conditions' => ['ForumForums.status in'=>[1,3],'ForumForums.deleted != '=> 1],
            'order' => ['ForumForums.created'=>'desc']
        ];
        $forumForums = $this->paginate($this->ForumForums);
        $title = "Forums";
        $this->set('title',$title);
        $this->set(compact('forumForums'));
        $this->set('_serialize', ['forumForums']);
    }

    /**
     * View method
     *
     * @param string|null $id forum id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $user = $this->Auth->user();
        $user_id = 0;
        if(!empty($user))
        {
            $user_id = $user['id'];
        }
        $forumForum = $this->ForumForums->findBySlug($slug)
        ->contain(['ForumTopics'=>['ForumCategories'], 'Users', 'ForumPosts'=>[
                'Users',
                'conditions'=>['ForumPosts.status'=>1],
                'ForumPostLikes'=>['conditions'=>['ForumPostLikes.user_id'=>$user_id]]
            ],'ForumTags'])
        ->where(['ForumForums.status in'=>[1,3],'ForumForums.deleted != '=> 1])->first();
        if(!empty($forumForum))
        {
            $this->ForumForums->updateAll(array('hits'=>($forumForum->hits+1)), array('ForumForums.id'=>$forumForum->id));
            $this->set('forumForum', $forumForum);
            $post = $this->ForumForums->ForumPosts->newEntity();
            $title = $forumForum->title;
            $this->set('post', $post);
            $this->set('title', $title);
            $this->set('_serialize', ['forumForum']);
        }
        else
        {
            $this->Flash->error(__('This forum not availble.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $forumForum = $this->ForumForums->newEntity();

        if ($this->request->is('post')) {
            $forumForum = $this->ForumForums->patchEntity($forumForum, $this->request->data,['associated' => ['ForumPosts','ForumTags']]);
            if ($this->ForumForums->save($forumForum,['associated' => ['ForumPosts','ForumTags']])) {
                $this->Flash->success(__('The forum has been saved.'));
                $forum = $this->ForumForums->get($forumForum->id, [
                   'contain' => ['Users','ForumTopics']
                ]);
                $this->sendAdminNewForumNotify($forum);
                return $this->redirect(['action' => 'view',$forumForum->slug]);
            }
            $this->Flash->error(__('The forum could not be saved. Please, try again.'));
        }
        $forumTopics = $this->ForumForums->ForumTopics->find('list', ['limit' => 200]);
        $tags = $this->ForumForums->ForumTags->find('list', ['limit' => 200]);

        $users = $this->ForumForums->Users->find('list', ['limit' => 200]);
        $this->set(compact('forumForum', 'forumTopics', 'users','tags'));
        $title = "Post new Forum";
        $this->set('title', $title);
        $this->set('_serialize', ['forumForum']);
    }
    public function forumEdit($id = null)
    {
        $forumForum = $this->ForumForums->get($id, [
                'contain' => ['ForumPosts','ForumTags']
        ]);
        if ($this->request->is('post')) {
            $forumForum = $this->ForumForums->patchEntity($forumForum, $this->request->data,['associated' => ['ForumPosts','ForumTags']]);
            if ($this->ForumForums->save($forumForum,['associated' => ['ForumPosts','ForumTags']])) {
                $this->Flash->success(__('The forum has been saved.'));

                return $this->redirect(['action' => 'view',$forumForum->slug]);
            }
            $this->Flash->error(__('The forum could not be saved. Please, try again.'));
        }
        $forumTopics = $this->ForumForums->ForumTopics->find('list', ['limit' => 200]);
        $tags = $this->ForumForums->ForumTags->find('list', ['limit' => 200]);
        $title = "Edit Forum - ".$forumForum->title;
        $this->set(compact('forumForum', 'forumTopics', 'users','tags','title'));
        $this->set('_serialize', ['forumForum']);

    }
    
    public function edit($forumid = null,$id = null)
    {
        if(!is_null($id))
        {
            $forumPost = $this->ForumForums->ForumPosts->get($id, [
                'contain' => []
            ]);
        }
        else
        {
            $forumPost = $this->ForumForums->ForumPosts->newEntity(); 
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $forumPost = $this->ForumForums->ForumPosts->patchEntity($forumPost, $this->request->data);
            if ($this->ForumForums->ForumPosts->save($forumPost)) {
                //$this->Flash->success(__('The forum has been saved.'));
                if(!is_null($id))
                {
                    $forumPost = $this->ForumForums->ForumPosts->get($id, [
                        'contain' => ["Users"]
                    ]);
                    echo "edit*";
                }
                else
                {
                    $id = $forumPost->id;
                    $forumPost = $this->ForumForums->ForumPosts->get($id, [
                        'contain' => ["Users",'ForumForums'=>['Users']]
                    ]);
                    if($this->Auth->user('id') != $forumPost->forum_forum->user_id)
                    {
                        $this->sendNewPostNotify($forumPost);    
                    }
                    echo "new*";
                    //return "redirect*url";
                }
                //return $this->redirect(['action' => 'index']);
                $this->set(compact('forumPost'));
                return $this->render('preview');

            }
            $this->Flash->error(__('The forum could not be saved. Please, try again.'));
        }
        $this->viewBuilder()->layout("ajax");
        $this->set(compact('forumPost','forumid'));
        $this->set('_serialize', ['forumPost']);
    }
    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $forumForum = $this->ForumForums->get($id);
        if ($this->ForumForums->delete($forumForum)) {
            $this->Flash->success(__('The forum has been deleted.'));
        } else {
            $this->Flash->error(__('The forum could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function close($slug = null)
    {
        if(!is_null($slug))
        {
            $forumForum = $this->ForumForums->findBySlug($slug)->first();
            $forumForum->status = 3;
            if($this->ForumForums->save($forumForum))
            {
                $this->Flash->success(__('The forum has been closed.'));
                echo "reload*closed";
            }
            else
            {
                $this->Flash->error(__('The forum could not be closed. Please, try again.'));
                echo "reload*error";
            }
            die;
        }
        $this->Flash->error(__('The forum could not be closed. Please, try again.'));
        echo "reload*error";
        die;
    }


    public function preview($id = null)
    {
        $forumPost = $this->ForumForums->ForumPosts->get($id, [
            'contain' => ["Users"]
        ]);
        $this->set(compact('forumPost'));
        $this->viewBuilder()->layout("ajax");
        return $this->render('preview');
    }
    public function userForums()
    {
        $user = $this->Auth->user();
        $this->paginate = [
            'contain' => ['ForumTopics', 'Users'],
            'conditions' => ['ForumForums.user_id'=>$user['id'],'ForumForums.deleted != '=> 1],
        ];
        $forumForums = $this->paginate($this->ForumForums);
        $title = "Forums";
        $this->set('title', $title);
        $this->set(compact('forumForums'));
        return $this->render('forums');
    }   
}
