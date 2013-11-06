<!-- User Profile Page: use avatar
	 Add Later: user info and contact -->


<!-- get and display user name -->
<h1>Hi <?=$user->first_name?>!</h1>
<div id='userAvatar'>
	<!-- display default avatar until user uploads -->
	<?= "<img src='/assets/img/avatars/".$avatar."'>"; ?>
	<form method='POST' enctype="multipart/form-data" action='/users/p_avatarUpload/'>
                <div>
                    Change Avatar?
                    <input type='file' name='file'>
                    <input type='submit'>
                </div>
    </form>
</div>
