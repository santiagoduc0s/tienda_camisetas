<?php

require_once './controllers/Controller.php';

class productoController extends Controller
{

    private $productoHandler;

    public function __construct()
    {
        $this->productoHandler = new ProductoHandler();
    }

    public function index()
    {
        $productos = $this->productoHandler->getRandom(6);
        require_once './views/producto/destacados.php';
    }

    public function gestion()
    {
        Utils::isAdmin();
        $productos = $this->productoHandler->getAll();
        require_once './views/producto/gestion.php';
    }

    public function crear()
    {
        Utils::isAdmin();
        require_once './views/producto/crear.php';
    }

    public function save()
    {
        Utils::isAdmin();
        if ($_POST['crear']) {
            $this->productoHandler->setNombre($_POST['nombre']);
            $this->productoHandler->setDescripcion($_POST['descripcion']);
            $this->productoHandler->setCategoria_id($_POST['categoria']);
            $this->productoHandler->setPrecio($_POST['precio']);
            $this->productoHandler->setStock($_POST['stock']);

            $hayImagen = false;
            if ($_FILES['imagen']['size'] > 0) {
                $hayImagen = true;
                $file = $_FILES['imagen'];
                $name_file = $file['name'];
                $ruta_temporal = $file['tmp_name'];
                $mimetype = $file['type'];
                $ruta_images = 'uploads/image';
            } else {
                goto sin_imagen;
            }

            if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png') {
                while (file_exists($ruta_images . '/' . $name_file)) {
                    $exp_name = explode('.', $name_file);
                    $name = $exp_name[0];
                    $name .= 'a';
                    $extend = $exp_name[count($exp_name) - 1];
                    $name_file = $name . '.' . $extend;
                }
                $this->productoHandler->setImagen($name_file);

                sin_imagen:
                if ($this->productoHandler->save()) {
                    if ($hayImagen) {
                        if (!is_dir($ruta_images)) {
                            mkdir($ruta_images, 0777);
                        }
                        move_uploaded_file($ruta_temporal, $ruta_images . '/' . $name_file);
                    }
                    $_SESSION['save'] = 'complete';
                } else {
                    $_SESSION['save'] = 'failed';
                }
            } else {
                $_SESSION['save'] = 'error_image';
            }
        } else {
            $_SESSION['save'] = 'error';
        }
        header('Location:' . DOMINIO_URL . 'producto/gestion');
    }

    public function modificar()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $this->productoHandler->setId($_GET['id']);
            $producto = $this->productoHandler->searchById();
            require_once './views/producto/editar.php';
        }
    }

    public function editar()
    {
        Utils::isAdmin();
        if (isset($_GET['id']) && isset($_POST['editar'])) {
            $this->productoHandler->setId($_GET['id']);
            $this->productoHandler->setNombre($_POST['nombre']);
            $this->productoHandler->setDescripcion($_POST['descripcion']);
            $this->productoHandler->setCategoria_id($_POST['categoria']);
            $this->productoHandler->setPrecio($_POST['precio']);
            $this->productoHandler->setStock($_POST['stock']);

            $hayImagen = false;
            if ($_FILES['imagen']['size'] > 0) {
                $hayImagen = true;
                $file = $_FILES['imagen'];
                $name_file = $file['name'];
                $ruta_temporal = $file['tmp_name'];
                $mimetype = $file['type'];
                $ruta_images = 'uploads/image';
            } else {
                goto sin_imagen;
            }

            if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png') {
                while (file_exists($ruta_images . '/' . $name_file)) {
                    $exp_name = explode('.', $name_file);
                    $name = $exp_name[0];
                    $name .= 'a';
                    $extend = $exp_name[count($exp_name) - 1];
                    $name_file = $name . '.' . $extend;
                }
                $this->productoHandler->setImagen($name_file);

                sin_imagen:
                if ($this->productoHandler->edit()) {
                    if ($hayImagen) {
                        if (!is_dir($ruta_images)) {
                            mkdir($ruta_images, 0777);
                        }
                        move_uploaded_file($ruta_temporal, $ruta_images . '/' . $name_file);
                    }

                    $_SESSION['edit'] = 'complete';
                } else {
                    $_SESSION['edit'] = 'failed';
                }
            } else {
                $_SESSION['edit'] = 'error_image';
            }
        } else {
            $_SESSION['edit'] = 'error';
        }
        header('Location:' . DOMINIO_URL . 'producto/gestion');
    }

    public function eliminar()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $this->productoHandler->setId($_GET['id']);
            if ($this->productoHandler->delete()) {
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'error';
        }
        header('Location:' . DOMINIO_URL . 'producto/gestion');
    }

    public function ver()
    {
        Utils::isUserLogged();
        if (isset($_GET['id'])) {
            $this->productoHandler->setId($_GET['id']);
            $producto = $this->productoHandler->searchById();
        }
        require_once './views/producto/ver.php';
    }

}
