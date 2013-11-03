<?php 
class posts_controller extends base_controller {

	public function __construct(){
		parent::__construct();
	
		# make sure user is logged in to post
		if(!$this->user){
			Router::redirect("/users/login");
		}
	}

	public function add() {
		# setup view & title
		$this->template->content = View::instance('v_posts_add');
		$this->template->title = "New Post";

		#render view
		echo $this->template;
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
		echo "Your post has been added. <a href='/posts/add'>Add another</a>";
	}

	public function index(){
		# set up view and title
		$this->template->content = View::instance('v_posts_index');
		$this->template->title = "Posts";

		# SQL query
		$q = "SELECT 
				posts.content,
				posts.created,
				posts.user_id AS post_user_id,
				users_users.user_id AS follower_id,
				users.first_name,
				users.last_name
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

		# render view
		echo $this->template;
	}

	public function users() {
		# set view & title
		$this->template->content = View::instance("v_posts_users");
		$this->template->title = "Users";

		# query to get all users
		$q = "SELECT * FROM users";

		# get all users store array in $users
		$users = DB::instance(DB_NAME)->select_rows($q);

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
		Router::redirect("/posts/users");
	}

	public function unfollow($user_id_followed){
		# delete the connection
		$where_condition = 'WHERE user_id = '.$this->user->user_id.' 
							AND user_id_followed = '.$user_id_followed;
		DB::instance(DB_NAME)->delete('users_users', $where_condition);

		# send user back
		Router::redirect("/posts/users");
	}

	public function deletePost($delete_post_id){
		# delete the post
		$deletePost = 'WHERE post_id = '.$delete_post_id;
		DB::instance(DB_NAME)->delete('posts', $deletePost);
		Router::redirect("/users/profile");

	}
}



