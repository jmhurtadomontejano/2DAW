<?php
session_start();

require 'modelos/ConexionBD.php';
require 'modelos/Articulo.php';
require 'modelos/Foto.php';
require 'modelos/Usuario.php';
require 'modelos/UsuarioDAO.php';
require 'modelos/MensajesFlash.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = new Usuario();
    $error = false;
    if (empty($_POST['email'])) {
        MensajesFlash::anadir_mensaje("El email es obligatorio.");
        $error = true;
    }
    if (empty($_POST['password'])) {
        MensajesFlash::anadir_mensaje("El password es obligatorio.");
        $error = true;
    }
    if (!$error) {
        $usuario->setEmail($_POST['email']);
        $usuario->setNombre($_POST['nombre']);
        $usuario->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));

        $usuDAO = new UsuarioDAO(ConexionBD::conectar());
        $usuDAO->insert($usuario);
        MensajesFlash::anadir_mensaje("Usuario creado.");
        header('Location: index.php');
        die();
    }
}
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php MensajesFlash::imprimir_mensajes() ?>
        <form action="" method="post">
            <input type="text" name="nombre" placeholder="Nombre"><br>
            <input type="email" name="email" placeholder="Email"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="submit" value="registrar">
            <input type="button" value="volver" onclick="location.href = 'index.php'">
        </form>
    </body>
</html>
