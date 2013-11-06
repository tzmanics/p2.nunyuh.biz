
<h2>Sign up & Join the Fun!</h2>
 <div id='error'><h3><?php if ($email_exists) echo 'We already gots that email.<br>'; 
 						   if ($invalid_email) echo "That ain't not no email.<br>"; 
						   if ($empty_field) echo 'Mmmmm something is missing...'; ?>        
 </h3></div>
<form method='POST' action='/users/p_signup'>

	First Name <input type='text' name='first_name'><br><br>
	Last Name <input type='text' name='last_name'><br><br>
	Email <input type='text' name='email'><br><br>
	Password <input type='password' name='password'><br><br>

	<input type='submit' value='Sign Up'>
	<input type='hidden' name='timezone'>

	<script>
    $('input[name=timezone]').val(jstz.determine().name());
	</script>

</form>