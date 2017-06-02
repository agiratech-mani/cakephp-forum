<?php
namespace AgiraForum\Controller;

use AgiraForum\Controller\AppController;

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
            'contain' => ['ForumTopics', 'Users']
        ];
        $forumForums = $this->paginate($this->ForumForums);

        $this->set(compact('forumForums'));
        $this->set('_serialize', ['forumForums']);
    }

    /**
     * View method
     *
     * @param string|null $id Forum Forum id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $forumForum = $this->ForumForums->findBySlug($slug)
        ->contain(['ForumTopics', 'Users', 'ForumPosts'=>['Users']])->first();
        $this->ForumForums->updateAll(array('hits'=>($forumForum->hits+1)), array('ForumForums.id'=>$forumForum->id));

        $post = $this->ForumForums->ForumPosts->newEntity();

        $this->set('forumForum', $forumForum);
        $this->set('post', $post);
        
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
            // print_r($this->request->data);
            // die;
            //$forumForum->dirty('forum_posts', true);
            $forumForum = $this->ForumForums->patchEntity($forumForum, $this->request->data,['associated' => ['ForumPosts','ForumTags']]);
            // echo "<pre>";
            // print_r($forumForum );
            // die;
            if ($this->ForumForums->save($forumForum,['associated' => ['ForumPosts','ForumTags']])) {
                $this->Flash->success(__('The forum forum has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The forum forum could not be saved. Please, try again.'));
        }
        $forumTopics = $this->ForumForums->ForumTopics->find('list', ['limit' => 200]);
        $tags = $this->ForumForums->ForumTags->find('list', ['limit' => 200]);

        $users = $this->ForumForums->Users->find('list', ['limit' => 200]);
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
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $forumForum = $this->ForumForums->patchEntity($forumForum, $this->request->data);
            if ($this->ForumForums->save($forumForum)) {
                $this->Flash->success(__('The forum forum has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The forum forum could not be saved. Please, try again.'));
        }
        $forumTopics = $this->ForumForums->ForumTopics->find('list', ['limit' => 200]);
        $users = $this->ForumForums->Users->find('list', ['limit' => 200]);
        $this->set(compact('forumForum', 'forumTopics', 'users'));
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
        $this->request->allowMethod(['post', 'delete']);
        $forumForum = $this->ForumForums->get($id);
        if ($this->ForumForums->delete($forumForum)) {
            $this->Flash->success(__('The forum forum has been deleted.'));
        } else {
            $this->Flash->error(__('The forum forum could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
