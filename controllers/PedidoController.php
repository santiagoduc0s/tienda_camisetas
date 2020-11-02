<?php

require_once './controllers/Controller.php';

class pedidoController extends Controller
{

    const ESTADO_PEDIDO = ['confirmado', 'listo para enviar', 'cancelado', 'enviado'];

    private $pedidoHandler;

    public function __construct()
    {
        require_once './models/handlers/PedidoHandler.php';
        $this->pedidoHandler = new PedidoHandler();
    }

    public function hacer()
    {
        Utils::isUserLogged();
        require_once './views/pedido/hacer.php';
    }

    public function confirmado()
    {
        Utils::isUserLogged();
        $this->pedidoHandler->setUsuario_id($_SESSION['user_logged']->id);
        $pedido = $this->pedidoHandler->getOneByUsuarioId();

        $this->pedidoHandler->setId($pedido->id);
        $productos = $this->pedidoHandler->getProductsById();

        include_once './views/pedido/confirmado.php';
    }

    public function add()
    {
        Utils::isUserLogged();

        $usuario_id = $_SESSION['user_logged']->id;
        $departamento = isset($_POST['departamento']) ? mb_strtolower(trim($_POST['departamento']), 'UTF-8') : false;
        $ciudad = isset($_POST['ciudad']) ? mb_strtolower(trim($_POST['ciudad']), 'UTF-8') : false;
        $direccion = isset($_POST['direccion']) ? mb_strtolower(trim($_POST['direccion']), 'UTF-8') : false;
        $coste = Utils::statusCarrito()['total'];

        if ($departamento && $ciudad && $direccion) {
            $this->pedidoHandler->setUsuario_id($usuario_id);
            $this->pedidoHandler->setDepartamento($departamento);
            $this->pedidoHandler->setCiudad($ciudad);
            $this->pedidoHandler->setDireccion($direccion);
            $this->pedidoHandler->setCoste($coste);
            if ($this->pedidoHandler->save()) {
                $_SESSION['pedido'] = 'complete';
                Utils::delete_session('carrito');
            } else {
                $_SESSION['pedido'] = 'failed';
            }
        } else {
            $_SESSION['pedido'] = 'error';
        }
        header('Location:' . DOMINIO_URL . 'pedido/confirmado');
    }

    public function pedidos()
    {
        Utils::isUserLogged();
        $gestion = false;
        if (isset($_SESSION['admin'])) {
            $gestion = true;
            $pedidos = $this->pedidoHandler->getAll();
            if (is_null($pedidos)) {
                header('Location:' . DOMINIO_URL);
                exit();
            }
        } else {
            $this->pedidoHandler->setUsuario_id($_SESSION['user_logged']->id);
            $pedidos = $this->pedidoHandler->getAllByUsuarioId();
        }
        $cantPedidos = $pedidos->num_rows;
        require_once 'views/pedido/pedidos.php';
    }

    public function ver()
    {
        Utils::isUserLogged();
        $gestion = false;
        if (isset($_SESSION['admin'])) {
            $gestion = true;
            $estados = self::ESTADO_PEDIDO;
        }
        if ($_GET['id']) {
            $this->pedidoHandler->setId($_GET['id']);
            $pedido = $this->pedidoHandler->getOneById();
            $productos = $this->pedidoHandler->getProductsById();
            if (is_null($productos) || is_null($pedido)) {
                goto no_products;
            }
            require_once 'views/pedido/ver.php';
        } else {
            no_products:
            header('Location:' . DOMINIO_URL);
        }
    }

    public function estado()
    {
        Utils::isAdmin();

        if (isset($_POST['pedido_id']) && isset($_POST['estado'])) {
            $estadoCorrecto = false;
            foreach (self::ESTADO_PEDIDO as $estado) {
                if ($estado == $_POST['estado']) {
                    $estadoCorrecto = true;
                }
            }
            if ($estadoCorrecto) {
                $this->pedidoHandler->setId($_POST['pedido_id']);
                $this->pedidoHandler->setEstado($_POST['estado']);
                if ($this->pedidoHandler->updateEstado()) {
                    $_SESSION['set_pedido'] = 'complete';
                } else {
                    $_SESSION['set_pedido'] = 'failed';
                }
            } else {
                goto salir;
            }
            header('Location:' . DOMINIO_URL . 'pedido/ver&id=' . $_POST['pedido_id']);
        } else {
            salir:
            header('Location:' . DOMINIO_URL);
        }
    }

}