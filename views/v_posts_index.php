<?php foreach($posts as $post): ?>

<article>
	<img src='/assets/img/default.jpg' alt='user avatar'>
	<h2><?=$post['first_name']?> <?=$post['last_name']?> posted:</h2>
	<time datetime="<?=Time::display($post['created'],'d M y G:i')?>">
		<?=Time::display($post['created'])?>
	</time>
	<p><?=$post['content']?></p>
</article>

<?php endforeach; ?>

<h2>Click <a href='/posts/users'>HERE</a> to follow more Users</h2>