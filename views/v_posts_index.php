<h1>Click <a href='/posts/users'>HERE</a> to follow more Users</h1>

<?php foreach($posts as $post): ?>

<article>
	<h2><?=$post['first_name']?> <?=$post['last_name']?> posted:</h2>
	<p><?=$post['content']?></p>
	<time datetime="<?=Time::display($post['created'],'d M y G:i')?>">
		<?=Time::display($post['created'])?>
	</time>
</article>

<?php endforeach; ?>