<!--Version buena, editada: 22/10/2021 -->
<?php
session_start(); //Permite utilizar variables de sesión

require 'modelos/ConexionBD.php';
require 'modelos/Articulo.php';
require 'modelos/ArticuloDAO.php';
require 'modelos/Foto.php';
require 'modelos/Usuario.php';
require 'modelos/UsuarioDAO.php';
require 'modelos/MensajesFlash.php';
require 'modelos/Session.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <script src="https://use.fontawesome.com/2a534a9a61.js"></script>
        <meta charset="UTF-8">
        <title></title>
        <style>
            header{
                border-bottom: 1px solid black;
                overflow: auto;
            }
            #usuario,#login{
                width: 300px;
                float: right;
            }
            #titulo{
                margin-right: 300px;
                text-align: center;
            }
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

            .usuario{
                font-size: 1.5em;
                text-align: right;
            }

            .articulo_listado{
                float: left;
                height: 200px;
                border: 1px solid black;
                margin: 5px;
                padding: 5px;
            }
            .tablaArticulos{
                display: inline-flex;
                border: 1px solid red;
                font-size: 1em;
                border-bottom: 1px solid orange;
            }

            .regitraArticulo{
                border: 1px solid blue;
                display: flex;
            }

            .fotos_articulo{
                height: 100px;
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
                <div id="usuario" class="usuario">
                    <img src="imagenes/<?= $usuario->getFoto() ?>" style="border: 1px solid black; height: 80px; width: 80px; border-radius: 100px">
                    <?= $usuario->getNombre() ?>
                    <a href="logout.php">( cerrar sesión )</a>
                </div>
                <div id="titulo">
                    <h1>Segunda Mano</h1>
                </div>     
                <div class="tablaArticulos">    

                    <?php
                    $artiDAO = new ArticuloDAO(ConexionBD::conectar());
                    $articulos = $artiDAO->findAll();
                    $where = "";
                    ?>
                    <?php foreach ($articulos as $row) { ?>       <!-- importantes las llaves de apertura del while  -->
                        <div class="articulo_listado">
                            <div><?php echo $row['id']; ?>
                                <?php echo $row['titulo']; ?></div>
                            <img class="fotos_articulo" src="imagenes/articulo_generico.jpg">
                            <div><?php echo $row['descripcion']; ?></div>
                            <div><?php echo $row['precio']; ?></div>
                            <div><?php echo $row['id_usuario']; ?></div>
                            <div><a href='javascript:mostrarEditar(<?php echo json_encode($row) ?>)'><button >Editar</button></a>
                                <a href="eliminarArticulos.php?id=<?php echo $row['id']; ?>" ><button>Borrar</button></a></div>
                        </div>
                    <?php } ?>   <!-- importantes la llave de cierre del while  -->

                </div>

                <section class="regitraArticulo">
                    <form action="registrarArticulos.php" method="POST" id="nuevoForm" >
                        <h2>Inserta nuevo articulo</h2>   
                        <input type="text" placeholder="titulo articulo" name="titulo">
                        <input type="text" placeholder="descripcion" name="descripcion">
                        <input type="text" placeholder="precio" name="precio">
                        <input type="submit" value="Guardar Articulo">
                    </form>
                </section>

                <form action="modificarArticulos.php" method="POST" style="display:none;" id="editarForm" >
                    <div><h2>Editar articulo existente</h2>   </div>
                    <input type="text" placeholder="titulo articulo" name="titulo" id="titulo">
                    <input type="text" placeholder="descripcion" name="descripcion" id="descripcion">
                    <input type="text" placeholder="precio" name="precio" id="precio">
                    <input type="text" name="id" id="id" hidden="">
                    <input type="submit" value="Editar Articulo">
                </form>
            <?php else: ?>
                <form id="login" action="login.php" method="post">
                    <h2>Introduce tus Datos de Loguin</h2>
                    <input type="text" placeholder="email" name="email">
                    <input type="password" placeholder="password" name="password">
                    <input type="submit" value="login">
                    <a href="registrar.php">registrar</a>
                    <!-- <input type="button" onclick='registrar.php' value="Registrar"> -->
                </form>
            <?php endif; ?>
        </header>
        <main>
            <div class="MensajesFlash" >
                <?php MensajesFlash::imprimir_mensajes(); ?>
            </div><!--Cierre div MensajesFlash  -->
        </main>
        <script>

            function mostrarEditar(articulo) {
                console.log(articulo);
                //mostrar formulario de modificar o de insertar
                document.getElementById("editarForm").style.display = "block";
                document.getElementById("nuevoForm").style.display = "none";
                //rellenar los campos a modificar
                document.getElementById("id").value = articulo.id;
                document.getElementById("titulo").value = articulo.titulo;
                document.getElementById("descripcion").value = articulo.descripcion;
                document.getElementById("precio").value = articulo.precio;
            }
        </script>
    </body>
</html>
