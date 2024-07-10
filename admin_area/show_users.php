<?php
    require dirname(__FILE__).'/../configuration/check_session.php';
    require dirname(__FILE__).'/check_admin.php';
?>

<!DOCTYPE html>
<html lang = 'it'>

<head>
    <?php 
        include dirname(__FILE__).'/../modules/head_style.php'; 
    ?>
    
    <link rel = 'stylesheet' href = 'css/show-users.css'>

    <title>
        Lista utenti
    </title>

</head>

<body>

    <?php
        require dirname(__FILE__).'/../modules/header.php';

        $query = 'SELECT * FROM user ORDER BY lastname;';

        $params = null;
        
        $param_types = null;
        /* $res registra il risultato dell'interrogazione. */
        $res;

        require dirname(__FILE__).'/../configuration/database_connect.php';
        require dirname(__FILE__).'/../configuration/database_query.php';
        require dirname(__FILE__).'/../configuration/database_disconnect.php';

        if(!(empty($res))){
            print('
            <div class = \'table\'>
            <form action = \'update_users.php\' method = \'post\' class = \'table\'>
                <table class = \'table\'>
                    <tr class = \'index-line\'>
                        <th class = \'index-element\'>Nome</th>
                        <th class = \'index-element\'>Cognome</th>
                        <th class = \'index-element\'>Indirizzo email</th>
                        <th class = \'index-element\'>Elimina</th>
                        <th class = \'index-element\'>Banna</th>
                        <th class = \'index-element\'>Sbanna</th>
                        <th class = \'index-element\'>Concedi permessi</th>
                    </tr>');
            foreach($res as $row){
                printf('
                    <tr>
                        <th>%s</th>
                        <th>%s</th>
                        <th>%s</th>
                        <th>
                            <button type = \'submit\' name = \'delete\' value = \''.$row['email'].'\' > 
                                ELIMINA                            
                            </button>
                        </th>
                        <th>
                            <button type = \'submit\' name = \'ban\'    value = \''.$row['email'].'\' > 
                                BANNA                              
                            </button>
                        </th>
                        <th>
                            <button type = \'submit\' name = \'unban\'  value = \''.$row['email'].'\' > 
                                SBANNA                             
                            </button>
                        </th>
                        <th>
                            <button type = \'submit\' name = \'grant\'  value = \''.$row['email'].'\' > 
                                CONCEDI PERMESSI DA AMMINISTRATORE 
                            </button>
                        </th>
                    </tr>', $row['firstname'], $row['lastname'], $row['email']);
            }
            print('
                </table>
            </form>
            </div>
            ');
        }
    ?>
    
</body>
</html>