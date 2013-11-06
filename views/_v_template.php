<!-- Main Template Page: header/nav, links to content files -->

<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<link rel="stylesheet" type="text/css" href="/assets/css/master.css">
	<script src="/assets/js/jquery.js"></script>
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>
<body>
<header>
	<nav>
	<h1> <a href='/index'>CARING<img src='/assets/img/bitHeart.png' alt='8bit heart'>CODERS</a></h1>
		<ul>
			<!-- regular navigation + user menu nav-->
			<li><?php if($user) {echo "<li class='userMenu'><a href='#'>
					<img src='https://dl.dropboxusercontent.com/u/3061181/dropdownArrow.png'>
					</a><ul><li><a href='/users/profile'>PROFILE</a></li>
					<li><a href='/posts/myPosts'>MY POSTS</a></li>
					<li><a href='/users/logout'>LOG OUT</a></li></ul></li>

					<li><a href ='/users/profile'>Hi, ".$user->first_name;
				} else {echo '<a href="/users/login">Log in?</a>';}?></li>
			<li><a href="/posts">FOLLOW</a></li>
			<li><a href="/posts/add">POST</a></li>
			<!---->
			
		</ul>
	</nav>
</header>
	<!-- grab content from other PHP files -->
	<div class='content'>
		<?php if(isset($content)) echo $content; ?>
		<?php if(isset($client_files_body)) echo $client_files_body; ?>
	</div>
	<script type"text/javascript" src="/assets/js/js.js"></script>
</body>
</html>