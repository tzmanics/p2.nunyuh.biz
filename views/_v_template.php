<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<link rel="stylesheet" type="text/css" href="/css/master.css">
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>
<header>
	<div id="logo"><h2><a href="/index"><img src="https://dl.dropboxusercontent.com/u/3061181/caringCodersLogo.png"></a></h2></div>
	<nav>
		<ul>
			<li>Hi, <?php if($user) {echo $user->first_name;
				} else {echo '<a href="/users/login">Log in?</a>';}?></li>
			<li><a href="/posts/add">Ask</a></li>
			<li><a href="/posts/posts">Read</a></li>
			<li><a href="/users/profile">Profile</a></li>
			
		</ul>
	</nav>
</header>

<body>	

	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>

</body>
</html>