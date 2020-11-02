<?php

require_once 'models/handlers/Handler.php';

class UsuarioHandler extends Handler {
    
    private $id;
    
    public function __construct() {
        parent::__construct();
    }
    
    // ------------------------------------------------------------------------
    
    public function login($user) {
        $resultado = false;
        $sql = "SELECT * FROM usuarios WHERE email = '{$user->getEmail()}'";
        $login = $this->db->query($sql);
        if ($login && $login->num_rows == 1) {
            $usuarioDB = $login->fetch_object();
            $verificacion = password_verify($user->getPassword(), $usuarioDB->password);
            if ($verificacion) {
                $resultado = $usuarioDB;
            } else {
                $resultado = false;
            }
        } else {
            $resultado = false;
        }
        return $resultado;
    }
    
    public function save($usuario) {
        $resultado = false;
        $pass = password_hash($usuario->getPassword(), PASSWORD_BCRYPT, ['cost' => 4]);
        $sql = "
            INSERT INTO usuarios VALUES(
                NULL,
                '{$usuario->getNombre()}',
                '{$usuario->getApellidos()}',
                '{$usuario->getEmail()}',
                '{$pass}',
                'user',
                NULL
            );
        ";
        if ($this->db->query($sql)) {
            $resultado = true;
        }
        return $resultado;
    }
    
    // ------------------------------------------------------------------------
    
    function getId()
    {
        return $this->id;
    }

    function setId($id): void
    {
        $this->id = $id;
    }

}

