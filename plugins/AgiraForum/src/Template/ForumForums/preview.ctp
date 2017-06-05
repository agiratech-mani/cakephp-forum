<div class="col-md-3 col-sm-3 col-xs-3">
<strong><?= (!empty($forumPost->user->first_name)?$forumPost->user->first_name." ".$forumPost->user->last_name:$forumPost->user->username) ?>(<small><?= $forumPost->user->username ?></small>)</strong>
                <br>
                <small>Posted on: <?= h($forumPost->created) ?></small>
</div>
<div class="col-md-9  col-sm-9 col-sm-9">
<div  class="clsForumPost-<?= $forumPost->id ?>">
    <div>
        <span><?= h($forumPost->modified) ?></span>
        <?php if($forumPost->user_id == $authUser['id']){ ?>
        <a href="#" class="pull-right jsEditPost" data-postid="<?= $forumPost->id ?>" data-forumid="<?= $forumPost->forum_forum_id ?>"><i class="fa fa-pencil"></i></a>
        <?php } ?>
    </div>
    <div class="commentdiv">
        <?= $forumPost->content ?>
    </div>
</div>
</div>