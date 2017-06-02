<?php
namespace AgiraForum\Controller\Admin;

use AgiraForum\Controller\AppController;

/**
 * ForumTags Controller
 *
 * @property \AgiraForum\Model\Table\ForumTagsTable $ForumTags
 */
class ForumTagsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $forumTags = $this->paginate($this->ForumTags);
        $this->set(compact('forumTags'));
        $this->set('_serialize', ['forumTags']);
    }

    /**
     * View method
     *
     * @param string|null $id Forum Tag id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $forumTag = $this->ForumTags->get($id, [
            'contain' => []
        ]);

        $this->set('forumTag', $forumTag);
        $this->set('_serialize', ['forumTag']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $forumTag = $this->ForumTags->newEntity();
        if ($this->request->is('post')) {
            $forumTag = $this->ForumTags->patchEntity($forumTag, $this->request->data);
            if ($this->ForumTags->save($forumTag)) {
                $this->Flash->success(__('The forum tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The forum tag could not be saved. Please, try again.'));
        }
        $this->set(compact('forumTag'));
        $this->set('_serialize', ['forumTag']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Forum Tag id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $forumTag = $this->ForumTags->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $forumTag = $this->ForumTags->patchEntity($forumTag, $this->request->data);
            if ($this->ForumTags->save($forumTag)) {
                $this->Flash->success(__('The forum tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The forum tag could not be saved. Please, try again.'));
        }
        $this->set(compact('forumTag'));
        $this->set('_serialize', ['forumTag']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Forum Tag id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $forumTag = $this->ForumTags->get($id);
        if ($this->ForumTags->delete($forumTag)) {
            $this->Flash->success(__('The forum tag has been deleted.'));
        } else {
            $this->Flash->error(__('The forum tag could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
