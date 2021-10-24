<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticuloDAO
 *
 * @author Juanmi 2º DAW
 */
class ArticuloDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * //TODO Método que inserta un usuario en la BD
     * @param Usuario $articulo
     * @return boolean
     */
    public function insert($articulo) {
        //Comprobamos que el parámetro sea de la clase Usuario
        if (!$articulo instanceof Articulo) {
            return false;
        }
 
        $titulo = $articulo->getTitulo();
        $descripcion = $articulo->getDescripcion();
        $precio = $articulo->getPrecio();
        $id_usuario = $articulo->getId();
        $sql = "INSERT INTO articulos (titulo, descripcion, precio, id_usuario) VALUES "
                . "('$titulo','$descripcion','$precio','$id_usuario')";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        // echo $sql; por si quiero ver la consulta
        $articulo->setId($this->conn->insert_id);
        return true;
    }

    public function update($articulo) {
        //Comprobamos que el parámetro no es nulo y es de la clase Usuario
        if (!$articulo instanceof Articulo) {
            return false;
        }
        $id= $articulo->getId();
        $titulo = $articulo->getTitulo();
        $descripcion = $articulo->getDescripcion();
        $precio = $articulo->getPrecio();
        $sql = "UPDATE articulos SET titulo=" . "('$titulo')" . " , descripcion="."('$descripcion')".", precio="."('$precio')" . " WHERE id="."('$id')";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        if ($this->conn->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Borra un registro de la tabla
     * @param type $articulos //Objeto de la clase Usuario
     * @return type
     */
    public function delete($articulos) {
        $sql = "DELETE FROM articulos WHERE id = " . $articulos->getId();
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        if ($this->conn->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Devuelve el usuario de la BD 
     * @param type $id id del usuario
     * @return \Usuario Usuario de la BD o null si no existe
     */
    public function find($id) { //: Usuario especifica el tipo de datos que va a devolver pero no es obligatorio ponerlo
        $sql = "SELECT * FROM articulos WHERE id='$id'";
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        return $result->fetch_object('Articulo');//esto solo lo puedo usar si todos los campos se llaman exactamente igual
        /* Sino se llaman igual los campos, deberiamos cambiar el fetch_object por lo siguiente:
         * 
         * if ($fila = $result->fetch_assoc()) {
          $usuario = new Usuario();
          $usuario->setEmail($fila['email']);
          $usuario->setPassword($fila['password']);
          $usuario->setId($fila['id']);
          $usuario->setFoto($fila['foto']);
          $usuario->setNombre($fila['nombre']);

          return $usuario;
          } else {
          return null;
          } */
    }

    /**
     * Devuelve todos los usuarios de la BD
     * @param type $orden Tipo de orden (ASC o DESC)
     * @param type $campo Campo de la BD por el que se van a ordenar
     * @return array Array de objetos de la clase Usuario
     */
    public function findAll($orden = 'ASC', $campo = 'id') {
        $sql = "SELECT * FROM articulos ORDER BY $campo $orden";
        //echo $sql;
        if (!$result = $this->conn->query($sql)) {
            die("Error en la SQL: " . $this->conn->error);
        }
        $array_obj_articulos = array();
        while ($articulo = $result->fetch_array(MYSQLI_ASSOC)) {
            $array_obj_articulos[] = $articulo;
        }
        return $array_obj_articulos;
    }



}


