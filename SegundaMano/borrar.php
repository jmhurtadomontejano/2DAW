<?php

session_start();
require 'modelos/ConexionBD.php';
require 'modelos/Articulo.php';
require 'modelos/Foto.php';
require 'modelos/Usuario.php';
require 'modelos/UsuarioDAO.php';
require 'modelos/MensajesFlash.php';
require 'modelos/Sesion.php';
require 'modelos/ArticuloDAO.php';


$articuloDAO = new ArticuloDAO(ConexionBD::conectar());
$articulo = $articuloDAO->find($_GET['id']);
//Comprobamos el el usuario es propietario del artículo

if ($articulo->getId_usuario() == Sesion::obtener()) {
    if ($articuloDAO->delete($articulo)) {
        MensajesFlash::anadir_mensaje("Articulo borrado");
    } else {
        MensajesFlash::anadir_mensaje("Articulo no encontrado");
    }
} else {
    MensajesFlash::anadir_mensaje("¡El artículo no es tuyo!");
}
header("Location: index.php");