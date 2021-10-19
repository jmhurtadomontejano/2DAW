<?php
require 'modelos/ConexionBD.php';
require 'modelos/Articulo.php';
require 'modelos/Foto.php';
require 'modelos/Usuario.php';
require 'modelos/UsuarioDAO.php';

$error='';

?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <header>
            <form id="login" action="login.php" method="post">
                <?= $error ?>
                <input type="text" placeholder="email" name="emai">
                <input type="password" placeholder="password" name="password">
                <input type="submit" value="login">
                <a href="registrar.php">registrar</a>
            </form>
        </header>
        <main>
            
        </main>
    </body>
</html>