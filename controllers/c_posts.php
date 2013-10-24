<?php 
class posts_controller extends base_controller {
	public function __construct(){
		parent::__construct();
	
		# make sure user is logged in to post
		if(!$this->user){
			die("Members Only..Please <a href ='/users/login'>Login</a>");
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
				posts .*,
				users.first_name,
				users.last_name
			FROM posts
			INNER JOIN users
				ON posts.user_id = users.user_id";

		# run query
		$posts = DB::instance(DB_NAME)->select_row($q);

		# pass data to view
		$this->template->content->posts = $posts;

		# render view
		echo $this->template;
	}

}


