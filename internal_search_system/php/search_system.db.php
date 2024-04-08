<?php


include_once '../../configuration/databaseHandler.php';





    $query = "SELECT * FROM courses";

    // Preparazione  ed esecuzione della query
        $stmt = $pdo->prepare($query); 

        $stmt->execute();

    /* Recupero della riga risultante come un array associativo*/
        $result = $stmt->fetch(PDO::FETCH_ASSOC);


    // Recupero dei dati come array associativo
    $results = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $results[] = $row;
    }

    // Conversione dei dati in JSON
    $json_data = json_encode($results);

    // Scrittura del JSON su file (nota se non esiste crea in automatico il file)
    file_put_contents("../js/courses.json", $json_data);



    /* ammesso e non concesso che tutto sia corretto, lo script prende le singole righe come array associativo chiave - valore
    le quali vengono automaticamente formattate per generare il file json. Quest'ultimo viene riscritto ogni volta*/




/* COME MAI NON CICLA ONGI 30 MIN? 

questo script deve funzionare indipendentemente dalla pagina in cui si trova l'utente pertanto:
dovremmo  di crere un Job direttamente attraverso su xampp, questo permette di avere sempre il file courses.json aggiornato
e inoltre il lavoro di chiamare lo script è gestito direttamente dall'host. La potremmo fare da noi, ma è comunque codice in più che è fine a se stesso
siccome non può essere eseguito come semplice ciclo while con un if interno. 

come si crea il job:

Ecco come fare:

1. Aprire XAMPP Control Panel:

    - Avvia XAMPP.
    - Clicca su "Apri XAMPP Control Panel".


2. Accedere alla scheda "Servizi":

    - Clicca sulla scheda "Servizi".
    - Trova il servizio "Cron".
    - Clicca sul pulsante "Configura".
3. Aggiungere il tuo job:

*Nella finestra di configurazione di Cron, clicca sul pulsante "Aggiungi".
Inserisci i seguenti dati:
    Minuto: 0,30
    Ora: *
    Giorno del mese: *
    Mese: *
    Giorno della settimana: *
    Comando: php /path/to/your/script.php
    Clicca sul pulsante "OK".


4. Salvare e attivare il servizio:

Clicca sul pulsante "Salva".
Clicca sul pulsante "Avvia" per avviare il servizio Cron.
In questo modo, il tuo script PHP verrà eseguito ogni 30 minuti.*/

    
    








?>