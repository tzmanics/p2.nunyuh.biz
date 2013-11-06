<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function index() {
    }

    public function signup($email_exists = NULL, $invalid_email = NULL,  $empty_field = NULL) {

        # set up view & title
        $this->template->content = View::instance('v_users_signup');
        $this->template->title = 'Sign Up';
        $this->template->content->email_exists = $email_exists;
        $this->template->content->invalid_email = $invalid_email;
        $this->template->content->empty_field = $empty_field;

        # render view
        echo $this->template;
    }

    # user sign up
    public function p_signup() {
        $input_check = array();

        # check for email duplicates
        $email_exists = DB::instance(DB_NAME)->select_field("SELECT email FROM users WHERE email = '".$_POST['email']."'");
        if ($email_exists)
            $email_exists = true;

        # check for a valid email
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            $invalid_email = true;      
        else $invalid_email = false;

        # check for empty fields
        $empty_field = false;
        if(empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['password']) || empty($_POST['email']))
                $empty_field = true;


        # add time created 
        $_POST['created'] = Time::now();

        # encrypt password
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

        if (!$email_exists && !$invalid_email && !$empty_field)
        {
            # insert form data into table
            DB::instance(DB_NAME)->insert_row('users', $_POST);
            $token = $_POST['token'];
            setcookie('token', $token, strtotime('+2 week'), '/');
            # send to login page
            Router::redirect('/users/profile');
        }

        else
            # show what errors occured
            $this->signup($email_exists, $invalid_email, $empty_field);
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
            Router::redirect("/index");
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
        $q = "SELECT avatar 
              FROM users
              WHERE users.user_id = ".$this->user->user_id;

        $avatar = DB::instance(DB_NAME)->select_field($q);

        # pass the data to the view
        $this->template->content->avatar = $avatar;
        
        # disaply view
        echo $this->template;
    }

    # personalized avatars
    public function p_avatarUpload(){
         if ($_FILES["file"]["error"] == 0)
        {
            
            # upload the user-chosen file and save to img file
            $avatar = Upload::upload($_FILES, "/assets/img/avatars/", array("jpg", "JPG", "jpeg", "JPEG", "gif", "GIF", "png", "PNG"), $this->user->user_id);

            # notify of error 
            if($avatar == 'Invalid file type.') {
                Router::redirect("/users/avatarError");
            }
            else {
                # add to DB                
                $data = Array("avatar" => $avatar);
                DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = ".$this->user->user_id);

                # resize the avatar and save again
                $imgObj = new Image($_SERVER["DOCUMENT_ROOT"].'/assets/img/avatars/'.$avatar);
                $imgObj->resize(100,100,"crop");
                $imgObj->save_image($_SERVER["DOCUMENT_ROOT"].'/assets/img/avatars/'.$avatar);
            }
        }
        else
        {
                # if there is an error let it be known
                Router::redirect("/users/avatarError"); 
        }
        # send user back to profile
        Router::redirect("/users/profile");
    }

    # page to notify user of avatar upload image
    public function avatarError(){
        # setup view & title
        $this->template->content = View::instance('v_users_avatarError');
        $this->template->title = 'Whoopsies!';

        # render view
        echo $this->template;

    }

} # end of the class