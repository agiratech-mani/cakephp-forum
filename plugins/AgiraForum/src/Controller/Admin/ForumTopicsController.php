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
    public function index()
    {
        $this->paginate = [
            'contain' => ['ForumCategories', 'Users']
        ];
        $forumTopics = $this->paginate($this->ForumTopics);
        $title = "Forum Topics";
        $this->set("title",$title);
        $this->set(compact('forumTopics'));
        $this->set('_serialize', ['forumTopics']);
    }

    public function view($id = null)
    {
        $forumTopic = $this->ForumTopics->get($id, [
            'contain' => ['ForumCategories', 'Users']
        ]);

        $this->set('forumTopic', $forumTopic);
        $this->set('_serialize', ['forumTopic']);
    }

    public function add()
    {
        $forumTopic = $this->ForumTopics->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['user_id'] = $this->Auth->user('id');
            $forumTopic = $this->ForumTopics->patchEntity($forumTopic, $this->request->data);
            if ($this->ForumTopics->save($forumTopic)) {
                $this->Flash->success(__('The forum topic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The forum topic could not be saved. Please, try again.'));
        }
        $forumCategories = $this->ForumTopics->ForumCategories->find('list', ['limit' => 200]);
        $users = $this->ForumTopics->Users->find('list', ['limit' => 200]);
        $title = "Add Forum Topic";
        $this->set("title",$title);
        $this->set(compact('forumTopic', 'forumCategories', 'users'));
        $this->set('_serialize', ['forumTopic']);
    }

    public function edit($id = null)
    {
        $forumTopic = $this->ForumTopics->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
           //$this->request->data['user_id'] = $this->Auth->user('id');
            $forumTopic = $this->ForumTopics->patchEntity($forumTopic, $this->request->data);
            if ($this->ForumTopics->save($forumTopic)) {
                $this->Flash->success(__('The forum topic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The forum topic could not be saved. Please, try again.'));
        }
        $forumCategories = $this->ForumTopics->ForumCategories->find('list', ['limit' => 200]);
        $users = $this->ForumTopics->Users->find('list', ['limit' => 200]);
        $title = "Edit Forum Topic - ".$forumTopic->name;
        $this->set("title",$title);
        $this->set(compact('forumTopic', 'forumCategories', 'users'));
        $this->set('_serialize', ['forumTopic']);
    }

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
