<!-- User Profile Page: use avatar
	 Add Later: user info and contact -->


<!-- get and display user name -->
<h2>Hi <?=$user->first_name?>!</h2>
<div id='userAvatar'>
	<!-- display default avatar until user uploads -->
	<img src="/assets/img/default.jpg" alt="user avatar<p>">
	<!--<?php echo "<img id='image'src = '".AVATAR_PATH.$photo_link."' alt = 'User Photo'>"; ?>-->
	<form method='POST' enctype="multipart/form-data" action='/users/p_upload_photo/'>
                <div class = "">
                    Change Avatar
                    <input type='file' name='file'>
                    <input type='submit'>
                </div>
    </form>
</div>
