<?php
    require dirname(__FILE__).'/../modules/start_session.php';

    if(!isset($_SESSION['authentication']) && isset($_COOKIE['user_remember'])){
        /* The user has already selected the remember_me option, checking if it is true.
           Golden rule: NEVER trust users and their cookies. */
        $query       = 'SELECT * FROM user WHERE user.id_cookie=?;';
        $params      = array($_COOKIE['user_remember']);
        /* 's' means that the parameter is of type string. */
        $param_types = 's';
        /* $res stores the result of the database query. */
        $res;

        require dirname(__FILE__).'/database_connect.php';
        require dirname(__FILE__).'/database_query.php';
        require dirname(__FILE__).'/database_disconnect.php';

        if(!(empty($res))){     
            /* The user exists in the database. */
            $user_email    = $res[0]['email'];
            $user_name     = $res[0]['firstname'];
            $user_lastname = $res[0]['lastname'];
            $user_is_admin = $res[0]['is_admin'];
            $user_expire   = $res[0]['expire'];

            if(!empty($user_expire) && $user_expire > date('Y-m-d H:i:s')){
                $_SESSION['name']           = $user_name;
                $_SESSION['surname']        = $user_lastname;
                $_SESSION['email']          = $user_email;
                $_SESSION['authentication'] = 'true';
                /* 
                    The value of a boolean TRUE is converted to the string '1', a boolean FALSE
                    to an empty string. This allows implicit conversion between boolean values and
                    strings, therefore boolean values are not reliable in PHP.
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
