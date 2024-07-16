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

        $query       = 'SELECT email, firstname, lastname, is_banned, is_admin
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
                print('
                    <tr>
                        <th>'.$row['firstname'].'</th>
                        <th>'.$row['lastname'].'</th>
                        <th>'.$row['email'].'</th>
                        <th>
                            <button type = \'submit\' name = \'delete\' value = \''.$row['email'].'\' > 
                                ELIMINA                            
                            </button>
                        </th>
                        <th>
                            <button type = \'submit\''
                );
                            
                if($res['is_banned'] == 1){
                    print('
                            name = \'unban\'    value = \''.$row['email'].'\' > 
                                SBANNA
                    '); 
                }
                else{
                    print('
                            name = \'ban\'    value = \''.$row['email'].'\' > 
                                BANNA
                    ');
                }
                
                print('                             
                            </button>
                        </th>
                        <th>
                            <button type = \'submit\''
                );
                
                if($res['is_admin'] == 1){
                    print('
                            name = \'revoke\'  value = \''.$row['email'].'\' > 
                                REVOCA
                    ');
                }
                else{
                    print('
                            name = \'grant\'  value = \''.$row['email'].'\' > 
                                CONCEDI
                    ');
                }

                printf('
                            </button>
                        </th>
                    </tr>'
                );
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