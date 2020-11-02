<?php

function controllers_autoload($nombreClase) {
    include_once './controllers/' . $nombreClase . '.php';
}

spl_autoload_register('controllers_autoload');
