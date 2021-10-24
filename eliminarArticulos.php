<?php
session_start();

require 'modelos/ConexionBD.php';
require 'modelos/Articulo.php';
require 'modelos/ArticuloDAO.php';
require 'modelos/Foto.php';
require 'modelos/Usuario.php';
require 'modelos/UsuarioDAO.php';
require 'modelos/mensajesFlash.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $id = $_GET['id'];
    
    $articuloRegistro = new ArticuloDAO(ConexionBD::conectar());
   
        $articulo = new Articulo();
        $articulo->setId($id);
        $articuloRegistro->delete($articulo);
        header('Location:index.php');
    
 
    
}

