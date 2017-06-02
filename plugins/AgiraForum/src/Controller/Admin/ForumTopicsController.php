<?php
namespace AgiraForum\Controller\Admin;

use AgiraForum\Controller\AppController;

/**
 * ForumTopics Controller
 *
 * @property \AgiraForum\Model\Table\ForumTopicsTable $ForumTopics
 */
class ForumTopicsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ForumCategories', 'Users']
        ];
        $forumTopics = $this->paginate($this->ForumTopics);

        $this->set(compact('forumTopics'));
        $this->set('_serialize', ['forumTopics']);
    }

    /**
     * View method
     *
     * @param string|null $id Forum Topic id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $forumTopic = $this->ForumTopics->get($id, [
            'contain' => ['ForumCategories', 'Users']
        ]);

        $this->set('forumTopic', $forumTopic);
        $this->set('_serialize', ['forumTopic']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $forumTopic = $this->ForumTopics->newEntity();
        if ($this->request->is('post')) {
            $forumTopic = $this->ForumTopics->patchEntity($forumTopic, $this->request->data);
            if ($this->ForumTopics->save($forumTopic)) {
                $this->Flash->success(__('The forum topic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The forum topic could not be saved. Please, try again.'));
        }
        $forumCategories = $this->ForumTopics->ForumCategories->find('list', ['limit' => 200]);
        $users = $this->ForumTopics->Users->find('list', ['limit' => 200]);
        $this->set(compact('forumTopic', 'forumCategories', 'users'));
        $this->set('_serialize', ['forumTopic']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Forum Topic id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $forumTopic = $this->ForumTopics->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $forumTopic = $this->ForumTopics->patchEntity($forumTopic, $this->request->data);
            if ($this->ForumTopics->save($forumTopic)) {
                $this->Flash->success(__('The forum topic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The forum topic could not be saved. Please, try again.'));
        }
        $forumCategories = $this->ForumTopics->ForumCategories->find('list', ['limit' => 200]);
        $users = $this->ForumTopics->Users->find('list', ['limit' => 200]);
        $this->set(compact('forumTopic', 'forumCategories', 'users'));
        $this->set('_serialize', ['forumTopic']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Forum Topic id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $forumTopic = $this->ForumTopics->get($id);
        if ($this->ForumTopics->delete($forumTopic)) {
            $this->Flash->success(__('The forum topic has been deleted.'));
        } else {
            $this->Flash->error(__('The forum topic could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
