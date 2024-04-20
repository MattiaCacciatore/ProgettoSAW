<?php
    if(isset($_POST['remember']) && $_POST['remember'] === 'yes'){
        $cookie_name = 'user_remember';
        /* Generate random token. */
        $value = random_bytes(512);
        $value = base64_encode($value); /* MANDATORY. */
        $expire_date = new DateTime(date('Y-m-d H:i:s'));
        try{
            date_modify($expire_date, '+30 day');
        }
        catch(DateMalformedStringException $e){
            $error = sprintf('%s - date_modify(): %s\n', date('Y-m-d H:i:s'), $e->getMessage());
            error_log($error, 3, '../../../errors/errors.log');
            exit('<br>ERROR: Couldn\'t set the remember me.');
        }
        $expire = date_format($expire_date, 'Y-m-d H:i:s');
        $query = 'UPDATE user SET user.id_cookie = ?, user.expire = ? WHERE user.email=?;';
        /* Note: $user_email is checked in login.php. */
        $params = array($value, $expire, $user_email);
        /* 'sss' means that all 3 params are bounded as strings. */
        $param_types = 'sss';
        /* $res stores the result of the query called in database_handler.php */
        $res;
        
        require dirname(__FILE__).'/ProgettoSAW/configuration/database_handler.php';

        $expire = time() + (60*60*24*30);
        if(!setcookie($cookie_name, $value, $expire, '/', '', false, true))){
            exit('Couldn\'t set the persistent cookie.');
        }
    }
    /* Redirect to the homepage. */
    header('Location: ../index.php');
?>