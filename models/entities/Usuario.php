<?php

require_once './models/entities/Entity.php';

class Usuario extends Entity {
    
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    
    function __construct() {
        parent::__construct();
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getRol() {
        return $this->rol;
    }

    function getImagen() {
        return $this->imagen;
    }

    function setNombre($nombre) {
        $this->nombre = trim(mb_strtolower(mb_convert_encoding($nombre, $this->encode)), $this->encode);
    }

    function setApellidos($apellidos) {
        $this->apellidos = trim(mb_strtolower(mb_convert_encoding($apellidos, $this->encode)), $this->encode);
    }

    function setEmail($email) {
        $this->email = trim(mb_convert_encoding($email, $this->encode));
    }

    function setPassword($password) {
        $this->password = trim($password);
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }
}
