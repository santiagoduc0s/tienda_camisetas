<?php

require_once 'models/handlers/Handler.php';

class UsuarioHandler extends Handler
{

    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;

    public function __construct()
    {
        parent::__construct();
    }

    // ------------------------------------------------------------------------

    public function login(): ?object
    {
        $result = false;
        $sql = "SELECT * FROM usuarios WHERE email = '{$this->email}'";
        $login = $this->db->query($sql);
        if ($login && $login->num_rows == 1) {
            $usuario = $login->fetch_object();
            if (password_verify($this->password, $usuario->password)) {
                $result = $usuario;
            }
        }
        return $result;
    }

    public function add(): bool
    {
        $result = false;
        $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->nombre}', "
                . "'{$this->apellidos}', '{$this->email}', "
                . "'{$this->password}', 'user', NULL);";
        if ($this->db->query($sql)) {
            $result = true;
        }
        return $result;
    }

    // ------------------------------------------------------------------------

    function getId()
    {
        return $this->id;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getApellidos()
    {
        return $this->apellidos;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getPassword()
    {
        return $this->password;
    }

    function getRol()
    {
        return $this->rol;
    }

    function getImagen()
    {
        return $this->imagen;
    }

    function setNombre($nombre)
    {
        $this->nombre = trim(mb_strtolower(mb_convert_encoding($nombre, $this->encode)), $this->encode);
    }

    function setApellidos($apellidos)
    {
        $this->apellidos = trim(mb_strtolower(mb_convert_encoding($apellidos, $this->encode)), $this->encode);
    }

    function setEmail($email)
    {
        $this->email = trim(mb_convert_encoding($email, $this->encode));
    }

    function setPassword($password)
    {
        $this->password = password_hash(trim($password), PASSWORD_BCRYPT, ['cost' => 4]);
    }
    
    function setPasswordNoEncrypt($password)
    {
        $this->password = trim($password);
    }

    function setRol($rol)
    {
        $this->rol = $rol;
    }

    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

}
