<h2>Hi <?=$user->first_name?>!</h2>
<div id='userAvatar'>
	<a href'#'><img src='/assets/img/default.jpg' alt='user avatar'></a>
	<br><h3><a href='#'>Click to Change Picture</a></h3>
</div>
<div id='usersPosts'>
	<h1>YOUR POSTS</h1>
	<?php foreach($posts as $post): ?>
		<article>
			<p><?=$post['content']?></p>
			<time datetime="<?=Time::display($post['created'],'d M y G:i')?>">
				<?=Time::display($post['created'])?>
			</time>
			<br><br><a href='/posts/deletePost/<?=$post['post_id']?>'>DELETE</a>
		</article>


	<?php endforeach; ?>
	<h2>Click <a href='/posts/add'>HERE</a> to add more Posts</h2>
</div>