<?php
session_start();

require 'modelos/ConexionBD.php';
require 'modelos/Articulo.php';
require 'modelos/ArticuloDAO.php';
require 'modelos/Foto.php';
require 'modelos/Usuario.php';
require 'modelos/UsuarioDAO.php';
require 'modelos/mensajesFlash.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    
    $articuloRegistro = new ArticuloDAO(ConexionBD::conectar());
    if($titulo =="" || $descripcion=="" || $precio==""){
        mensajesFlash::anadir_mensaje("Debes introducir todos los datos");
    } else{
        $articulo = new Articulo();
        $articulo->setTitulo($titulo);
        $articulo->setDescripcion($descripcion);
        $articulo->setPrecio($precio);
        $articulo->setId_usuario($id_usuario);
        $articuloRegistro->insert($articulo);
        
        header('Location:index.php');
    }
    
    
}

