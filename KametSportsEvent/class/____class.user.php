<?php

include('class.password.php');


class User extends Password {

    private $db;
    private $db_connection = null;

    /**
     * @var int $user_id The user's id
     */
    private $user_id = null;

    /**
     * @var string $username The user's name
     */
    private $username = "";

    /**
     * @var string $user_email The user's mail
     */
    private $email = "";

    /**
     * @var boolean $user_is_logged_in The user's login status
     */
    private $user_is_logged_in = false;

    /**
     * @var string $user_gravatar_image_url The user's gravatar profile pic url (or a default one)
     */
    public $user_gravatar_image_url = "";

    /**
     * @var string $user_gravatar_image_tag The user's gravatar profile pic url with <img ... /> around
     */
    public $user_gravatar_image_tag = "";

    /**
     * @var boolean $password_reset_link_is_valid Marker for view handling
     */
    private $password_reset_link_is_valid = false;

    /**
     * @var boolean $password_reset_was_successful Marker for view handling
     */
    private $password_reset_was_successful = false;

    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();

    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();

    function __construct($db) {
        parent::__construct();
        $this->_db = $db;


        if (isset($_GET["logout"])) {
            $this->doLogout();

            // if user has an active session on the server
        } else if (!empty($_SESSION['user_data']->username) && ($_SESSION['user_data']->is_login == 1)) {
            $this->loginWithSessionData();

            // checking for form submit from editing screen
            // user try to change his username
            if (isset($_POST["user_edit_submit_name"])) {
                // function below uses use $_SESSION['user_id'] et $_SESSION['user_email']
                $this->editUserName($_POST['username']);
                // user try to change his email
            } elseif (isset($_POST["user_edit_submit_email"])) {
                // function below uses use $_SESSION['user_id'] et $_SESSION['user_email']
                $this->editUserEmail($_POST['email']);
                // user try to change his password
            } elseif (isset($_POST["user_edit_submit_password"])) {
                // function below uses $_SESSION['user_name'] and $_SESSION['user_id']
                $this->editUserPassword($_POST['user_password_old'], $_POST['user_password_new'], $_POST['user_password_repeat']);
            }

            // login with cookie
        } elseif (isset($_COOKIE['rememberme'])) {
            $this->loginWithCookieData();

            // if user just submitted a login form
        } else if (isset($_POST["login"])) {
            if (!isset($_POST['user_rememberme'])) {
                $_POST['user_rememberme'] = null;
            }
            $this->loginWithPostData($_POST['username'], $_POST['password'], $_POST['user_rememberme'], $_POST['captcha']);
        }

        // checking if user requested a password reset mail
        if (isset($_POST["request_password_reset"]) && isset($_POST['email'])) {
            $this->setPasswordResetDatabaseTokenAndSendMail($_POST['email']);
        } elseif (isset($_GET["email"]) && isset($_GET["verification_code"])) {
            $this->checkIfEmailVerificationCodeIsValid($_GET["email"], $_GET["verification_code"]);
        } elseif (isset($_POST["submit_new_password"])) {
            $this->editNewPassword($_POST['email'], $_POST['user_password_reset_hash'], $_POST['user_password_new'], $_POST['user_password_repeat']);
        }

        // get gravatar profile picture if user is logged in
        if ($this->isUserLoggedIn() == true) {
            $this->getGravatarImageUrl($this->email);
        }
    }

    public function isUserLoggedIn() {        
        if (isset($_SESSION['user_data']->is_login) && $_SESSION['user_data']->is_login == true) {
            echo $this->is_login;            
        }else {            
            echo false;
        }
    }

    private function get_user_hash($username) {

        try {
            $stmt = $this->_db->prepare('SELECT `password`,`FailedLoginAttempt`,`LastFailedLoginTime`,`memberID` FROM blog_members WHERE username = :username');
            $stmt->execute(array('username' => $username));
            $row = $stmt->fetch();
            return $row;
        } catch (PDOException $e) {
            echo '<p class="error">' . $e->getMessage() . '</p>';
        }
    }

    public function doLogout() {
        $this->deleteRememberMeCookie();

        $_SESSION['user_data'] = array();
        session_destroy();

        $this->is_login = false;
        $this->messages[] = MESSAGE_LOGGED_OUT;
    }

