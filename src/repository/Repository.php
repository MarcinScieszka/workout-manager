<?php

require_once __DIR__.'/../../Database.php';

class Repository
{
//    TODO: implement singleton;

    protected Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }
}
