<?php
session_start();

require 'modelos/ConexionBD.php';
require 'modelos/Articulo.php';
require 'modelos/Foto.php';
require 'modelos/Usuario.php';
require 'modelos/UsuarioDAO.php';
require 'modelos/Session.php';
require 'modelos/MensajesFlash.php';

//Obtendo el usuario, si no existe vuelvo a index con un parámetro de error
$usuDAO = new UsuarioDAO(ConexionBD::conectar());
if (!$usuario = $usuDAO->findByEmail($_POST['email'])) {    
    //Usuario no encontrado
    MensajesFlash::anadir_mensaje("Usuario o password incorrectos. email");
    header('Location: index.php');
    die();
}
//Compruebo la contraseña, si no existe vuelvo a index con un parámetro de error
if (!password_verify($_POST['password'], $usuario->getPassword())) {
    //password incorrecto
    MensajesFlash::anadir_mensaje("Usuario o password incorrectos. pass");
    header('Location: index.php');
    die();
}
//Usuario y password correctos, redirijo al listado de anuncios
Session::iniciar($usuario->getId());
header("Location: index.php");
die();
