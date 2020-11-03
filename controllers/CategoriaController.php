<?php

require_once './controllers/Controller.php';

class categoriaController extends Controller
{

    private $categoriaHandler;

    public function __construct()
    {
        require_once 'models/handlers/CategoriaHandler.php';
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

    // este metodo muestra los productos segun la categoria seleccionada
    public function ver()
    {
        if (isset($_GET['id'])) {
            $this->categoriaHandler->setId($_GET['id']);
            $categoria = $this->categoriaHandler->getOne();
            if ($categoria != null) {
                require_once 'models/handlers/ProductoHandler.php';
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

    public function editar_view(): void
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $this->categoriaHandler->setId($_GET['id']);
            $categoria = $this->categoriaHandler->getOne();
            if (is_null($categoria)) {
                goto salir;
            }
            require_once 'views/categoria/editar.php';
        } else {
            salir:
            header('Location: ' . DOMINIO_URL . 'categoria/index');
        }
    }

    public function editar(): void
    {
        Utils::isAdmin();
        if (isset($_POST['nombre']) && isset($_POST['id'])) {
            $this->categoriaHandler->setId($_POST['id']);
            $this->categoriaHandler->setNombre($_POST['nombre']);
            if ($this->categoriaHandler->edit()) {
                $_SESSION['edit-categoria'] = 'complete';
            } else {
                $_SESSION['edit-categoria'] = 'failed';
            }
        }
        header('Location: ' . DOMINIO_URL . 'categoria/index');
    }

    public function borrar(): void
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $this->categoriaHandler->setId($_GET['id']);
            if ($this->categoriaHandler->delete()) {
                $_SESSION['delete-categoria'] = 'complete';
            } else {
                $_SESSION['delete-categoria'] = 'failed';
            }
        }
        header('Location: ' . DOMINIO_URL . 'categoria/index');
    }

}
