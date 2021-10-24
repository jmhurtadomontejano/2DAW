<?php
session_start();

require 'modelos/ConexionBD.php';
require 'modelos/Articulo.php';
require 'modelos/ArticuloDAO.php';
require 'modelos/Foto.php';
require 'modelos/Usuario.php';
require 'modelos/UsuarioDAO.php';
require 'modelos/mensajesFlash.php';

$error = false;

$nombre = '';
$email = '';
$password = '';
$passwordRep = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Cuando se envíe el formulario entramos aquí
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRep = $_POST['passwordRep'];

    $usuDAO = new UsuarioDAO(ConexionBD::conectar());
    if ($nombre == "" || $email == "" || $password == "" || $passwordRep =="") {
        $error = true;
        $errores = "Debes introducir todos los datos.";
        mensajesFlash::anadir_mensaje("Debes introducir todos los datos");
    } else {
        if ($password == $passwordRep) {
            $usuario_nuevo = new Usuario();
            $usuario_nuevo->setEmail($email);
            $usuario_nuevo->setPassword(password_hash($password, PASSWORD_BCRYPT));
            $usuario_nuevo->setNombre($nombre);
            $usuario_nuevo->setFoto('foto.jpg');
            $usuDAO->insert($usuario_nuevo);
            header('Location: index.php');
        } else {
            $error = true;
            $errores = "Las Contraseñas no coinciden.";
            mensajesFlash::anadir_mensaje("Las Contraseñas no coinciden.");
        }
    }
    printf($errores);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    
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
    <body>
        <?php mensajesFlash::imprimir_mensajes() ?>
        <form action="" method="post" class="formulario">
            <h2>Introduce tus datos de Registro</h2>
            <p>Introduce tu nombre:</p>
            <input type="text" name="nombre" placeholder="Nombre">
            <p>Introduce tu email:</p>
            <input type="email" name="email" placeholder="Email">
            <p>Introduce tu contraseña:</p>
            <input type="password" name="password" placeholder="Password">
            <input type="password" name="passwordRep" placeholder="Repite Password">
            <div class="botones">
            <input type="submit" value="registrar">
            <input type="button" value="volver" onclick="location.href='index.php'">
            </div>
        </form>
    </body>
</html>
