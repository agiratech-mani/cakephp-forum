<div>
    <h3><?= h($forumForum->title) ?></h3>
    by <?= (!empty($forumForum->user->first_name)?$forumForum->user->first_name." ".$forumForum->user->last_name:$forumForum->user->username) ?> 
    <hr>
    <div>
        <?php foreach ($forumForum->forum_posts as $forumPosts): ?>
            <div class="clearfix">
                <div class="col-md-3 col-sm-3 col-xs-3">
                <?= $forumPosts->user->username ?>
                <br>

                <?= (!empty($forumPosts->user->first_name)?$forumPosts->user->first_name." ".$forumPosts->user->last_name:$forumPosts->user->username) ?>
                <br>
                Posted on: <?= h($forumPosts->created) ?>
                </div>
                <div class="col-md-9  col-sm-9 col-sm-9">
                <div>
                <span><?= h($forumPosts->modified) ?></span>
                <a href="#" class="pull-right">Edit</a>
                </div>
                <div>
                    <?= $forumPosts->content ?>
                </div>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    </div>
    <div>
        <h4>Post Comment</h4>
        <?= $this->Form->create($post,['class'=>'form-horizontal','type'=>'POST']) ?>
            <fieldset>
                <div class="form-group required">
                    <label class="col-sm-4 control-label">Content</label>
                    <div class="col-sm-8">
                        <?= $this->Form->input('forum_posts[0].content',['type'=>'textarea','class'=>"form-control",'label'=>false]) ?>
                        <?php
                            $loguser = $this->request->session()->read('Auth.User');
                        ?>
                        <?= $this->Form->input('user_id',['type'=>'hidden','value'=>$loguser['id']]) ?>
                        <?= $this->Form->input('status',['type'=>'hidden','value'=>1]) ?>
                        <?= $this->Form->input('forum_posts[0].user_id',['type'=>'hidden','value'=>$loguser['id']]) ?>
                        <?= $this->Form->input('forum_posts[0].status',['type'=>'hidden','value'=>1]) ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= $this->Form->button('Submit',['class'=>"btn btn-m btn-success btn-inline  pull-right"]) ?>
                </div>
            </fieldset>
        <?= $this->Form->end(); ?>
    </div>
</div>