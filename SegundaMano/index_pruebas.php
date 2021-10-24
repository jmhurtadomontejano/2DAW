<?php
require 'modelos/ConexionBD.php';
require 'modelos/Articulo.php';
require 'modelos/Foto.php';
require 'modelos/Usuario.php';
require 'modelos/UsuarioDAO.php';

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $usuDAO = new UsuarioDAO(ConexionBD::conectar());
        if ($usuario = $usuDAO->find(3)) {
            print "Se ha obtenido el usuario con el nombre: " . $usuario->getNombre() . "<br>";
        } else {
            print "No se ha encontrado el usuario 1<br>";
        }
        $usuarios = $usuDAO->findAll();
        print "Se han obtenido todos los usuarios:<br>";
        foreach ($usuarios as $u) {
            print "Usuario: " . $u->getNombre() . "<br>";
        }
        /*if ($usuDAO->delete($usuario)) {
            print "Se ha borrado el usuario<br>";
        } else {
            print "No se ha encontrado el usuario y no se ha podido borrar<br>";
        }*/
        $usuario_nuevo = new Usuario();
        $usuario_nuevo->setEmail('pedro@gmail.com');
        $usuario_nuevo->setPassword(password_hash('1234',PASSWORD_BCRYPT));
        $usuario_nuevo->setNombre('Pedro');
        $usuario_nuevo->setFoto('foto.jpg');
        $usuDAO->insert($usuario_nuevo);
        
        //Update
        $usuario_modificado = $usuDAO->find(5);
        $usuario_modificado->setEmail("NuevoEmail@gmail.com");
        $usuDAO->update($usuario_modificado);
        $usuario_modificado = $usuDAO->find(5);
        print "Se ha modificado el usuario con email " . $usuario_modificado->getEmail();
        
        ?>
    </body>
</html>
