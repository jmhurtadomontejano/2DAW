<?php
session_start(); //Permite utilizar variables de session

require 'modelos/ConexionBD.php';
require 'modelos/Articulo.php';
require 'modelos/Foto.php';
require 'modelos/Usuario.php';
require 'modelos/UsuarioDAO.php';
require 'modelos/MensajesFlash.php';
require 'modelos/Session.php';


$error = false;
$email = '';
$password = '';

if (isset($_GET['e']) && $_GET['e'] == 1) {
    $error = 'Usuario o password incorrectos';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Introduce tus datos de Login</title>
        <style>
            input {
                box-sizing: border-box;
                padding: 5px;
                margin: 10px;
                width: 100%;
            }
            .formulario{       
                box-sizing: border-box;
                display: block;
                justify-content: center;
                display: table;
                text-align: center;
                width: 90%;
            }
            .formulario p{
                text-align: left;
                margin-bottom: 0px;
            }

            .botones{
                display: flex;
                justify-content: space-around;

            }

        </style>
    </head>
    <body>
        <header>
           <?php if (Session::existe()): ?>
                <?php 
                    $usuDAO = new UsuarioDAO(ConexionBD::conectar());
                    $usuario = $usuDAO->find(Sesion::obtener());
                ?>
            <div id="usuario"> 
                <img src="imagenes/<?= $usuario->getFoto() ?>" style="border: 1px solid black; height: 80px; width: 80px; border-radius: 100px">
                <?= $usuario->getNombre() ?><br>
                <a href="logout.php">cerrar sesión</a>
            </div>
            
            <?php else: ?><!-- si la sesion no existe, muestro el formulario -->
                <div class="formulario">
                    <h2>Introduce tus datos de Logueo</h2>
                    <form class="formulario"id="login" action="login.php" method="post">
                        <div id="error_login"><?= $error ?></div>
                        <p>Introduce tu email:</p>
                        <input type="text" placeholder="email" name="email">
                        <p>Introduce tu contraseña</p>
                        <input type="password" placeholder="password" name="password">
                        <div class="botones">
                            <input type="submit" value="login">
                            <a href="registrar.php">registrar</a>
                        </div>
                    </form>
                <?php endif; ?> <!-- importante el endif para cerrar el else -->
            </div>
        </header>
        <main>
            <?php MensajesFlash::imprimir_mensajes(); ?>
        </main>
    </body>

</html>


