Hai <?= $post->forum_forum->user->first_name." ".$post->forum_forum->user->last_name ?>,

<?php echo $post->user->username; ?> has posted new comment on your forum <?= $post->forum_forum->title ?>.

Posted on : <?= date('F jS, Y h:i:s A',strtotime($post->created)) ?>

Please click the below link to view comment.

<?php echo $url; ?>

<br>
<br>
<b>Thanks,</b>
</br>
<br>The <?= $sitename ?> Team.</b>