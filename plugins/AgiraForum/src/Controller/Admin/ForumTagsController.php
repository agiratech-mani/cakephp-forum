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
    public function index()
    {
        $forumTags = $this->paginate($this->ForumTags);
        $title = "Forum Tags";
        $this->set("title",$title);
        $this->set(compact('forumTags'));
        $this->set('_serialize', ['forumTags']);
    }
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
        $title = "Add Forum Tag";
        $this->set("title",$title);
        $this->set(compact('forumTag'));
        $this->set('_serialize', ['forumTag']);
    }
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
        $title = "Edit Forum Tag - ".$forumTag->name;
        $this->set("title",$title);
        $this->set(compact('forumTag'));
        $this->set('_serialize', ['forumTag']);
    }

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
