<?php
    require '../configuration/check_session.php';
    require './check_admin.php';
?>

<!DOCTYPE html>
<html lang = 'en'>

<?php
    include '../configuration/head_style.php';
?>

<body>
    <?php
        $query = 'SELECT * FROM user ORDER BY lastname;';
        $params = null;
        $param_types = 's';
        /* The result of the query is stored in res. */
        $res;

        require '../configuration/database_handler.php';

        if(!(empty($rows))){
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
            foreach($rows as $row){
                printf('
                <tr>
                    <th>%s</th>
                    <th>%s</th>
                    <th>%s</th>
                    <th><button type=\'button\'>DELETE</button></th>
                    <th><button type=\'button\'>BAN</button></th>
                    <th><button type=\'button\'>UNBAN</button></th>
                </tr>', $row[1], $row[2], $row[0]); /* Array associativo? */
            }
            print('</table>');
        }
        print('<br>To return to the homepage: <a href = \'../../index.php\'>Homepage</a><br>');
    ?>
</body>
</html>