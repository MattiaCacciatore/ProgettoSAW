<?php
    require dirname(__FILE__).'/../modules/start_session.php';
    /* Remember me cookies. */
    if(isset($_POST['remember'])){

        $cookie_name = 'user_remember';
        /* Genera un token casuale. */
        $value = random_bytes(512);
        $value = base64_encode($value); /* OBBLIGATORIO. */
        $expire_date = new DateTime(date('Y-m-d H:i:s'));

        try{
            date_modify($expire_date, '+30 day');
        }
        catch(DateMalformedStringException $e){
            $error = sprintf('%s - date_modify(): %s\n', date('Y-m-d H:i:s'), $e->getMessage());
            error_log($error, 3, dirname(__FILE__).'/../../../errors/errors.log');
            exit('HTTP 500 Internal Server Error');
        }

        $expire = date_format($expire_date, 'Y-m-d H:i:s');
        
        $query = 'UPDATE user SET user.id_cookie = ?, user.expire = ? WHERE user.email=?;';
        /* Nota: $user_email è già controllata in login.php. */
        $params = array($value, $expire, $user_email);
        /* 'sss' significa che tutti i parametri sono di tipo stringa. */
        $param_types = 'sss';
        /* $res registra il risultato dell'interrogazione al database. */
        $res;
        
        require dirname(__FILE__).'/database_connect.php';
        require dirname(__FILE__).'/database_query.php';
        require dirname(__FILE__).'/database_disconnect.php';
        /* Scadenza cookie: 1 mese. */
        $expire = time() + (60*60*24*30);
        if(!setcookie($cookie_name, $value, $expire, '/', '', false, true)){
            exit('HTTP 500 Internal Server Error');
        }
    }
    else if(isset($_POST['cookie_agreement'])){ /* Banner cookies. */
        $cookie_consent = 'cookies_banner_agreement';
        /* Scadenza cookie: 6 mesi. */
        $expire = time() + (60*60*24*30*6);

        if($_POST['accettazione'] === 'Sì'){
            $cookie_profilazione = 'profilazione';
            $cookie_marketing    = 'marketing';
            
            if(!setcookie($cookie_profilazione, $_POST['profilazione'], $expire, '/', '', false, true) ||
                !setcookie($cookie_marketing, $_POST['marketing'], $expire, '/', '', false, true) ||
                !setcookie($cookie_consent, 'yes', $expire, '/', '', false, true)){
                exit('HTTP 500 Internal Server Error');
            }
        }
        else{
            if(!setcookie($cookie_consent, 'no', $expire, '/', '', false, true)){
                exit('HTTP 500 Internal Server Error');
            }
        }

        $_SESSION['cookies_banner_agreement'] = $_POST['accettazione'];
    }
    /* Reindirizzamento alla pagina principale. */
    header('Location: ../index.php');
?>