<?php

require_once __DIR__.'/../../Database.php';

class Repository
{
//    TODO: implement singleton;

    protected $database;

    public function __construct()
    {
        $this->database = new Database();
    }

}
