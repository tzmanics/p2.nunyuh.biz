<h1>LOG IN</h1>

	<form method='POST' action='/users/p_login'>

	Email: <input type = 'text' name='email'><br><br>
	Password: <input type = 'password' name='password'><br><br>

	<?php if(isset($error)): ?>
		<div class='error'>
			Login failed. Please check your email and password.
		</div><br>
	<?php endif; ?>

	<input type='Submit' value='Log In'>
	<input type='button' value='New User?' onclick='location.href="/users/signup";'>

</form>