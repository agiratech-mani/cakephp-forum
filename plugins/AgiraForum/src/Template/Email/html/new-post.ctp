<h4>Hai Admin,</h4>

<p><?php echo $post->user->username; ?> has posted new comment on your forum <?= $post->forum_forum->titile.</p>

<?= $post->content; ?>
<br>
<b>Posted on : </b> <?= date('F jS, Y h:i:s A',strtotime($post->created)) ?><br>

<p>Please click the below link to view comment </p>

<a href="<?php echo $url; ?>"><?= $post->forum_forum->title ?></a>

<br>
<br>
<b>Thanks,</b>
</br>
<br>The <?= $sitename ?> Team.</b>