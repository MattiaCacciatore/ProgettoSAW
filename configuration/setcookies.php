<?php

    require dirname(__FILE__).'/check_session.php';

    $cookie_set  = false;
    $cookie_name = '';
    $val         = '';
    $value       = '';

    if(isset($_POST['remember_me'])){
        $cookie_name = 'remember_me';
        /* Random token. Note: hashing the token for database data breach protection. */
        $val         = base64_encode(random_bytes(512));
        $value       = hash('sha512', $val);
        $cookie_set  = true;
    }
    else if(isset($_POST['acceptance']) && $_POST['acceptance'] === 'yes'){
        $cookie_name                            = 'banner';
        $_SESSION[$cookie_name] = $val = $value = $_POST['acceptance'];
        $cookie_set                             = true;
    }
/* -------------------------------------------------------------------------------------------- */
    if($cookie_set){
        /* Note: 1 month. */
        $expire      = time() + (60*60*24*30);
        $expire_date = new DateTime(date('Y-m-d H:i:s'));

        if(!setcookie($cookie_name, $val, $expire, '/', '', false, true)){
            die('HTTP 500 Internal Server Error');
        }

        try{
            date_modify($expire_date, '+30 day');
        }
        catch(DateMalformedStringException $e){
            $error = sprintf('%s - date_modify(): %s\\n', date('Y-m-d H:i:s'), $e->getMessage());
            error_log($error, 3, dirname(__FILE__).'/../../../errors/errors.log');
            die('HTTP 500 Internal Server Error');
        }

        $expire      = date_format($expire_date, 'Y-m-d H:i:s');
        $query       = 'INSERT INTO token(value, type, expire, email_user) VALUES (?, ?, ?, ?);';
        $params      = array($value, $cookie_name, $expire, $_SESSION['email']);
        $param_types = 'ssss';
            
        require dirname(__FILE__).'/database_connect.php';
        require dirname(__FILE__).'/database_query.php';
        require dirname(__FILE__).'/database_disconnect.php';
    }

    header('Location: ../index.php');
?>