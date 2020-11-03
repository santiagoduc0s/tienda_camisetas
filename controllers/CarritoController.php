<?php

require_once './controllers/Controller.php';

class carritoController extends Controller
{

    private $carritoHandler;
    private $cart;

    public function __construct()
    {
        Utils::isUserLogged();
        $this->cart = 'carrito-' . $_SESSION['user_logged']->email;
        require_once 'models/handlers/CarritoHandler.php';
        $this->carritoHandler = new CarritoHandler();
    }

    // ------------------------------------------------------------------------

    public function index(): void
    {
        Utils::isUserLogged();
        if (!isset($_SESSION[$this->cart])) {
            $_SESSION[$this->cart] = null;
        }
        $carrito = $_SESSION[$this->cart];
        require_once './views/carrito/index.php';
    }

    public function add(): void
    {
        Utils::isUserLogged();
        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];
            $productoRepetido = false;

            if (isset($_SESSION[$this->cart])) {
                foreach ($_SESSION[$this->cart] as $indice => $elemento) {
                    if ($elemento['id_producto'] == $producto_id) {
                        $_SESSION[$this->cart][$indice]['unidades']++;
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
                    $_SESSION[$this->cart][] = [
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
            unset($_SESSION[$this->cart][$_GET['indice']]);
        }
        header('Location:' . DOMINIO_URL . 'carrito/index');
    }

    public function delete_all(): void
    {
        Utils::isUserLogged();
        unset($_SESSION[$this->cart]);
        header('Location:' . DOMINIO_URL . 'carrito/index');
    }

    public function moreUnidades(): void
    {
        if (isset($_GET['indice'])) {
            $_SESSION[$this->cart][$_GET['indice']]['unidades']++;
        }
        header('Location:' . DOMINIO_URL . 'carrito/index');
    }

    public function lessUnidades(): void
    {
        if (isset($_GET['indice'])) {
            if (isset($_SESSION[$this->cart][$_GET['indice']]['unidades'])) {
                $count = --$_SESSION[$this->cart][$_GET['indice']]['unidades'];
                if ($count <= 0) {
                    unset($_SESSION[$this->cart][$_GET['indice']]);
                }
            }
        }
        header('Location:' . DOMINIO_URL . 'carrito/index');
    }

}
