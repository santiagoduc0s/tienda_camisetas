<?php

class Utils {
    
    public static function delete_session($name) {
        if (isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
    }
    
    public static function isAdmin() {
        if (!isset($_SESSION['admin'])) {
            header('Location: ' . DOMINIO_URL);
            exit();
        } else {
            return true;
        }
    }
    
    public static function isUserLogged() {
        if (!isset($_SESSION['user_logged'])) {
            header('Location: ' . DOMINIO_URL);
            exit();
        } else {
            return true;
        }
    }

    public static function showCategorias() {
        require_once './models/handlers/CategoriaHandler.php';
        $category = new CategoriaHandler();
        $categorias = $category->getAll();
        return $categorias;
    }
    
    public static function statusCarrito() {
        $status = [
            'cantidad' => 0,
            'unidades' => 0,
            'total' => 0
        ];
        
        if (isset($_SESSION['carrito'])) {
            $status['cantidad'] = count($_SESSION['carrito']);
            $unidades = 0;
            $total = 0;
            foreach ($_SESSION['carrito'] as $prod) {
                $unidades += $prod['unidades'];
                $total += $prod['precio'] * $prod['unidades'];
            }
            $status['unidades'] = $unidades;
            $status['total'] = $total;
        }
        return $status;
    }
    
}
