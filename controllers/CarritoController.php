<?php

require_once './controllers/Controller.php';

class carritoController extends Controller
{

    private $carritoHandler;

    public function __construct()
    {
        require_once 'models/handlers/CarritoHandler.php';
        $this->carritoHandler = new CarritoHandler();
    }
    
    // ------------------------------------------------------------------------

    public function index(): void
    {
        Utils::isUserLogged();
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = null;
        }
        $carrito = $_SESSION['carrito'];
        require_once './views/carrito/index.php';
    }

    public function add(): void
    {
        Utils::isUserLogged();
        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];
            $productoRepetido = false;

            if (isset($_SESSION['carrito'])) {
                foreach ($_SESSION['carrito'] as $indice => $elemento) {
                    if ($elemento['id_producto'] == $producto_id) {
                        $_SESSION['carrito'][$indice]['unidades']++;
                        $productoRepetido = true;
                    }
                }
            }
            if (!$productoRepetido) {
                require_once 'models/handlers/ProductoHandler.php';
                $producto = new ProductoHandler();
                $producto->setId($producto_id);
                $prodSearch = $producto->searchById();
                if (is_object($prodSearch)) {
                    $_SESSION['carrito'][] = [
                        'id_producto' => $producto_id,
                        'precio' => $prodSearch->precio,
                        'unidades' => 1,
                        'producto' => $prodSearch
                    ];
                }
            }
            header('Location:' . DOMINIO_URL . 'carrito/index');
        } else {
            header('Location:' . DOMINIO_URL);
        }
    }

    public function delete(): void
    {
        Utils::isUserLogged();
        if (isset($_GET['indice'])) {
            unset($_SESSION['carrito'][$_GET['indice']]);
        }
        header('Location:' . DOMINIO_URL . 'carrito/index');
    }

    public function delete_all(): void
    {
        Utils::isUserLogged();
        unset($_SESSION['carrito']);
        header('Location:' . DOMINIO_URL . 'carrito/index');
    }

    public function moreUnidades(): void
    {
        if (isset($_GET['indice'])) {
            $_SESSION['carrito'][$_GET['indice']]['unidades']++;
        }
        header('Location:' . DOMINIO_URL . 'carrito/index');
    }

    public function lessUnidades(): void
    {
        if (isset($_GET['indice'])) {
            $count = --$_SESSION['carrito'][$_GET['indice']]['unidades'];
            if ($count <= 0) {
                unset($_SESSION['carrito'][$_GET['indice']]);
            }
        }
        header('Location:' . DOMINIO_URL . 'carrito/index');
    }

}
