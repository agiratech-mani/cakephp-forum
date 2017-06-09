<h4>Hai <?= $user->first_name ?> <?= $user->last_name ?>,</h4>

<p>Your username is <?php echo $user->username; ?></p>

<p>Click on the link below to Reset Your Password.</p>

<p><a href="<?php echo $url; ?>">Click here to Reset Your Password</a></p>
<pre>or Visit this Link</pre>
<p><a href=""><?php echo $url; ?></a></p>
<br>
<b>Thanks,</b>
</br>
<br>The <?= $sitename ?> Team.</b>