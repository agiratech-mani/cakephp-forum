<div>
    <small><?= h($forumForum->forum_topic->forum_category->name) ?> / <?= h($forumForum->forum_topic->name) ?></small>
    <h3><?php if($forumForum->status == 3): ?>
        <span class="btn btn-danger btn-sm">Closed</span>
    <?php endif; ?>
    <?php echo ($forumForum->title) ?></h3>
    by <?= (!empty($forumForum->user->first_name)?$forumForum->user->first_name." ".$forumForum->user->last_name:$forumForum->user->username) ?> 
    <?=  $forumForum->status ?>
    <?php if($forumForum->user_id == $authUser['id'] && $forumForum->status == 1){ ?>
        <div class="pull-right">
            <button class="btn btn-danger jsCloseDiscussion" data-slug="<?= $forumForum->slug ?>">Close the discussion</button>
        </div>
    <?php } ?>
    <hr>
    <div class="jsForumPostContents">
        <?php foreach ($forumForum->forum_posts as $forumPosts): ?>
            <div class="clearfix clsForumPost" id="<?= 'Comment-'.$forumPosts->id ?>">
                <div class="col-md-3 col-sm-3 col-xs-3 clsUserBlock">
                    <strong><?= (!empty($forumPosts->user->first_name)?$forumPosts->user->first_name." ".$forumPosts->user->last_name:$forumPosts->user->username) ?>(<small class="jsCommentContentUser-<?= $forumPosts->id ?>"><?= $forumPosts->user->username ?></small>)</strong>
                    <br>
                    <small>Posted on: <?= $this->Forum->date($forumPosts->created) ?></small>
                </div>
                <div class="col-md-9 col-sm-9 col-sm-9 clsContentBlock">
                    <div  class="clsForumPost-<?= $forumPosts->id ?>">
                        <div>
                            <small class="text-sm text-muted"><?= $this->Forum->date($forumPosts->modified) ?></small>
                            <?php if($forumPosts->user_id == $authUser['id']){ ?>
                            <?php if($forumPosts->is_original): ?>
                                <?= $this->Html->link('<i class="fa fa-pencil"></i> Edit', ['controller' => 'ForumForums', 'action' => 'forumEdit', $forumPosts->forum_forum_id],['escape'=>false,'class'=>'pull-right']) ?>
                            <?php else: ?>
                            <a href="#" class="pull-right jsEditPost" data-postid="<?= $forumPosts->id ?>" data-forumid="<?= $forumPosts->forum_forum_id ?>"><i class="fa fa-pencil"></i> Edit</a>
                            <?php endif; ?>
                            <?php } ?>
                            
                            <a href="#" class="pull-right jsLikePost marRight10" data-postid="<?= $forumPosts->id ?>" data-forumid="<?= $forumPosts->forum_forum_id ?>">
                                <?php if(!empty($forumPosts->forum_post_likes)): ?>
                                    <i class="fa fa-thumbs-up"></i> Liked
                                <?php else: ?>
                                    <i class="fa fa-thumbs-o-up"></i> Like
                                <?php endif; ?>
                            </a>

                            <a href="#" class="pull-right jsQuotePost marRight10" data-postid="<?= $forumPosts->id ?>" data-forumid="<?= $forumPosts->forum_forum_id ?>"><i class="fa fa-quote-left"></i> Quote</a>


                        </div>
                        <div class="commentdiv jsCommentContent-<?= $forumPosts->id ?>">
                            <?= $forumPosts->content ?>
                        </div>
                    </div>
                </div>
            </div>
                <?php if($forumPosts->is_original == 1){ ?>
                    <div class="clearfix mar5">
                        <div class="col-md-offset-3 col-md-9  col-sm-9 col-sm-9">
                            <?php foreach ($forumForum->forum_tags as $forumTag): ?>
                                <span class="btn btn-default btn-xs tag"><?= $forumTag->name ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php } ?>
            <hr>
        <?php endforeach; ?>
    </div>
    <?php if($forumForum->status == 1){ ?>
    <div>
        <h4>Post Comment</h4>
        <div class="clearfix clsPostCommentBlock">
        
         <div class="col-md-3 col-sm-3 col-xs-3">
            <?= $authUser['username'] ?>
            <br>
            <?= (!empty($authUser['first_name'])?$authUser['first_name']." ".$authUser['last_name']:$authUser['username']) ?>
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
                    <?= $this->Form->input('user_id',['type'=>'hidden','value'=>$authUser['id']]) ?>
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
    <?php 
    }
    elseif($forumForum->status == 3){ 
    ?>
    <div class="well text-center">
        <b class="text-center  text-danger">This discussion has been closed.</b>
    </div>
    <?php
    }
    ?>
</div>