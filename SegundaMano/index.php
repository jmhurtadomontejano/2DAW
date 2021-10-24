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

$conn = ConexionBD::conectar();

$articuloDAO = new ArticuloDAO($conn);
$articulos = $articuloDAO->findAll('DESC');
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <script src="https://use.fontawesome.com/2a534a9a61.js"></script>
        <style type="text/css">
            header{
                overflow: auto;
            }
            #usuario,#login{
                width: 300px;
                float: right;
            }
            #login input{
                margin-top: 3px;
            }
            #titulo{
                margin-right: 300px;
                text-align: center;
            }
            .boton_formulario{
                border:1px solid black;
                box-sizing: border-box;
                display: inline-block;
                padding: 3px;
                background-color: #eee;
                text-decoration: none;
                color:black;

            }
            .fotos_articulo{
                height: 100px;
            }
            .articulo_listado{
                float: left;
                min-height: 200px;
                border: 1px solid black;
                margin: 5px;
                padding: 5px;
                position: relative;
                width: 150px;
            }
            .papelera{
                height: 20px;
                opacity: 0.5;
            }
            .papelera:hover{
                opacity: 1;
            }
            .borrar_articulo{
                position: absolute;
                bottom:5px;
                right:5px;
                width: 20px;
                height: 20px;
            }
            main{
                overflow: auto;
            }
            .precio_articulo{

                font-weight: bold;
                color:#f00;
                width: 100px;
                padding: 3px;
                text-align: center;
                margin: auto;
                font-family: verdana;
            }
            .contactar{
                font-size: 1em;
                font-weight: bold;
                color:#00f;
                border: 1px solid black;
                width: 120px;
                padding: 3px;
                border-radius: 50px;
                text-align: center;
                margin: 5px auto;   
                font-family: verdana;
            }
            .contactar:hover{
                background-color: #aaa;
                cursor: pointer;
                transition: 0.5s all;
                width: 130px;
            }
            menu{
                overflow: auto;
                border-bottom: 1px solid black;
                border-top: 1px solid black;
                margin: 0px 5px;
                padding: 0px;
            }
            ul#menu_usuario{
                margin: 0px;
                padding: 0px;
            }
            ul#menu_usuario li{
                margin: 0px;
                padding: 5px;
                list-style-type: none;
                float: left;
                border: 1px solid white;
                cursor: pointer;
                background-color: #eee;
            }
            ul#menu_usuario li:hover{
                background-color: #aaa;
            }
            ul#menu_usuario li a{
                text-decoration: none;
                color:black;
                cursor: pointer;
            }

        </style>
    </head>
    <body>
        <header>
            <?php if (Sesion::existe()): ?>
                <?php
                $usuDAO = new UsuarioDAO($conn);
                $usuario = $usuDAO->find(Sesion::obtener());
                ?>
                <div id="usuario"> 
                    <img src="imagenes/<?= $usuario->getFoto() ?>" style="border: 1px solid black; height: 80px; width: 80px; border-radius: 100px">
                    <?= $usuario->getNombre() ?> ( <a href="logout.php">cerrar sesión</a> )
                </div>
            <?php else: ?>
                <form id="login" action="login.php" method="post">
                    <input type="text" placeholder="email" name="email">
                    <input type="password" placeholder="password" name="password"><br>
                    <input type="submit" value="login" class="boton_formulario">
                    <input type="button" onclick="location.href = 'registrar.php'" value="registrar" class="boton_formulario">
                </form>
            <?php endif; ?>
            <div id="titulo">
                <h1>Segunda Mano</h1>
            </div>            
        </header>
        <menu>
            <ul id="menu_usuario">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="anadir_articulo.php">Poner artículo a la venta</a></li>
                <li><a href="mis_articulos.php">Mis artículos</a></li>
                <li><a href="mensajes.php">Mensajes</a></li>
            </ul>
        </menu>
        <main>
            <?php MensajesFlash::imprimir_mensajes(); ?>

            <?php foreach ($articulos as $a): ?>
                <div class="articulo_listado">
                    <div class="titulo_articulo"><?= $a->getTitulo() ?></div>
                    <img class="fotos_articulo" src="imagenes/articulo_generico.jpg">
                    <div class="descripcion_articulo"><?= substr($a->getDescripcion(), 0, 20) . "..." ?></div>
                    <div class="precio_articulo"><?= $a->getPrecio() ?> €</div>
                    <div class="contactar">CONTACTAR</div>
                    <div class="fecha_articulo"><?= $a->getFecha() ?></div>
                    <?= $a->getId_usuario(); ?>
                    <?php if ($a->getId_usuario() == Sesion::obtener()): ?>
                        <div class="borrar_articulo"><a href="borrar.php?id=<?= $a->getId() ?>"><img src="iconos/trash.svg" class="papelera"></a></div>
                            <?php endif; ?>

                </div>
            <?php endforeach; ?>
        </main>
    </body>
</html>
