<?php

class index_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	} 
		
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index() {


		
		# Any method that loads a view will commonly start with this
		# set up view and title
			$this->template->content = View::instance('v_index_index');
			$this->template->title = "Caring Coders";
	
		# CSS/JS includes
			/*
			$client_files_head = Array("");
	    	$this->template->client_files_head = Utils::load_client_files($client_files);
	    	
	    	$client_files_body = Array("");
	    	$this->template->client_files_body = Utils::load_client_files($client_files_body);   
	    	*/
	    # SQL query
		$q = "SELECT *
			  FROM posts
			  INNER JOIN users
			  	ON posts.user_id = users.user_id
			  ORDER BY posts.created";

		# run query
		$posts = DB::instance(DB_NAME)->select_rows($q);

		# pass data to view
		$this->template->content->posts = $posts;	

		# Render the view
			echo $this->template;

	} # End of method
	
	
} # End of class
