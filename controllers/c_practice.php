<?php
class practice_controller extends base_controller {

	
	public function test_db(){

/* INSERT PRACTICE
		$q = 'INSERT INTO users
		SET first_name = "Albert",
		last_name = "Einstein"';

		echo $q;

		DB::instance(DB_NAME)->query($q);


 UPDATE PRACTICE

		$q = 'UPDATE users
		SET email = "albert@aol.com"
		WHERE first_name = "Albert"';

		DB::instance(DB_NAME)->query($q);

		$q = 'DELETE FROM users
			WHERE email = "albert@aol.com"';

		echo DB::instance(DB_NAME)->query($q);

USING HELPER METHODS

		$new_user = Array
		(
			'first_name' => 'Albert',
			'last_name' => 'Einstein',
			'email' => 'albert@gmail.com');

		DB::instance(DB_NAME)->insert('users', $new_user);
	


USER INPUT SANITIZED
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		$q = 'SELECT email
			FROM users 
			WHERE first_name = "'._POST['first_name'].'"';

		echo DB::instance(DB_NAME)->select_field($q);

*/






	}


}