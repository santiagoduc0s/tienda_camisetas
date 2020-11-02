<?php

class Controller {
    
    protected function redirection(string $url = '') {
        header('Location: ' . DOMINIO_URL . $url);
    }

    protected function load_view($view) {
        require_once "./views/$view.php";
    }

    protected function load_model($model) {
        require_once "./models/$model.php";
        $arrayModel = explode('/', $model);
        return new $arrayModel[count($arrayModel) - 1];
    }
}
