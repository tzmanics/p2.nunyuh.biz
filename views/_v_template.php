<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<link rel="stylesheet" type="text/css" href="/css/master.css">
	<script src="/js/jquery.js"></script>
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>
<header>
	<div id="logo"><h2><a href="/index"><img src="https://dl.dropboxusercontent.com/u/3061181/caringCodersLogo.png"></a></h2></div>
	<nav>
		<ul>
			<li><?php if($user) {echo "<li class='userMenu'><a href='#'>
					<img src='https://dl.dropboxusercontent.com/u/3061181/dropdownArrow.png'>
					</a><ul><li><a href='/users/profile'>PROFILE</a></li>
					<li><a href='/posts/users'>FOLLOWING</a></li>
					<li><a href='/users/logout'>LOG OUT</a></li></ul>
					</li><li>Hi, ".$user->first_name;
				} else {echo '<a href="/users/login">Log in?</a>';}?></li>
			<li><a href="/posts">READ</a></li>
			<li><a href="/posts/add">POST</a></li>
			<!---->
			
		</ul>
	</nav>
</header>

<body>	

	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
	<script type"text/javascript" src="/js/js.js"></script>
</body>
</html>