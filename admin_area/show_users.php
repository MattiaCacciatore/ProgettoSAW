<?php
    require dirname(__FILE__).'/../configuration/check_session.php';
    require dirname(__FILE__).'/check_admin.php';
?>

<!DOCTYPE html>
<html lang = 'en'>

<head>
    <?php include dirname(__FILE__).'/../modules/head_style.php'; ?>
</head>

<body>
    <?php
        $query = 'SELECT * FROM user ORDER BY lastname;';
        $params = array("null");
        /* 's' means that the param is bounded as a string. */
        $param_types = 's';
        /* The result of the query is stored in res. */
        $res;

        require dirname(__FILE__).'/../configuration/database_connect.php';
        require dirname(__FILE__).'/../configuration/database_query.php';
        require dirname(__FILE__).'/../configuration/database_disconnect.php';

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
                    <th>Grant Privilegies</th>
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
                    <th><button type=\'button\'>GRANT ADMIN PRIVILEGES</button></th>
                </tr>', $row['firstname'], $row['lastname'], $row['email']); /* Array associativo? */
            }
            print('</table>');
        }
        print('<br>To return to the homepage: <a href = \'../../index.php\'>Homepage</a><br>');
    ?>
</body>
</html>