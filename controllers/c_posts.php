<?php 
class posts_controller extends base_controller {

	public function __construct(){
		parent::__construct();
	}

	public function add() {

		# make sure user is logged in to post
		if(!$this->user){
			Router::redirect("/users/login");
		} else {

			# setup view & title
			$this->template->content = View::instance('v_posts_add');
			$this->template->title = "New Post";

			# load js files
			$client_files_body = Array(
				"/assets/js/jquery.form.js",
				"/assets/js/posts_add.js"
			);

			$this->template->client_files_body = Utils::load_client_files($client_files_body);

			#render view
			echo $this->template;
			}
		}

	public function p_add(){
		# associate post with the user
		$_POST['user_id'] = $this->user->user_id;

		# unix timestamp for created & modified
		$_POST['created'] = Time::now();
		$_POST['modified'] = Time::now();

		# insert into db
		DB::instance(DB_NAME)->insert('posts', $_POST);

		# feedback
		echo "Your post was added";
	}

	public function index(){


		# make sure user is logged in to post
		if(!$this->user){
			Router::redirect("/users/login");
		} else {
			# set up view and title
			$this->template->content = View::instance('v_posts_index');
			$this->template->title = "Who You Follow";

			# SQL query
			$q = "SELECT 
					posts.content,
					posts.created,
					posts.user_id AS post_user_id,
					users_users.user_id AS follower_id,
					users.first_name,
					users.last_name,
					users.avatar
				FROM posts
				INNER JOIN users_users
					ON posts.user_id = users_users.user_id_followed
				INNER JOIN users
					ON posts.user_id = users.user_id
				WHERE users_users.user_id = ".$this->user->user_id;

		    # run query
			$posts = DB::instance(DB_NAME)->select_rows($q);

			# pass data to view
			$this->template->content->posts = $posts;

			$q = "SELECT * FROM users";

			# get all users store array in $users
			$users = DB::instance(DB_NAME)->select_rows($q);

			$q = "SELECT * 
				FROM users_users 
				WHERE user_id = ".$this->user->user_id;

			# get users followed store array in $connections 
			$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');


	        # pass the data to the view
			$this->template->content->users = $users;
		    $this->template->content->connections = $connections;

			# render view
			echo $this->template;
		}
	}

	public function users() {
		# set view & title
		$this->template->content = View::instance("v_posts_users");
		$this->template->title = "Users";

		# query to get all users
		$q = "SELECT * FROM users";

	

		# query to find who user following
		$q = "SELECT * 
			  FROM users_users 
			  WHERE user_id = ".$this->user->user_id;

		# get users followed store array in $connections
		$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

		# pass users and connections data to view
		$this->template->content->users = $users;
		$this->template->content->connections = $connections;

		# render view
		echo $this->template;

	}

	public function follow($user_id_followed){
		# prepare data array to be inserted
		$data = Array(
			"created" => Time::now(),
			"user_id" => $this->user->user_id,
			"user_id_followed" => $user_id_followed
			);

		# insert
		DB::instance(DB_NAME)->insert('users_users', $data);

		# send user back 
		Router::redirect("/posts");
	}

	public function unfollow($user_id_followed){
		# delete the connection
		$where_condition = 'WHERE user_id = '.$this->user->user_id.' 
							AND user_id_followed = '.$user_id_followed;
		DB::instance(DB_NAME)->delete('users_users', $where_condition);

		# send user back
		Router::redirect("/posts");
	}


	public function myPosts(){

        # setup view
        $this->template->content = View::instance('v_posts_myPosts');
        $this->template->title = $this->user->first_name."'s Posts";

        # pass the data to the view
        $this->template->content->user_name = $user_name;

        # SQL query of posts info
        $q = "SELECT 
                posts.content,
                posts.created,
                posts.post_id,
                posts.user_id
            FROM posts
            WHERE user_id = ".$this->user->user_id;

        # run query
        $posts = DB::instance(DB_NAME)->select_rows($q);

        # pass data to view
        $this->template->content->posts = $posts;

        # display view
        echo $this->template;
    }

	public function deletePost($delete_post_id){
		# delete the post
		$deletePost = 'WHERE post_id = '.$delete_post_id;
		DB::instance(DB_NAME)->delete('posts', $deletePost);
		Router::redirect("/users/profile");

	}

	public function control_panel() {

	    # Setup view
	        $this->template->content = View::instance('v_posts_control_panel');
	        $this->template->title   = "Control Panel";

	    # JavaScript files
	        $client_files_body = Array(
	            '/assets/js/jquery.form.js', 
	            '/assets/js/posts_control_panel.js');
	        $this->template->client_files_body = Utils::load_client_files($client_files_body);

	    # Render template
	        echo $this->template;
	}

	public function p_control_panel() {

	    $data = Array();

	    # Find out how many posts there are
	    $q = "SELECT count(post_id) FROM posts";
	    $data['post_count'] = DB::instance(DB_NAME)->select_field($q);

	    # Find out how many users there are
	    $q = "SELECT count(user_id) FROM users";
	    $data['user_count'] = DB::instance(DB_NAME)->select_field($q);

	    # Find out when the last post was created
	    $q = "SELECT created FROM posts ORDER BY created DESC LIMIT 1";
	    $data['most_recent_post'] = Time::display(DB::instance(DB_NAME)->select_field($q));

	    # Send back json results to the JS, formatted in json
	    echo json_encode($data);
	}
}



