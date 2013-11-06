<!-- User Login Page: login form, link to sign up -->

<h1>LOG IN</h1>

	<!-- show if login error -->
	<?php if(isset($error)): ?>
		<div id='error'>
			Login failed. Please check your email and password.
		</div><br>
	<?php endif; ?>

	<form method='POST' action='/users/p_login'>

	Email: <input type = 'text' name='email'><br><br>
	Password: <input type = 'password' name='password'><br><br>

	<input type='Submit' value='Log In'>
	<input type='button' value='Sign Up!' onclick='location.href="/users/signup";'>

</form>