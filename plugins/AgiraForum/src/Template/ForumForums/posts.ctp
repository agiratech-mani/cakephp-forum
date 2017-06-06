<div>
    <h3>Posts</h3>
    <hr>
    <ul class="list-group">
    <?php 
    if(!$forumPosts->isEmpty())
    {
        foreach ($forumPosts as $forumPost): 
    ?>  
            <li class="list-group-item " style="margin-bottom:10px;">
                <?= $this->Text->truncate($forumPost->content,200,
                [
                    'ellipsis' => '...',
                   'exact' => true,
                    'html' => true
                ]) ?>
                <br>
                <?= $this->Html->link($forumPost->forum_forum->title,['controller'=>'ForumForums','action'=>'view',$forumPost->forum_forum->slug,"#" => "Comment".$forumPost->id]) ?>
            </li>
    <?php 
        endforeach; 
    }
    else
    {
    ?>
        <li class="list-group-item">No post availbles.</li>
    <?php
    }
    ?>
    </ul>
</div>