    public function login($username, $password, $Captcha) {
        $hashed = $this->get_user_hash($username, $Captcha);
        //if($this->password_verify($password,$hashed) == 1){
        if (strcmp(md5($password), $hashed['password']) == 0 && $hashed['FailedLoginAttempt'] < 4) {
            $stmt = $this->_db->prepare('UPDATE `blog_members` SET `LastLoginTime`= "' . time() . '",`FailedLoginAttempt` = 0,LastFailedLoginTime = "" WHERE username = "' . $username . '"');
            $stmt->execute();
            if (isset($Captcha) && $_SESSION['user_data']->captcha == $Captcha) {
                $_SESSION['user_data']->is_login = true;
                return array('ValidUser' => true, 'BlockedUser' => false, 'WrongCaptcha' => false, 'LastLoginTime' => time());
            } else {
                return array('ValidUser' => false, 'BlockedUser' => true, 'WrongCaptcha' => true);
            }
        } else {
            return array('ValidUser' => false, 'BlockedUser' => true, 'WrongCaptcha' => false);
        }
    }

    public function getUserData($username, $password, $captcha = null) {
        // if database connection opened
        $query_user = $this->_db->prepare('SELECT * FROM `blog_members` WHERE username = :username');
        $query_user->bindValue(':username', $username, PDO::PARAM_STR);
        $query_user->execute();
        // get result row (as an object)
        $result = $query_user->fetchObject();
        if (isset($captcha) && $captcha == $_SESSION['user_data']->captcha) {
            $result->captcha = 1;
            $result->show_captcha = 'No';
            return $result;
        } else if (isset($captcha) && $captcha != $_SESSION['user_data']->captcha) {
            $result->captcha = 1;
            $result->show_captcha = 'Yes';
            $this->errors[] = INVALID_CAPTCHA;
            return $result;
        } else {
            $result->captcha = 0;
            $result->show_captcha = 'No';
            return $result;
        }
    }

    public function loginWithSessionData() {
        $this->username = $_SESSION['user_data']->username;
        $this->email = $_SESSION['user_data']->email;
        $this->first_name = $_SESSION['user_data']->first_name;
        $this->last_name = $_SESSION['user_data']->last_name;
        $this->UserType = $_SESSION['user_data']->UserType;
        $this->user_id = $_SESSION['user_data']->user_id;
        $this->profile_pic = $_SESSION['user_data']->profile_pic;

        // set logged in status to true, because we just checked for this        
        // when we called this method (in the constructor)
        return $this->is_login = true;
    }

