<h4>Hai <?= $user->first_name ?> <?= $user->last_name ?>,</h4>

<p>Admin created account in <?= $sitename ?>. Please found user details below.</p>

<b>Username : </b> <?= $user->username ?>
<br>
<b>Password : </b> <?= $password ?>

<p>Click on the link below to confirm you email before login.</p>

<p><a href="<?php echo $url; ?>">Confirm you email.</a></p>

<br>
<b>Thanks,</b>
</br>
<br>The <?= $sitename ?> Team.</b>