<?php
require 'modelos/Articulo.php';
require 'modelos/ConexionBD.php';
require 'modelos/Foto.php';
require 'modelos/Usuario.php';
require 'modelos/UsuarioDAO.php';
require 'modelos/MensajesFlash.php';
require 'modelos/Session.php';

session_start();

//if(!isset($_SESSION['id_usuario'])){ //aqui comprobaba contra variable
if(Session::existe()){ //aqui compruebo contra metodo de la clase Session
    MensajesFlash::anadir_mensaje("La página que intentas acceder es privada, no se puede acceder sin id");
    header('Location: index.php');
    die();
    
}


$usuDAO = new UsuarioDAO(ConexionBD::conectar());
$usuarios = $usuDAO->findAll();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="https://use.fontawesome.com/2a534a9a61.js"></script>
        <style type="text/css">

        </style>
    </head>
    <body>
        <header>
            <div class="container">
                <form id="anuncios" action="" method="post">
                    <h1>Listado de usuarios</h1>
                    <table >
                        <?php foreach ($usuarios as $user): ?>
                        <tr>
                            <td>Id:</td><td><?= $user->getId() ?></td>
                            <td>Usuario:</td><td><?= $user->getNombre() ?></td>
                            <td>Email:</td><td><?= $user->getEmail() ?></td>
                            <td>Password:</td><td><?= $user->getPassword() ?></td>
                            <td><a href="$usuDAO->delete(<?= $user->getId()?>)"><i class="icono-color fa fa-trash" aria-hidden="true"></i></a></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </form>
                <form action="index.php"><input style="margin-top: 2%; margin-bottom: 2%" type="submit" name="volver" value="Volver al Login"></form>
            </div>
        </header>
        <main>
            <a href="logout.php">cerrar sesión</a>
        </main>
    </body>
</html>