    public function loginWithPostData($username, $password, $user_rememberme, $captcha = null) {
        $this->errors['captcha'] == 1;

        if (empty($username)) {
            $this->errors[] = MESSAGE_USERNAME_EMPTY;
        } else if (empty($password)) {
            $this->errors[] = MESSAGE_PASSWORD_EMPTY;
            // if POST data (from login form) contains non-empty user_name and non-empty user_password
        } else {            // user can login with his username or his email address.            
            if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
                // database query, getting all the info of the selected user
                $result_row = $this->getUserData(trim($username), $password, $captcha);
                // if user has typed a valid email address, we try to identify him with his user_email
            } else if ($this->databaseConnection()) {
                // database query, getting all the info of the selected user
                $query_user = $this->db_connection->prepare('SELECT * FROM `blog_members` WHERE email = :email');
                $query_user->bindValue(':email', trim($email), PDO::PARAM_STR);
                $query_user->execute();
                // get result row (as an object)
                $result_row = $query_user->fetchObject();
            }

            if (!isset($result_row->user_id)) {
                // was MESSAGE_USER_DOES_NOT_EXIST before, but has changed to MESSAGE_LOGIN_FAILED
                // to prevent potential attackers showing if the user exists
                $this->errors['captcha'] = 1;
                $this->errors[] = MESSAGE_LOGIN_FAILED;
            } else if (($result_row->FailedLoginAttempt >= 3) && ($result_row->FailedLoginAttempt <= 5) && $result_row->captcha == 0 && $result_row->show_captcha == 'No') {
                $sth = $this->_db->prepare('UPDATE `blog_members` SET FailedLoginAttempt = FailedLoginAttempt+1, LastFailedLoginTime = :LastFailedLoginTime WHERE username = :username OR email = :username');
                $sth->execute(array(':username' => $username, ':LastFailedLoginTime' => time()));
                $this->errors['captcha'] = 0;
                //$this->errors[] = MESSAGE_PASSWORD_WRONG;
                $this->errors[] = MESSAGE_PASSWORD_WRONG_3_TIMES;
            } else if (($result_row->FailedLoginAttempt >= 5) && ($result_row->LastFailedLoginTime > (time() - 600)) == 1) {
                $this->errors[] = MESSAGE_PASSWORD_WRONG_5_TIMES;
                $this->errors['captcha'] = 1;
            } else if (strcmp(md5($password), $result_row->password) != 0) {
                // increment the failed login counter for that user
                $sth = $this->_db->prepare('UPDATE `blog_members` SET FailedLoginAttempt = FailedLoginAttempt+1, LastFailedLoginTime = :LastFailedLoginTime WHERE username = :username OR email = :username');
                $sth->execute(array(':username' => $username, ':LastFailedLoginTime' => time()));


                if ($result_row->FailedLoginAttempt >= 3) {
                    $this->errors['captcha'] = 0;
                    $this->errors[] = MESSAGE_PASSWORD_WRONG_3_TIMES;
                } else {
                    $this->errors[] = MESSAGE_PASSWORD_WRONG;
                    $this->errors['captcha'] = 1;
                }
                // has the user activated their account with the verification email
            } else if ($result_row->VerificationStatus != 'Yes') {
                $this->errors[] = MESSAGE_ACCOUNT_NOT_ACTIVATED;
                $this->errors['captcha'] = 1;
            } else {
                echo '<pre>';
                print_r($result_row);
                echo '</pre>';

                if ($result_row->captcha == 0 || $result_row->show_captcha != 'Yes') {
                    $this->errors['captcha'] = 1;
                    // write user data into PHP SESSION [a file on your server]
                    $_SESSION['user_data']->user_id = $result_row->user_id;
                    $_SESSION['user_data']->username = $result_row->username;
                    $_SESSION['user_data']->email = $result_row->email;
                    $_SESSION['user_data']->UserType = $result_row->UserType;
                    $_SESSION['user_data']->first_name = $result_row->first_name;
                    $_SESSION['user_data']->last_name = $result_row->last_name;
                    $_SESSION['user_data']->is_active = $result_row->is_active;
                    $_SESSION['user_data']->VerificationStatus = $result_row->VerificationStatus;
                    $_SESSION['user_data']->profile_pic = $result_row->profile_pic;
                    $_SESSION['user_data']->is_login = 1;

                    // declare user id, set the login status to true
                    $this->user_id = $result_row->user_id;
                    $this->username = $result_row->username;
                    $this->email = $result_row->email;
                    $this->is_login = true;

                    $sth = $this->_db->prepare('UPDATE `blog_members` SET FailedLoginAttempt = 0, LastFailedLoginTime = NULL WHERE user_id = :user_id AND FailedLoginAttempt != 0');
                    $sth->execute(array(':user_id' => $result_row->user_id));

                    // if user has check the "remember me" checkbox, then generate token and write cookie

                    if (isset($user_rememberme)) {
                        $this->newRememberMeCookie();
                    } else {
                        // Reset remember-me token
                        $this->deleteRememberMeCookie();
                    }
                    // by default the script will use a cost factor of 10 and never change it.
                    // check if the have defined a cost factor in config/hashing.php
                    if (defined('HASH_COST_FACTOR')) {
                        // check if the hash needs to be rehashed
                        if (password_needs_rehash($result_row->user_password_hash, PASSWORD_DEFAULT, array('cost' => HASH_COST_FACTOR))) {

                            // calculate new hash with new cost factor
                            $password_hash = password_hash($password, PASSWORD_DEFAULT, array('cost' => HASH_COST_FACTOR));

                            // TODO: this should be put into another method !?
                            $query_update = $this->_db->prepare('UPDATE `blog_members` SET user_password_hash = :user_password_hash WHERE user_id = :user_id');
                            $query_update->bindValue(':user_password_hash', $password_hash, PDO::PARAM_STR);
                            $query_update->bindValue(':user_id', $result_row->user_id, PDO::PARAM_INT);
                            $query_update->execute();

                            if ($query_update->rowCount() == 0) {
                                // writing new hash was successful. you should now output this to the user ;)
                            } else {
                                // writing new hash was NOT successful. you should now output this to the user ;)
                            }
                        }
                    }
                } else {
                    $this->errors['captcha'] = 0;
                }
            }
        }
    }

    public function loginWithCookieData() {
        if (isset($_COOKIE['rememberme'])) {
            // extract data from the cookie
            list($user_id, $token, $hash) = explode(':', $_COOKIE['rememberme']);
            // check cookie hash validity
            if ($hash == hash('sha256', $user_id . ':' . $token . COOKIE_SECRET_KEY) && !empty($token)) {
                // cookie looks good, try to select corresponding user                
                // get real token from database (and all other data)
                $sth = $this->_db->prepare("SELECT user_id, username, email, UserType FROM `blog_members` WHERE user_id = :user_id AND user_rememberme_token = :user_rememberme_token AND user_rememberme_token IS NOT NULL");
                $sth->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                $sth->bindValue(':user_rememberme_token', $token, PDO::PARAM_STR);
                $sth->execute();
                // get result row (as an object)
                $result_row = $sth->fetchObject();

                if (isset($result_row->user_id)) {
                    // write user data into PHP SESSION [a file on your server]
                    $_SESSION['user_data']->user_id = $result_row->user_id;
                    $_SESSION['user_data']->username = $result_row->username;
                    $_SESSION['user_data']->email = $result_row->email;
                    $_SESSION['user_data']->UserType = $result_row->UserType;
                    $_SESSION['user_data']->is_login = 1;
                    $_SESSION['user_data']->profile_pic = $result_row->profile_pic;
                    // declare user id, set the login status to true
                    $this->user_id = $result_row->user_id;
                    $this->username = $result_row->username;
                    $this->email = $result_row->email;
                    $this->is_login = true;
                    // Cookie token usable only once
                    $this->newRememberMeCookie();
                    return true;
                }
            }
            // A cookie has been used but is not valid... we delete it
            $this->deleteRememberMeCookie();
            $this->errors[] = MESSAGE_COOKIE_INVALID;
        }
        return false;
    }

    public function newRememberMeCookie() {
        // if database connection opened
        if ($this->databaseConnection()) {
            // generate 64 char random string and store it in current user data
            $random_token_string = hash('sha256', mt_rand());
            $sth = $this->_db->prepare("UPDATE `blog_members` SET RememberMeToken = :RememberMeToken WHERE user_id = :user_id");
            $sth->execute(array(':RememberMeToken' => $random_token_string, ':user_id' => $_SESSION['user_data']->user_id));

            // generate cookie string that consists of userid, randomstring and combined hash of both
            $cookie_string_first_part = $_SESSION['user_data']->user_id . ':' . $random_token_string;
            $cookie_string_hash = hash('sha256', $cookie_string_first_part . COOKIE_SECRET_KEY);
            $cookie_string = $cookie_string_first_part . ':' . $cookie_string_hash;

            // set cookie
            setcookie('rememberme', $cookie_string, time() + COOKIE_RUNTIME, "/", COOKIE_DOMAIN);
        }
    }

    /**
     * Delete all data needed for remember me cookie connection on client and server side
     */
    public function deleteRememberMeCookie() {
        // if database connection opened
        // Reset rememberme token
        $sth = $this->_db->prepare("UPDATE `blog_members` SET RememberMeToken = NULL WHERE user_id = :user_id");
        $sth->execute(array(':user_id' => $_SESSION['user_data']->user_id));


        // set the rememberme-cookie to ten years ago (3600sec * 365 days * 10).
        // that's obivously the best practice to kill a cookie via php
        // @see http://stackoverflow.com/a/686166/1114320
        setcookie('rememberme', false, time() - (3600 * 3650), '/', COOKIE_DOMAIN);
    }

    public function logout() {
        $this->deleteRememberMeCookie();

        $_SESSION['user_data'] = array();
        session_destroy();

        $this->is_login = false;
        $this->messages[] = MESSAGE_LOGGED_OUT;
    }

    public function getGravatarImageUrl($email, $s = 50, $d = 'mm', $r = 'g', $atts = array()) {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r&f=y";

        // the image url (on gravatarr servers), will return in something like
        // http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=80&d=mm&r=g
        // note: the url does NOT have something like .jpg
        $this->user_gravatar_image_url = $url;
        // build img tag around
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val)
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';

        // the image url like above but with an additional <img src .. /> around
        $this->user_gravatar_image_tag = $url;
    }

}

?>