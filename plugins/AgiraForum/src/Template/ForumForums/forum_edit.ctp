<div>
    <h3><?php echo $title;?></h3>
    <hr>
    <div class="col-md-offset-2 col-md-8 login-panel panel panel-default" style="padding-top:10px">
        <?= $this->Form->create($forumForum,['class'=>'','type'=>'POST']) ?>
            <fieldset>
                <div class="form-group required">
                    <label>Title</label>
                    <div>
                        <?= $this->Form->input('title',['class'=>"form-control",'label'=>false]) ?>
                    </div>
                </div>
                <div class="form-group required">
                    <label>Topic</label>
                    <div>
                        <?= $this->Form->input('forum_topic_id',['options' => $forumTopics,'class'=>"form-control",'label'=>false]) ?>
                    </div>
                </div>
                <div class="form-group required">
                    <label>Content</label>
                    <div>
                        <?= $this->Form->input('forum_posts[0].content',['type'=>'textarea','class'=>"form-control jsTextEditor",'label'=>false,'value'=>$forumForum->forum_posts[0]->content]) ?>
                        <?php
                            $loguser = $this->request->session()->read('Auth.User');
                        ?>
                        <?= $this->Form->input('forum_posts[0].id',['class'=>"form-control",'type'=>'hidden','value'=>$forumForum->forum_posts[0]->id]) ?>
                    </div>
                </div>
                <div class="form-group required">
                    <label>Tags</label>
                    <div>
                        <?= $this->Form->input('forum_tags._ids',['options' => $tags,'class'=>"form-control",'label'=>false]) ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= $this->Html->link("Cancel",['controller'=>'ForumForums','action'=>'view',$forumForum->slug],['class'=>'btn btn-default']) ?>
                    <?= $this->Form->button('Submit',['class'=>"btn btn-m btn-success btn-inline btnSubmit pull-right",'type'=>'button']) ?>
                </div>
            </fieldset>
        <?= $this->Form->end(); ?>
    </div>
</div>