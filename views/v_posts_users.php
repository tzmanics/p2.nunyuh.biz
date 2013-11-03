<div id='following'>
	<h1> Users You Follow</h1>
	<?php foreach($users as $user): ?>

		<?php if(isset($connections[$user['user_id']])): ?>

		<!-- print user name -->
		<?=$user['first_name']?> <?=$user['last_name']?>

		<!-- if connection exists show 'unfollow' option -->
		<a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>

		<?php else: ?>
		<?php endif; ?>

		<br><br>
	<?php endforeach; ?>
</div>

<div id='notFollowing'>
	<h1>Other Users</h1>
	<?php foreach($users as $user): ?>

		<!-- if connection exists show 'unfollow' option -->
		<?php if(!isset($connections[$user['user_id']])): ?>

		<!-- print user name -->
		<?=$user['first_name']?> <?=$user['last_name']?>

		<!-- else show 'follow' option -->
		<a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>

		<?php endif; ?>

		<br><br>
	<?php endforeach; ?>
</div>
