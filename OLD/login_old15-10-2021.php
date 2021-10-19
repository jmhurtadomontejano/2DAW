<?php

require 'modelos/ConexionBD.php';
require 'modelos/Articulo.php';
require 'modelos/Foto.php';
require 'modelos/Usuario.php';
require 'modelos/UsuarioDAO.php';
require 'modelos/Session.php';

//Obtengo el usuario, si no existe vuelvo a index con un parámetro de error
$usuDAO = new UsuarioDAO(ConexionBD::conectar());
if (!$usuario = $usuDAO->findByEmail($_POST['email'])) {
    //Usuario no encontrado envio a index el valor e=1;
    header('Location: index.php?e=1');
    die();
}
//Compruebo la contraseña, si no existe vuelvo a index con un parámetro de error
if (!password_verify($_POST['password'], $usuario->getPassword())) {
    //password incorrecto
    header('Location: index.php?e=1');
    die();
}
//Usuario y password correctos, redirijo al listado de anuncios
//$_SESSION['id_usuario'] = $usuario->getID();
Session::iniciar($usuario->getId());
header("Location: index.php");
//header("Location: listado_anuncios.php")
die();
