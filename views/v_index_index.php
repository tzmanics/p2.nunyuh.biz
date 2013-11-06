<div id="welcome">
<h1> Welcome to Caring Coders! </h1>
<p> We are here to help...</p>
</div>

<div class='allPosts'>
	<?php foreach($posts as $post): ?>

		<article>
			<?= "<img src='/assets/img/avatars/".$post['avatar']."'>"; ?>
			<h2><?=$post['first_name']?> <?=$post['last_name']?> posted:</h2>
			<time datetime="<?=Time::display($post['created'],'d M y G:i')?>">
				<?=Time::display($post['created'])?>
			</time>
			<p><?=$post['content']?></p>
		</article>
		
	<?php endforeach; ?>

</div>