<?php foreach($users as $user): ?>

	<!-- print user name -->
	<?=$user['first_name']?> <?=$user['last_name']?>

	<!-- if connection exists show 'unfollow' option -->
	<?php if(isset($connections[$user['user_id']])): ?>
		<a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>

	<!-- else show 'follow' option -->
	<?php else: ?>
		<a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
	<?php endif; ?>

	<br><br>
<?php endforeach; ?>
