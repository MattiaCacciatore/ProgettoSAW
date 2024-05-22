<?php 
    require dirname(__FILE__).'/start_session.php';

    if(!isset($_SESSION['cookies_banner_agreement'])){
        print('
        <input type = "radio" id = "hide" value = "non_accettato">
        <label for = "hide">Chiudi</label>

        <section class = "hideable-content">
            <p> Noi e terze parti utilizziamo i cookies o
            tecnologie simili per finalità tecniche e, con il tuo consenso, anche
            per altre finalità come specificato nella
            <a href = \'./info/cookies_policy.html\'>Cookie policy</a>.
            <br>
            Selezionando ”OK”, acconsenti alla memorizzazione dei cookies di
            profilazione e di marketing sul tuo dispositivo al fine di permetterci di
            offrirti una esperienza di navigazione del sito migliore e maggiormante
            mirata alle tue esigenze, analizzarne l\'utilizzo e migliorare le attività 
            di marketing. Sono esclusi da questo consenso i cookie tecnici necessari 
            per il corretto funzionamento del sito. Seleziona il seguente link per
            poter personalizzare la scelta: <a href = \'#\'>Scopri di più e personalizza</a>.
            </p>

            <form form action = \'./configuration/setcookies.php\' method = \'post\'>
                <input type = "radio" id = "accetta" name = "accettazione" value = "Sì">
                <label for = "accetta">ACCETTA</label>

                <input type = "radio" id = "rifiuta" name = "accettazione" value = "No">
                <label for = "rifiuta">RIFIUTA</label>

                <input type = "submit" name = "cookie_agreement" value = "OK">
            </form>
        </section>
        <br>
        '
        );
    }
?>