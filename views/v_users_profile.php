<h1>Hi <?=$user->first_name?>!</h1>
<div id='usersPosts'>
	<h2>Your Posts</h2>
	<?php foreach($posts as $post): ?>
		<article>
			<p><?=$post['content']?></p>
			<time datetime="<?=Time::display($post['created'],'d M y G:i')?>">
				<?=Time::display($post['created'])?>
			</time>
			<br><br><a href='/posts/deletePost/<?=$post['post_id']?>'>DELETE</a>
		</article>


	<?php endforeach; ?>
</div>