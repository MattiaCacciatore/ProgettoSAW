<?php
    require dirname(__FILE__).'/../modules/start_session.php';

    if(!isset($_SESSION['authentication']) && isset($_COOKIE['remember_me'])){
        /* Golden rule: NEVER trust users and their cookies. */
        $query       = 'SELECT * 
                        FROM token t JOIN user u ON t.email_user = u.email
                        WHERE value = ?';

        $params      = array(hash('sha512', $_COOKIE['remember_me']));

        $param_types = 's';

        $res;

        require dirname(__FILE__).'/database_connect.php';
        require dirname(__FILE__).'/database_query.php';
        require dirname(__FILE__).'/database_disconnect.php';

        if(!(empty($res))){

            if($res[0]['expire'] > date('Y-m-d H:i:s')){

                $_SESSION['name']           = $res[0]['firstname'];
				$_SESSION['surname']        = $res[0]['lastname'];
				$_SESSION['email']          = $res[0]['email'];
				$_SESSION['authentication'] = 1;
				/*  Boolean values aren't reliable in PHP. */
				if($res[0]['is_admin'] == 1)
					$_SESSION['admin'] = 1;
				else
					$_SESSION['admin'] = 0;
            }
        }
    }
?>
