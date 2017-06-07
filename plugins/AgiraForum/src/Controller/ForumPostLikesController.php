<?php
namespace AgiraForum\Controller;

use AgiraForum\Controller\AppController;
use Cake\ORM\TableRegistry;

class ForumPostLikesController extends AppController
{
	public function like($post_id)
    {
        $user = $this->Auth->user();
        $forumPostTable = TableRegistry::get('ForumPosts');
        $forumPost = $forumPostTable->get($post_id);
        $response = '';
        if(!empty($forumPost))
        {
            $result = $this->ForumPostLikes->find()->where(['ForumPostLikes.forum_post_id'=>$post_id,'ForumPostLikes.user_id'=>$user['id']])->first();
            if(empty($result))
            {

	            $forumPostLike = $this->ForumPostLikes->newEntity();
	            $forumPostLike->forum_post_id = $post_id;
	            $forumPostLike->user_id = $user['id'];
	            $this->ForumPostLikes->save($forumPostLike);
	            $response = "liked";
	          }
	          else
	          {
	          	$this->ForumPostLikes->delete($result);
	          	$response = "unliked";
	          }
        }
        echo $response;
        die;
    }
}