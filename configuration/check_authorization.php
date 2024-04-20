<?php
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    if(!isset($_SESSION['authentication']) && isset($_COOKIE['user_remember'])){
        /* User has already set the remember me option, let's check if it's true.
           Golden rule: NEVER trust users and their cookies. */
        $query       = 'SELECT * FROM user WHERE user.id_cookie=?;';
        $params      = array($_COOKIE['user_remember']);
        $param_types = 's';
        /* The result of the query is stored in rows. Since user.id_cookie is unique the result is supposed to be 0 or 1 row. */
        /* $res stores the result of the query called in database_handler.php */
        $res;

        require './database_handler.php';

        if(!(empty($res))){     
			/* The user exists in the database. */
			$user_email    = $res[0]; /* array associativo? */
			$user_name     = $res[1];
			$user_lastname = $res[2];
			$user_is_admin = $res[4];
            /* It can be NULL. */
			$user_expire   = $res[6];

            if(!empty($user_expire) && $user_expire > date('Y-m-d H:i:s')){
                $_SESSION['name']           = $user_name;
                $_SESSION['surname']        = $user_lastname;
                $_SESSION['email']          = $user_email;
                $_SESSION['authentication'] = 'true';
                /* A boolean TRUE value is converted to the string '1'. Boolean FALSE is converted to '' (the empty string). 
                This allows conversion back and forth between boolean and string values. Therefore boolean values are NOT
                reliable in PHP. */
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