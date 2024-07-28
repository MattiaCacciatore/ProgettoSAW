<?php
    require dirname(__FILE__).'/../modules/start_session.php';

    if(!isset($_SESSION['authentication']) && isset($_COOKIE['remember_me'])){
        /* Golden rule: NEVER trust users and their cookies. */
        $query       = 'SELECT * 
                        FROM token t JOIN user u ON t.email_user = u.email
                        WHERE type = \'remember_me\' AND email_user = ?;';

        $params      = array($_COOKIE['remember_me']);

        $param_types = 's';

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

            if($res[0]['expire'] > date('Y-m-d H:i:s')){
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
