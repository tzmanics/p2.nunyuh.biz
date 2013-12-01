<div id="welcome">
<h1> Welcome to Caring Coders! </h1>
<p> We are here to help...</p>
<br>
<h2>This is my first step in developing a forum for people to unabashedly ask beginner's or easy questions and get answers.
	My plan is to add more function to each post that lets users tag thier questions.
	I also plan to add a function to let other users reply to the questions.</h2><br>
<h2>For now my +1 features are the option to upload an avatar and delete a post</h2><br>
<h1>Thanks for stopping by!</h1>
</div>

<div class='allPosts'>
	<?php foreach($posts as $post): ?>

		<article>
			<?= "<img src='/assets/img/avatars/".$post['avatar']."' alt='user profile picture'>"; ?>
			<h2><?=$post['first_name']?> <?=$post['last_name']?> posted:</h2>
			<time datetime="<?=Time::display($post['created'],'d M y G:i')?>">
				<?=Time::display($post['created'])?>
			</time>
			<p><?=$post['content']?></p>
		</article>
		
	<?php endforeach; ?>

</div>