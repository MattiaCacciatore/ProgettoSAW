<!DOCTYPE html>
<html lang="it">
<head>
    <title>Cookies</title>
    <style>
</head>
<body>
    <?php
    # Se esiste il cookie stampa il codice per gestire lo stile
    # echo "..." - cookie
    # un modo per gestire i cookie è usando la funzione php explode
    # oppure li si gestisce come stringa unica.

    /*
    # Output desiderato.

    body {
        color:#ffc4ea;
        background-color: #513ea8;
        font-family: serif;
    }
    */

    $value = "";

    # se impostato valore cookie del colore testo...
        # concatena colore desiderato a $value
    # altrimenti valore di default
    if(isset($_POST["color"]) & $_POST["color"] != "#0000000"){
        $value .= "color".$_POST["color"]."|";

    }
    else{ //default
        $value .= "color:black|";
    }

    # se impostato valore cookie del colore di background...
        # concatena colore desiderato a $value
    # altrimenti valore di default
    if(isset($_POST["background-color"]) & $_POST["background-color"] != "#0000000"){
        $value .= "background-color".$_POST["background-color"]."|";

    }
    else{ //default
        $value .= "background-color:white|";
    }

    # se impostato valore cookie del font...
        # concatena colore desiderato a $value
    # altrimenti valore di default
    if(isset($_POST["font-family"]) & $_POST["font-family"] != "0"){
        $value .= "font-family".$_POST["font-family"]."|";

    }
    else{ //default
        $value .= "font-family:serif|";
    }

    $name = "style";
    $expires = mktime(0,0,0,01,01,2023);
    # crea il cookie (nome, valore, scadenza)
    setcookie($name, $value, $expires);

    # redireziona su index.php
    header("Location: index.php");
    ?>
    </style>
</body>
</html>