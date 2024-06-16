<?php
    require dirname(__FILE__).'/../modules/start_session.php';

    if(!isset($_SESSION['authentication']) && isset($_COOKIE['user_remember'])){
        /* User has already set the remember me option, let's check if it's true.
           Golden rule: NEVER trust users and their cookies. */
        $query       = 'SELECT * FROM user WHERE user.id_cookie=?;';
        $params      = array($_COOKIE['user_remember']);
        /* 's' means that the param is bounded as a string. */
        $param_types = 's';
        /* $res stores the result of the query called in database_handler.php */
        $res;

        require dirname(__FILE__).'/database_connect.php';
        require dirname(__FILE__).'/database_query.php';
        require dirname(__FILE__).'/database_disconnect.php';

        if(!(empty($res))){     
			/* The user exists in the database. */
            $user_email    = $res['email'];
			$user_name     = $res['firstname'];
			$user_lastname = $res['lastname'];
			$user_is_admin = $res['is_admin'];
            $user_expire   = $res['expire']; // Missing?

            if(!empty($user_expire) && $user_expire > date('Y-m-d H:i:s')){
                $_SESSION['name']           = $user_name;
                $_SESSION['surname']        = $user_lastname;
                $_SESSION['email']          = $user_email;
                $_SESSION['authentication'] = 'true';
                /* 
                    A boolean TRUE value is converted to the string '1'. Boolean FALSE is converted 
                    to '' (the empty string). This allows conversion back and forth between boolean 
                    and string values. Therefore boolean values are NOT reliable in PHP. 
                */
                if($user_is_admin == 1){
                    $_SESSION['admin'] = 'true';
                }
                else{
                    $_SESSION['admin'] = 'false';
                }
                
                $_SESSION['authentication'] = 'true'; /* Mandatory. */
            }
        }
    }
?>