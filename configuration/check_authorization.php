<?php
    require dirname(__FILE__).'/../modules/start_session.php';

    if(!isset($_SESSION['authentication']) && isset($_COOKIE['user_remember'])){
        /* L'utente ha già selezionato l'opzione di remember_me, si controlla se è vero.
           Regola aurea: MAI fidarsi degli utenti e dei loro cookies. */
        $query       = 'SELECT * FROM user WHERE user.id_cookie=?;';
        $params      = array($_COOKIE['user_remember']);
        /* 's' significa che il parametro è di tipo stringa. */
        $param_types = 's';
        /* $res registra il risultato dell'interrogazione al database. */
        $res;

        require dirname(__FILE__).'/database_connect.php';
        require dirname(__FILE__).'/database_query.php';
        require dirname(__FILE__).'/database_disconnect.php';

        if(!(empty($res))){     
			/* L'utente esiste nel database. */
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
					Il valore di un booleano TRUE viene convertito nella stringa '1', un booleano FALSE
					nella stringa vuota. Questo permette la conversione implicita tra valori booleani e
					stringhe, percui i valori booleani non sono affidabili in PHP.
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