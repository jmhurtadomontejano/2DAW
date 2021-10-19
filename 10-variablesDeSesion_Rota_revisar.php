<?php
session_start();
?>

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
        if(!isset($variable_normal)){
            $variable_normal=0;
        }
        $variable_normal++;
        print "variable_normal tiene el valor de: $variable_normal";
        // put your code here
        ?>

        <?php
            if(!isset($_SESSION['variable'])){
               $_SESSION['variable'] = 0;
            }
            $_SESSION['variable']++;
             print "variable sesión tiene el valor de: $_SESSION[variable]";
        ?>
    </body>
</html>
