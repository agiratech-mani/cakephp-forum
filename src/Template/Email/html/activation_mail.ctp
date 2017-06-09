
<h4>Hai <?= $user->first_name ?> <?= $user->last_name ?>,</h4>

<p>Please confirm your email address by clicking the link below.</p>

<p><a href="<?php echo $url; ?>">Click here to Confirm Email Address</a></p>
<pre>or Visit this Link</pre>
<p><a href=""><?php echo $url; ?></a></p>
<br>
<b>Thanks,</b>
</br>
<br>The <?= $sitename ?> Team.</b>