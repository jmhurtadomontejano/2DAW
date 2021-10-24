<?php

/**
 * Description of Usuario
 *
 * @author DAW2
 */
class Usuario {
    private $id;
    private $nombre;
    private $email;
    private $password;
    private $foto;
       
    //Array que va a contener los artículos de este usuario
    private $articulos;
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getFoto() {
        return $this->foto;
    }

    function getArticulos() {
        return $this->articulos;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    function setEmail($email): void {
        $this->email = $email;
    }

    function setPassword($password): void {
        $this->password = $password;
    }

    function setFoto($foto): void {
        $this->foto = $foto;
    }

    function setArticulos($articulos): void {
        $this->articulos = $articulos;
    }


}
