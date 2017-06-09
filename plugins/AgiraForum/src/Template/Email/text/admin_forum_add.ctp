Hai Admin,

<?php echo $forum->user->username; ?> has posted new forum in <?= $sitename ?>. The forum detail is as follows:

Forum Name: <?= $forum->title ?>

Forum Topic:  <?= $forum->forum_topic->name ?>

Posted on : <?= date('F jS, Y h:i:s A',strtotime($forum->created)) ?>

<?php echo $url; ?>


Thanks,

The <?= $sitename ?> Team.