<!-- User My Posts Page: all user's posts & delete option
						 + link to add posts
	 Add Later: Edit option -->


<div id='usersPosts'>
	<h1>YOUR POSTS</h1>
	<!-- display each posts from this user-->
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