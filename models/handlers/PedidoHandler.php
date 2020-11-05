<?php

require_once './models/handlers/Handler.php';

class PedidoHandler extends Handler
{

    private $id;
    private $usuario_id;
    private $departamento;
    private $ciudad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;

    public function __construct()
    {
        parent::__construct();
    }

    // ------------------------------------------------------------------------

    public function add(): bool
    {
        $resultado = false;
        $sql = "INSERT INTO pedidos VALUES("
                . "NULL, "
                . "{$this->usuario_id}, "
                . "'{$this->departamento}', "
                . "'{$this->ciudad}', "
                . "'{$this->direccion}', "
                . "{$this->coste}, "
                . "'confirmado', "
                . "CURDATE(), "
                . "CURTIME());";

        $this->db->autocommit(false);
        try {
            $savePedido = $this->db->query($sql);
            $pedido_id = $this->db->insert_id;
            $saveLinea = true;
            foreach ($_SESSION['carrito-' . $_SESSION['user_logged']->email] as $elemento) {
                $producto = $elemento['producto'];
                $sql = "INSERT INTO lineas_pedidos VALUES("
                        . "NULL, "
                        . "{$pedido_id}, "
                        . "{$elemento['id_producto']}, "
                        . "{$elemento['unidades']});";
                if (!$this->db->query($sql)) {
                    $saveLinea = false;
                }
            }
            if ($savePedido && $saveLinea) {
                $this->db->commit();
                $resultado = true;
            } else {
                throw new Exception();
            }
        } catch (Exception $exc) {
            $this->db->rollback();
        } finally {
            return $resultado;
        }
    }
    
    public function getOneById(): ?object
    {
        $result = null;
        $sql = "SELECT * FROM pedidos "
                . "WHERE id = {$this->id};";
        if ($pedido = $this->db->query($sql)) {
            $result = $pedido->fetch_object();
        }
        return $result;
    }

    public function getProductsById(): ?object
    {
        $result = null;
        $sql = "SELECT pr.*, lp.unidades FROM productos pr "
                . "INNER JOIN lineas_pedidos lp "
                . "ON pr.id = lp.producto_id "
                . "WHERE lp.pedido_id = {$this->id};";
        if ($products = $this->db->query($sql)) {
            $result = $products;
        }
        return $result;
    }

    public function getOneByUsuarioId(): ?object
    {
        $resultado = null;
        $sql = "SELECT p.id, p.coste FROM pedidos p "
                . "WHERE usuario_id = {$this->usuario_id} "
                . "ORDER BY id DESC LIMIT 1;";
        if ($pedido = $this->db->query($sql)) {
            $resultado = $pedido->fetch_object();
        }
        return $resultado;
    }

    public function getAllByUsuarioId(): ?Traversable
    {
        $resultado = null;
        $sql = "SELECT * FROM pedidos "
                . "WHERE usuario_id = {$this->usuario_id} "
                . "ORDER BY id DESC;";
        if ($productos = $this->db->query($sql)) {
            $resultado = $productos;
        }
        return $resultado;
    }
    
    public function getAll(): ?Traversable
    {
        $result = null;
        $sql = "SELECT * FROM pedidos";
        if ($pedidos = $this->db->query($sql))
        {
            $result = $pedidos;
        }
        return $result;
    }
    
    public function updateEstado(): bool
    {
        $result = false;
        $sql = "UPDATE pedidos SET estado = '{$this->estado}' WHERE id = {$this->id};";
        if ($this->db->query($sql)) {
            $result = true;
        }
        echo $this->db->error;
        return $result;
    }

    // ------------------------------------------------------------------------

    public function getId()
    {
        return $this->id;
    }

    public function getUsuario_id()
    {
        return $this->usuario_id;
    }

    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function getCiudad()
    {
        return $this->ciudad;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getCoste()
    {
        return $this->coste;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getHora()
    {
        return $this->hora;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUsuario_id(int $usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }

    public function setDepartamento($departamento)
    {
        $this->departamento = $this->db->real_escape_string($departamento);
    }

    public function setCiudad($ciudad)
    {
        $this->ciudad = $this->db->real_escape_string($ciudad);
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    public function setCoste($coste)
    {
        $this->coste = $coste;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function setHora($hora)
    {
        $this->hora = $hora;
    }

}
