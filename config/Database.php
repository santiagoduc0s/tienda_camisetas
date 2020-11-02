<?php

class Database {
    public static function connect() {
        $db = new mysqli('localhost', 'root', '', 'tienda_camisetas');
        $db->set_charset("utf8");
        return $db;
    }
}
