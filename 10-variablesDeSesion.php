<?php
session_start();
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if (!isset($variable_normal)) {
            $variable_normal = 0;
        }
        $variable_normal++;
        print "variable_normal tiene el valor: $variable_normal<br>";
      
        if (!isset($_SESSION['variable'])) {
            $_SESSION['variable'] = 0;
        }
        $_SESSION['variable']++;
        print "variable de sesión tiene el valor:  $_SESSION[variable]";
        ?>
    </body>
</html>
