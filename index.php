<?php

/* CONTROLADOR FRONTAL */

session_start();

require_once './autoload.php';
require_once './config/parameters.php';
require_once './helpers/Utils.php';
require_once './views/layout/header.php';
require_once './views/layout/sidebar.php';

function showError()
{
    $error = new errorController();
    $error->index();
}

// TODO: asegurarme que el controlador ingresados esten en minuscula
function load($controler, $action)
{
    if (class_exists($controler . 'Controller')) {
        $nombre_controlador = $controler . 'Controller';
        $controlador = new $nombre_controlador();
        if (method_exists($controlador, $action)) {
            $nombre_metodo = $action;
            $controlador->$nombre_metodo();
        } else {
            showError();
        }
    } else {
        showError();
    }
}

$controlador = isset($_GET['controlador']) ? $_GET['controlador'] : null;
$accion = isset($_GET['accion']) ? $_GET['accion'] : null;

try {
    if (isset($controlador) && isset($accion)) {
        load($controlador, $accion);
    } elseif (!isset($controlador) || !isset($accion)) {
        load(CONTROLADOR_DEFAULT, ACCION_DEFAULT);
    } else {
        showError();
    }
} catch (TypeError $e) {
    header('Location: ' . DOMINIO_URL);
    exit();
}

require_once 'views/layout/footer.php';
