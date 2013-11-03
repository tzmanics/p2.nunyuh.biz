<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        echo "This is the index page";
    }

    public function signup() {

        # set up view & title
        $this->template->content = View::instance('v_users_signup');
        $this->template->title = 'Sign Up';

        # render view
        echo $this->template;
    }

    public function p_signup() {

        # add time created 
        $_POST['created'] = Time::now();

        # encrypt password
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
        $_POST['token'] = sha1(TOKE_SALT.$_POST['email'].Utils::generate_random_string());

        # insert form data into table
        DB::instance(DB_NAME)->insert_row('users', $_POST);

        # send to login page
        Router::redirect('/users/login');
    }

    public function login($error = NULL) {

        # setup view & title
        $this->template->content = View::instance('v_users_login');
        $this->template->title = 'Log In';
        # pass data to view
        $this->template->content->error = $error;
        # render view
        echo $this->template;
    }

    public function p_login(){

        # sanatize user data
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # match password to encryption
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # search & match with database
        $q = 'SELECT token 
            FROM users
            WHERE email = "'.$_POST['email'].'"
            AND password = "'.$_POST['password'].'"';

        $token = DB::instance(DB_NAME)->select_field($q);

        # success: store cookie and send to landing page
        if($token) {

            setcookie('token', $token, strtotime('+2 weeks'), '/');
            Router::redirect("/users/profile/");
        }

        # fail: send back to login page
        else {
            Router::redirect("/users/login/error");
        }
    }

    public function logout() {
        # token for next login
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        # update to database
        $data = Array("token" => $new_token);
        DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

        # delete cookie and send to landing page
        setcookie("token", "", strtotime('-1 year'), '/');
        Router::redirect("/");
    }

    public function profile($user_name = NULL) {

        # not authemticated: redirect
        if(!$this->user){
            Router::redirect('/users/login');
        }

        # setup view
        $this->template->content = View::instance('v_users_profile');
        $this->template->title = $this->user->first_name."'s Profile";

        # add css and js docs
        #$client_files_head = Array('/css/profile.css','/css/master.css');
        #$client_files_body = Array('/js/profile.js');

        # pass the data to the view
        $this->template->content->user_name = $user_name;
        # disaply view
        

        #shorter  / DRY
        # $content = View::instnace('v_users_profile');
        # $content->user_name = $user_name;
        # $this->template-> = $content;

        # SQL query
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

        echo $this->template;
    }

} # end of the class