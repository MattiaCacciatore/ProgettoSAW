
<?php


/*impostiamo:
*   - le sessioni possono essere trasmesse solo attraverso i cookie 
*   - le sessioni dovranno rispettare tutte le regole di restrizione*/

    ini_set('session.use_only_cookies', 1); 
    ini_set('session.use_strict_mode', 1);




session_set_cookie_params([
    'lifetime' => 18*3600,                   /* 18 ore */
    'domain' => 'saw21.dibris.unige.it',    /* il dominio in cui il  cookie e' valido */
    'path' => '/',                          /* valido su tutte le pagine del sito */
    'secure' => true,                       /* cookie trasmesso solo su connessioni https */
    'httponly' => true                      /* accessibile solo in http e non puo' essere modificato da js */

]);


/********************** sicurezza sui cookie ************************/

// il cookie id verra' rigenerato ogni 30 minuti in modo tale
// da evitare eventuali attacchi


    session_start();


// Check if session ID regeneration is required
if (!isset($_SESSION["last_regeneration"]) || time() - $_SESSION["last_regeneration"] >= 1800) {

    // Regenerate session ID
    session_regenerate_id(true); // True parameter destroys old session data


    // Update last regeneration timestamp
    $_SESSION["last_regeneration"] = time();
}

// Implement session timeout
    $session_timeout = 18*3600; // 18 ore

    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_timeout)) {

        // Expire session if inactive for too long
        session_unset();
        session_destroy();

        // Redirect to login page or display message
        header("Location: ../pages/login.php");
        exit;
    }

// Update last activity timestamp
$_SESSION['last_activity'] = time();










?>