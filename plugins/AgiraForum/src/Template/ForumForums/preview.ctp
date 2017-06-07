<div class="col-md-3 col-sm-3 col-xs-3">
                <strong><?= (!empty($forumPost->user->first_name)?$forumPost->user->first_name." ".$forumPost->user->last_name:$forumPost->user->username) ?>(<small class="jsCommentContentUser-<?= $forumPost->id ?>"><?= $forumPost->user->username ?></small>)</strong>
                <br>
                <small>Posted on: <?= $this->Forum->date($forumPost->created) ?></small>
                </div>
                <div class="col-md-9  col-sm-9 col-sm-9">
                <div  class="clsForumPost-<?= $forumPost->id ?>">
                    <div>
                        <small class="text-sm text-muted"><?= $this->Forum->date($forumPost->modified) ?></small>
                        <?php if($forumPost->user_id == $authUser['id']){ ?>
                        <?php if($forumPost->is_original): ?>
                            <?= $this->Html->link('<i class="fa fa-pencil"></i> Edit', ['controller' => 'ForumForums', 'action' => 'forumEdit', $forumPost->forum_forum_id],['escape'=>false,'class'=>'pull-right']) ?>
                        <?php else: ?>
                            <a href="#" class="pull-right jsEditPost" data-postid="<?= $forumPost->id ?>" data-forumid="<?= $forumPost->forum_forum_id ?>"><i class="fa fa-pencil"></i> Edit</a>
                        <?php endif; ?>
                        <?php } ?>
                        
                        <a href="#" class="pull-right jsLikePost marRight10" data-postid="<?= $forumPost->id ?>" data-forumid="<?= $forumPost->forum_forum_id ?>">
                            <?php if(!empty($forumPost->forum_post_likes)): ?>
                                <i class="fa fa-thumbs-up"></i> Liked
                            <?php else: ?>
                                <i class="fa fa-thumbs-o-up"></i> Like
                            <?php endif; ?>
                        </a>

                        <a href="#" class="pull-right jsQuotePost marRight10" data-postid="<?= $forumPost->id ?>" data-forumid="<?= $forumPost->forum_forum_id ?>"><i class="fa fa-quote-left"></i> Quote</a>


                    </div>
                    <div class="commentdiv jsCommentContent-<?= $forumPost->id ?>">
                        <?= $forumPost->content ?>
                    </div>
                </div>
                </div>