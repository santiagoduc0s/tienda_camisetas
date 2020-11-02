<?php

require_once './config/Database.php';

class Handler extends Database
{

    protected $db;

    public function __construct()
    {
        $this->db = parent::connect();
    }

}
