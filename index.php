<<<<<<< HEAD
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
=======
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Yadda Yadda Yadda &#153</title>
    </head>
    <body>
        <p>Yadda Yadda Yadda &#153</p>
        <?php
            session_start();
            require_once './controller/Controller.inc.php'; // domainmodel

            $controller = new Controller($_GET, $_POST);
            $controller->action();
        ?>
    </body>
</html>
>>>>>>> 90a934d4923f028940c5c96220e5a966d445a8a6
