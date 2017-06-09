<h4>Hai <?= $user->first_name." ".$user->last_name ?>,</h4>

<p>Your forum titled <b><?= $forum->title ?></b> has closed automatic cron.</p>

<a href="<?php echo $url; ?>"><?= $forum->title ?></a>

<br>
<br>
<b>Thanks,</b>
</br>
<br>The <?= $sitename ?> Team.</b>