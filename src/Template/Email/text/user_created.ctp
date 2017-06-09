Hai <?= $user->first_name ?> <?= $user->last_name ?>,

Admin created account in <?= $sitename ?>. Please found user details below.

Username : <?= $user->username ?>

Password : <?= $password ?>

Click on the link below to confirm you email before login.

<?php echo $url; ?>


Thanks,<

The <?= $sitename ?> Team.