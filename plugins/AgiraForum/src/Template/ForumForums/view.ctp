<div>
<?php //$this->assign('title', 'View Active Users'); ?>
    <?php
        $loguser = $this->request->session()->read('Auth.User');
    ?>
    <small><?= h($forumForum->forum_topic->forum_category->name) ?> / <?= h($forumForum->forum_topic->name) ?></small>
    <h3><?= h($forumForum->title) ?></h3>
    by <?= (!empty($forumForum->user->first_name)?$forumForum->user->first_name." ".$forumForum->user->last_name:$forumForum->user->username) ?> 
    <hr>
    <div class="jsForumPostContents">
        <?php foreach ($forumForum->forum_posts as $forumPosts): ?>
            <div class="clearfix clsForumPost">
                <div class="col-md-3 col-sm-3 col-xs-3">
                <strong><?= (!empty($forumPosts->user->first_name)?$forumPosts->user->first_name." ".$forumPosts->user->last_name:$forumPosts->user->username) ?>(<small><?= $forumPosts->user->username ?></small>)</strong>
                <br>
                <small>Posted on: <?= h($forumPosts->created) ?></small>
                </div>
                <div class="col-md-9  col-sm-9 col-sm-9">
                <div  class="clsForumPost-<?= $forumPosts->id ?>">
                    <div>
                        <span><?= h($forumPosts->modified) ?></span>
                        <?php if($forumPosts->user_id == $loguser['id']){ ?>
                        <a href="#" class="pull-right jsEditPost" data-postid="<?= $forumPosts->id ?>" data-forumid="<?= $forumPosts->forum_forum_id ?>"><i class="fa fa-pencil"></i></a>
                        <?php } ?>
                    </div>
                    <div class="commentdiv">
                        <?= $forumPosts->content ?>
                    </div>
                </div>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    </div>
    <div>
        <h4>Post Comment</h4>
        <div class="clearfix">
        
         <div class="col-md-3 col-sm-3 col-xs-3">
            <?= $loguser['username'] ?>
            <br>
            <?= (!empty($loguser['first_name'])?$loguser['first_name']." ".$loguser['last_name']:$loguser['username']) ?>
        </div>
        <div class="col-md-9  col-sm-9 col-sm-9">
        <?= $this->Form->create($post,[
            'url' => ['controller' => 'ForumForums', 'action' => 'edit',$forumForum->id],
            'class'=>'ajaxForm','type'=>'POST'
        ]) ?>
            <fieldset>
                <div class="form-group required clearfix">
                    <!--<label class="control-label">Content</label>-->
                    <?= $this->Form->input('content',['type'=>'textarea','class'=>"form-control jsTextEditor","id"=>"postdata",'label'=>false]) ?>
                    <?= $this->Form->input('user_id',['type'=>'hidden','value'=>$loguser['id']]) ?>
                    <?= $this->Form->input('forum_forum_id',['type'=>'hidden','value'=>$forumForum->id]) ?>
                    <?= $this->Form->input('status',['type'=>'hidden','value'=>1]) ?>
                </div>
                <div class="form-group clearfix">
                    <?= $this->Form->button('Submit',['class'=>"btn btn-m btn-success btn-inline  pull-right btnSubmit",'type'=>'button']) ?>
                </div>
            </fieldset>
            
            <?= $this->Form->end(); ?>
        </div>
        </div>
    </div>
</div>