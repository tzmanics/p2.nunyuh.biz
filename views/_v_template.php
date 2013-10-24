<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<link href='http://fonts.googleapis.com/css?family=Anton|Roboto+Slab' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/master.css">
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>
<header>
<nav>
	<ul>
		<li>Topic 1</li>
		<li>Topic 2</li>
		<li>Topic 3</li>
		<li>Welcome, <?php if($user) {echo $user->first_name;
			} else {echo '<a href="/users/login">Log in?</a>';}?></li>
	</ul>
</nav>
</header>

<body>	

	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>

</body>
</html>