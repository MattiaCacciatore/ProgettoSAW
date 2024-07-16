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

        $query       = 'SELECT * 
                        FROM user 
                        ORDER BY lastname;';

        $params      = null;
        
        $param_types = null;

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
                        <th class = \'index-element\'>Concedi permessi amministratore</th>
                    </tr>');
            foreach($res as $row){
                printf('
                    <tr>
                        <th>%s</th>
                        <th>%s</th>
                        <th>%s</th>
                        <th>
                            <button type = \'submit\' name = \'delete\' value = \''.$row[0]['email'].'\' > 
                                ELIMINA                            
                            </button>
                        </th>
                        <th>
                            <button type = \'submit\''
                );
                            
                if($res[0]['is_banned'] == 1){
                    printf('
                            name = \'unban\'    value = \''.$row[0]['email'].'\' > 
                                SBANNA
                    '); 
                }
                else{
                    printf('
                            name = \'ban\'    value = \''.$row[0]['email'].'\' > 
                                BANNA
                    ');
                }
                
                printf('                             
                            </button>
                        </th>
                        <th>
                            <button type = \'submit\''
                );
                
                if($res[0]['is_admin'] == 1){
                    printf('
                            name = \'revoke\'  value = \''.$row[0]['email'].'\' > 
                                REVOCA
                    ');
                }
                else{
                    printf('
                            name = \'grant\'  value = \''.$row[0]['email'].'\' > 
                                CONCEDI
                    ');
                }

                printf('
                            </button>
                        </th>
                    </tr>', $row[0]['firstname'], $row[0]['lastname'], $row[0]['email']);
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