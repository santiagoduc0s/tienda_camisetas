<?php

require_once 'models/handlers/Handler.php';

class ProductoHandler extends Handler
{

    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;

    public function __construct()
    {
        parent::__construct();
    }

    // ------------------------------------------------------------------------

    public function getAllByCategory(): ?object 
    {
        $result = null;
        $sql = "SELECT p.*, c.nombre AS 'cat_nombre' FROM productos p "
                . "JOIN categorias c ON p.categoria_id = c.id "
                . "WHERE p.categoria_id = {$this->categoria_id};";
        if ($productos = $this->db->query()) {
            $result = $productos;
        }
        return $productos;
    }

    public function getAll()
    {
        $productos = $this->db->query('SELECT * FROM productos');
        return $productos;
    }

    public function getRandom($limit)
    {
        $productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");
        return $productos;
    }

    public function save()
    {
        $resultado = false;
        $sql = "INSERT INTO productos VALUES(NULL, '{$this->categoria_id}', '{$this->nombre}', '{$this->descripcion}', {$this->precio}, {$this->stock}, NULL, CURDATE(), '{$this->imagen}');";
        $save = $this->db->query($sql);
        if ($save) {
            $resultado = true;
        }
        return $resultado;
    }

    public function searchById()
    {
        $sql = "SELECT * FROM productos WHERE id = {$this->id};";
        $result = $this->db->query($sql);
        return $result->fetch_object();
    }

    public function edit()
    {
        $result = false;
        $sql = "UPDATE productos SET categoria_id = {$this->categoria_id}, nombre = '{$this->nombre}', descripcion = '{$this->descripcion}', precio = {$this->precio}, stock = {$this->stock}";
        if (!is_null($this->imagen)) {
            $sql .= ", imagen = '{$this->imagen}' WHERE id = {$this->id};";
        } else {
            $sql .= " WHERE id = {$this->id};";
        }

        if ($this->db->query($sql)) {
            $result = true;
        }
        return $result;
    }

    public function delete()
    {
        $result = false;
        $sql = "DELETE FROM productos WHERE id = {$this->id};";
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

    function getCategoria_id()
    {
        return $this->categoria_id;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function getPrecio()
    {
        return $this->precio;
    }

    function getStock()
    {
        return $this->stock;
    }

    function getOferta()
    {
        return $this->oferta;
    }

    function getFecha()
    {
        return $this->fecha;
    }

    function getImagen()
    {
        return $this->imagen;
    }

    function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $this->db->real_escape_string($categoria_id);
    }

    function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string(mb_strtolower(trim($nombre), 'UTF-8'));
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $this->db->real_escape_string(mb_strtolower(trim($descripcion), 'UTF-8'));
    }

    function setPrecio($precio)
    {
        $this->precio = $this->db->real_escape_string($precio);
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setStock($stock)
    {
        $this->stock = $this->db->real_escape_string($stock);
    }

    function setOferta($oferta)
    {
        $this->oferta = $this->db->real_escape_string($oferta);
    }

    function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

}
