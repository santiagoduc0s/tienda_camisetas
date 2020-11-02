<?php

require_once './controllers/Controller.php';

class usuarioController extends Controller {
    
    private $usuarioEntity;
    private $usuarioHandler;

    public function __construct() {
        $this->usuarioEntity = $this->load_model('entities/Usuario');
        $this->usuarioHandler = $this->load_model('handlers/UsuarioHandler');
    }


    public function index() {
        echo 'Controlador Usuario - index()';
    }
    
    public function login() {
        if (isset($_POST['login'])) {
            $this->usuarioEntity->setEmail($_POST['email']);
            $this->usuarioEntity->setPassword($_POST['password']);
            $userLogin = $this->usuarioHandler->login($this->usuarioEntity);
            if ($userLogin !== false && is_object($userLogin)) {
                $_SESSION['user_logged'] = $userLogin;
                if ($userLogin->rol == 'admin') {
                    $_SESSION['admin'] = true;
                }
            } else {
                $_SESSION['error_login'] = 'fail';
            }
        }
        $this->redirection('');
    }
    
    public function logout() {
        Utils::delete_session('user_logged');
        Utils::delete_session('admin');
        $this->redirection();
    }
    
    public function register() {
        require_once './views/usuario/registro.php';
    }
    
    public function save() {
        if (isset($_POST['registro'])) {
            $this->usuarioEntity->setNombre($_POST['nombre']);
            $this->usuarioEntity->setApellidos($_POST['apellidos']);
            $this->usuarioEntity->setEmail($_POST['email']);
            $this->usuarioEntity->setPassword($_POST['password']);
            if ($this->usuarioHandler->save($this->usuarioEntity)) {
                $_SESSION['registro'] = 'complete';
            } else {
                $_SESSION['registro'] = 'problem';
            }
        } else {
            $_SESSION['registro'] = 'error';
        }
        $this->redirection('usuario/register');
    }
}
