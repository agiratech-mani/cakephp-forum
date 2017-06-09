<h4>Hai <?= $forum->user->first_name." ".$forum->user->last_name ?>,</h4>

<p>Your forum titled <b><?= $forum->title ?></b> has closed by <?= $user['username'] ?>.</p>

<a href="<?php echo $url; ?>"><?= $forum->title ?></a>

<br>
<br>
<b>Thanks,</b>
</br>
<br>The <?= $sitename ?> Team.</b>