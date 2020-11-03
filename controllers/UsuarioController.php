<?php

require_once './controllers/Controller.php';

class usuarioController extends Controller
{

    private $usuarioHandler;

    public function __construct()
    {
        require_once 'models/handlers/UsuarioHandler.php';
        $this->usuarioHandler = new UsuarioHandler();
    }

    public function login()
    {
        if (isset($_POST['login'])) {
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            if ($email && $password) {
                $this->usuarioHandler->setEmail($email);
                $this->usuarioHandler->setPasswordNoEncrypt($password);

                $usuario = $this->usuarioHandler->login();
                if ($usuario) {
                    $_SESSION['user_logged'] = $userLogin;
                    if ($userLogin->rol == 'admin') {
                        $_SESSION['admin'] = true;
                    }
                } else {
                    $_SESSION['login'] = 'failed';
                }
            }
        }
        header('Location:' .  DOMINIO_URL);
    }

    public function logout()
    {
        Utils::delete_session('user_logged');
        Utils::delete_session('admin');
        $this->redirection();
    }

    public function agregar_view()
    {
        if ($_SESSION['user_logged']) {
            // TODO: redireccionar al perfil del usuario
            header('Location:' . DOMINIO_URL);
            exit();
        }
        require_once './views/usuario/registro.php';
    }

    public function agregar()
    {
        if (isset($_POST['registro'])) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            if ($nombre && $apellido && $email && $password) {
                $this->usuarioHandler->setNombre($nombre);
                $this->usuarioHandler->setApellidos($apellido);
                $this->usuarioHandler->setEmail($email);
                $this->usuarioHandler->setPassword($password);

                if ($this->usuarioHandler->add()) {
                    $_SESSION['registro'] = 'complete';
                } else {
                    $_SESSION['registro'] = 'failed';
                }
            }
        }
        $this->redirection('usuario/register');
    }

}
