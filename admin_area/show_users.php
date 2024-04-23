<?php
    require dirname(__FILE__).'/../configuration/check_session.php';
    require dirname(__FILE__).'/check_admin.php';
?>

<!DOCTYPE html>
<html lang = 'it'>

<head>
    <?php include dirname(__FILE__).'/../modules/head_style.php'; ?>
    <title>Lista utenti</title>
</head>

<body>
    <?php
        require dirname(__FILE__).'/../modules/navbar.php';

        $query = 'SELECT * FROM user ORDER BY lastname;';
        $params = null;
        $param_types = null;
        $res;

        require dirname(__FILE__).'/../configuration/database_connect.php';
        require dirname(__FILE__).'/../configuration/database_query.php';
        require dirname(__FILE__).'/../configuration/database_disconnect.php';

        if(!(empty($res))){
            print('
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Indirizzo email</th>
                    <th>Elimina</th>
                    <th>Banna</th>
                    <th>Sbanna</th>
                    <th>Concedi permessi</th>
                </tr>');
            foreach($res as $row){
                printf('
                <tr>
                    <th>%s</th>
                    <th>%s</th>
                    <th>%s</th>
                    <th><button type=\'button\'>ELIMINA</button></th>
                    <th><button type=\'button\'>BANNA</button></th>
                    <th><button type=\'button\'>SBANNA</button></th>
                    <th><button type=\'button\'>CONCEDI PERMESSI DA AMMINISTRATORE</button></th>
                </tr>', $row['firstname'], $row['lastname'], $row['email']);
            }
            print('</table>');
        }
    ?>
</body>
</html>