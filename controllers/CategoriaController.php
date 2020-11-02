<?php

require_once './controllers/Controller.php';

class categoriaController extends Controller
{

    private $categoriaHandler;

    public function __construct()
    {
        $this->categoriaHandler = new CategoriaHandler();
    }

    // ------------------------------------------------------------------------

    public function index(): void
    {
        Utils::isAdmin();
        $categorias = $this->categoriaHandler->getAll();
        if ($categorias != null) {
            require_once './views/categoria/index.php';
        } else {
            header('Location: ' . DOMINIO_URL);
        }
    }

    public function ver()
    {
        if (isset($_GET['id'])) {
            $this->categoriaHandler->setId($_GET['id']);
            $categoria = $this->categoriaHandler->getOne();
            if ($categoria != null) {
                $productoHandler = new ProductoHandler();
                $productoHandler->setCategoria_id($_GET['id']);
                $productos = $productoHandler->getAllByCategory();
                $cantidadProd = $productos->num_rows;
            } else {
                goto salir;
            }
        } else {
            salir:
            header('Location: ' . DOMINIO_URL . 'categoria/index');
            exit();
        }
        require_once './views/categoria/ver.php';
    }

    public function crear(): void
    {
        Utils::isAdmin();
        require_once './views/categoria/crear.php';
    }

    public function guardar(): void
    {
        Utils::isAdmin();
        if (isset($_POST['crear'])) {
            $this->categoriaHandler->setNombre($_POST['nombre']);
            $this->categoriaHandler->save();
        }
        header('Location: ' . DOMINIO_URL . 'categoria/index');
    }

}
