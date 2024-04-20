<?php
    require dirname(__FILE__).'/ProgettoSAW/configuration/check_session.php';
    require dirname(__FILE__).'/ProgettoSAW/admin_area/check_admin.php';
?>

<!DOCTYPE html>
<html lang = 'en'>

<head>
    <?php include dirname(__FILE__).'/ProgettoSAW/configuration/head_style.php'; ?>
</head>

<body>
    <?php
        $query = 'SELECT * FROM user ORDER BY lastname;';
        $params = null;
        /* 's' means that the param is bounded as a string. */
        $param_types = 's';
        /* The result of the query is stored in res. */
        $res;

        require dirname(__FILE__).'/ProgettoSAW/configuration/database_handler.php';

        if(!(empty($res))){
            print('
            <table>
                <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Delete</th>
                    <th>Ban</th>
                    <th>Unban</th>
                </tr>');
            foreach($res as $row){
                printf('
                <tr>
                    <th>%s</th>
                    <th>%s</th>
                    <th>%s</th>
                    <th><button type=\'button\'>DELETE</button></th>
                    <th><button type=\'button\'>BAN</button></th>
                    <th><button type=\'button\'>UNBAN</button></th>
                </tr>', $row['firstname'], $row['lastname'], $row['email']); /* Array associativo? */
            }
            print('</table>');
        }
        print('<br>To return to the homepage: <a href = \'../../index.php\'>Homepage</a><br>');
    ?>
</body>
</html>