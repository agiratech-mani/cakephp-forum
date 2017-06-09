<h4>Hai Admin,</h4>

<p><?php echo $forum->user->username; ?> has posted new forum in <?= $sitename ?>. The forum detail is as follows:</p>

<b>Forum Name: </b> <a href="<?php echo $url; ?>"><?= $forum->title ?></a><br>
<b>Forum Topic: </b> <?= $forum->forum_topic->name ?><br>
<b>Posted on : </b> <?= date('F jS, Y h:i:s A',strtotime($forum->created)) ?><br>

<br>
<br>
<b>Thanks,</b>
</br>
<br>The <?= $sitename ?> Team.</b>