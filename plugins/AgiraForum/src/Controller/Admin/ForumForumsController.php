<?php
namespace AgiraForum\Controller\Admin;

use AgiraForum\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * ForumForums Controller
 *
 * @property \AgiraForum\Model\Table\ForumForumsTable $ForumForums
 */
class ForumForumsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ForumTopics', 'Users'],
            'conditions'=>['ForumForums.deleted != '=> 1]
        ];
        $forumForums = $this->paginate($this->ForumForums);
        $title = "Forums";
        $this->set('title',$title);
        $this->set(compact('forumForums'));
        $this->set('_serialize', ['forumForums']);
    }
    public function changeStatus($id = NULL,$status = NULL)
    {
        $ForumForums = TableRegistry::get('ForumForums');
        $forumForum = $ForumForums->get($id);
        if(!empty($forumForum))
        {
            $forumForum->status = $status;
            if($ForumForums->save($forumForum))
            {
                $forum = $this->ForumForums->get($id,['contain'=>['Users']]);
                
                $this->sendForumClosedNotify($forum);
                $this->Flash->success(__('Forum discussion closed successfully.'));
            }
            else
            {
                $this->Flash->success(__('Forum status couldn\'t be changed. Please try again later.'));
            }
            
        }
         return $this->redirect(['action' => 'index']);
    }
    /**
     * View method
     *
     * @param string|null $id Forum Forum id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $forumForum = $this->ForumForums->get($id, [
            'contain' => ['ForumTopics', 'Users', 'ForumTags', 'ForumPosts']
        ]);

        $title = "Forum - ".$forumForum->title;
        $this->set('title',$title);
        $this->set('forumForum', $forumForum);
        $this->set('_serialize', ['forumForum']);
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

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The forum forum could not be saved. Please, try again.'));
        }
        $forumTopics = $this->ForumForums->ForumTopics->find('list', ['limit' => 200]);
        $tags = $this->ForumForums->ForumTags->find('list', ['limit' => 200]);

        $users = $this->ForumForums->Users->find('list', ['limit' => 200]);
         $title = "Create a new Forum";
        $this->set('title',$title);
        $this->set(compact('forumForum', 'forumTopics', 'users','tags'));
        $this->set('_serialize', ['forumForum']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Forum Forum id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $forumForum = $this->ForumForums->get($id, [
                'contain' => ['ForumPosts','ForumTags']
        ]);
        if ($this->request->is('post')) {
            $forumForum = $this->ForumForums->patchEntity($forumForum, $this->request->data,['associated' => ['ForumPosts','ForumTags']]);
            if ($this->ForumForums->save($forumForum,['associated' => ['ForumPosts','ForumTags']])) {
                $this->Flash->success(__('The forum has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The forum could not be saved. Please, try again.'));
        }
        $forumTopics = $this->ForumForums->ForumTopics->find('list', ['limit' => 200]);
        $tags = $this->ForumForums->ForumTags->find('list', ['limit' => 200]);
        $title = "Edit Forum - ".$forumForum->title;
        $this->set(compact('forumForum', 'forumTopics', 'users','tags','title'));
        $this->set('_serialize', ['forumForum']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Forum Forum id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $ForumForums = TableRegistry::get('ForumForums');
        $forumForum = $ForumForums->get($id);
        if(!empty($forumForum))
        {
            $forumForum->deleted = 1;
            if($ForumForums->save($forumForum))
            {
                $forum = $this->ForumForums->get($id,['contain'=>['Users']]);
                
                $this->sendForumDeletedNotify($forum);
                $this->Flash->success(__('Forum deleted successfully.'));
            }
            else
            {
                $this->Flash->success(__('Forum status couldn\'t be deleted. Please try again later.'));
            }
            
        }
        return $this->redirect(['action' => 'index']);
    }
}
