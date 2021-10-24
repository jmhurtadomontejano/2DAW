<?php
session_start(); //Permite utilizar variables de sesión

require 'modelos/ConexionBD.php';
require 'modelos/Articulo.php';
require 'modelos/Foto.php';
require 'modelos/Usuario.php';
require 'modelos/UsuarioDAO.php';
require 'modelos/MensajesFlash.php';
require 'modelos/Sesion.php';
require 'modelos/ArticuloDAO.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $articuloDAO = new ArticuloDAO(ConexionBD::conectar());
    $articulo = new Articulo();
    
    $articulo->setDescripcion($_POST['descripcion']);
    $articulo->setPrecio($_POST['precio']);
    $articulo->setTitulo($_POST['titulo']);
    $articulo->setId_usuario(Sesion::obtener());
    
    $articuloDAO->insert($articulo);
    
    MensajesFlash::anadir_mensaje("Se ha insertado el artículo");
    header("Location: index.php");
}
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="js/jQuery-TE_v.1.4.0/jquery-te-1.4.0.min.js"></script>
        <link href="js/jQuery-TE_v.1.4.0/jquery-te-1.4.0.css" rel="stylesheet" type="text/css">

        <script type="text/javascript">
            $(function () {
                $("#descripcion").jqte();
            });
        </script>
    </head>
    <body>
        <form action="" method="post">
            <input type="text" name="titulo" placeholder="Titulo..."><br>
            <textarea name="descripcion" id="descripcion" placeholder="Descripción..."></textarea><br>
            <input type="number" name="precio" placeholder="Precio..."><br>
            <input type="submit" value="Poner a la venta">
        </form>
    </body>
</html>
