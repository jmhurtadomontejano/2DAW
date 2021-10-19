<?php
session_start(); //Permite utilizar variables de sesión

require 'modelos/ConexionBD.php';
require 'modelos/Articulo.php';
require 'modelos/Foto.php';
require 'modelos/Usuario.php';
require 'modelos/UsuarioDAO.php';
require 'modelos/MensajesFlash.php';
require 'modelos/Session.php';
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            input {
                box-sizing: border-box;
                padding: 5px;
                margin: 10px;
                width: 90%;
            }
            .formulario{       
                box-sizing: border-box;
                display: block;
                justify-content: center;
                display: table;

                width: 90%;
            }

            .formulario h2{
                justify-content: center;
            }
            .formulario p{
                text-align: left;
                margin-bottom: 0px;
            }

            .botones{
                display: flex;
                justify-content: space-around;
            }
            .MensajesFlash{
                font-size: 50px;
                color: red;
                border-box: 1px black;
                justify-content: center;
            }



        </style>
    </head>
    <body>
        <header>
            <?php if (Session::existe()): ?>
                <?php
                $usuDAO = new UsuarioDAO(ConexionBD::conectar());
                $usuario = $usuDAO->find(Session::obtener());
                ?>
                <div id="usuario"> 
                    <img src="imagenes/<?= $usuario->getFoto() ?>" style="border: 1px solid black; height: 80px; width: 80px; border-radius: 100px">
                    <?= $usuario->getNombre() ?><br>
                    <a href="logout.php">cerrar sesión</a>
                </div>
            <?php else: ?>
                <form id="login" action="login.php" method="post">
                    <h2>Introduce tus Datos de Loguin</h2>
                    <input type="text" placeholder="email" name="email">
                    <input type="password" placeholder="password" name="password">
                    <input type="submit" value="login">
                    <a href="registrar.php">registrar</a>
                </form>
            <?php endif; ?>
        </header>
        <main>
            <div class="MensajesFlash" >
                <?php MensajesFlash::imprimir_mensajes(); ?>
            </div><!--Cierre div MensajesFlash  -->
        </main>
    </body>
</html>
