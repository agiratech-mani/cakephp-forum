<div>
    <h3>Post new Forum</h3>
    <hr>
    <div class="col-md-6 ">
        <?= $this->Form->create($forumForum,['class'=>'form-horizontal','type'=>'POST']) ?>
            <fieldset>
                <div class="form-group required">
                    <label class="col-sm-4 control-label">Title</label>
                    <div class="col-sm-8">
                        <?= $this->Form->input('title',['class'=>"form-control",'label'=>false]) ?>
                    </div>
                </div>
                <div class="form-group required">
                    <label class="col-sm-4 control-label">Topic</label>
                    <div class="col-sm-8">
                        <?= $this->Form->input('forum_topic_id',['options' => $forumTopics,'class'=>"form-control",'label'=>false]) ?>
                    </div>
                </div>
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
                <div class="form-group required">
                    <label class="col-sm-4 control-label">Tags</label>
                    <div class="col-sm-8">
                        <?= $this->Form->input('forum_tags._ids',['options' => $tags,'class'=>"form-control",'label'=>false]) ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= $this->Form->button('Submit',['class'=>"btn btn-m btn-success btn-inline  pull-right"]) ?>
                </div>
            </fieldset>
        <?= $this->Form->end(); ?>
    </div>
</div>