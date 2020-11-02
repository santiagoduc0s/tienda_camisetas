<?php

require_once './models/handlers/Handler.php';

class CategoriaHandler extends Handler {
    
    private $id;
    private $nombre;
    
    public function __construct() {
        parent::__construct();
    }
    
    // ------------------------------------------------------------------------
    
    public function getOne(): ?object {
        $result = null;
        $sql = "SELECT * FROM categorias WHERE id = {$this->id};";
        if ($categoria = $this->db->query($sql)) {
            $result = $categoria->fetch_object();
        }
        return $result;
    }

    public function getAll(): ?object {
        $result = null;
        $sql = "SELECT * FROM categorias ORDER BY id DESC;";
        if ($categorias = $this->db->query($sql)) {
            $result = $categorias;
        }
        return $result;
    }
    
    public function save(): bool {
        $resultado = false;
        $sql = "INSERT INTO categorias VALUES(NULL, '{$this->nombre}');";
        if ($this->db->query($sql)) {
            $resultado = true;
        }
        return $resultado;
    }
    
    public function edit(): bool
    {
        $result = false;
        $sql = "UPDATE categorias "
                . "SET nombre = '{$this->nombre}' "
                . "WHERE id = {$this->id};";
        if ($this->db->query($sql)) {
            $result = true;
        }
        return $result;
    }
    
    public function delete(): bool
    {
        $result = false;
        $sql = "DELETE FROM categorias WHERE id = {$this->id};";
        if ($this->db->query($sql)) {
            $result = true;
        }
        return $result;
    }
    
    // ------------------------------------------------------------------------
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }
    
    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string(mb_strtolower(trim($nombre), 'UTF-8'));
    }
}
