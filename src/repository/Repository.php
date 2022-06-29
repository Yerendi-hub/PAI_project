<?php

require_once __DIR__.'/../../Database.php';

class Repository {
    protected $database;
    protected $sessionManager;

    public function __construct()
    {
        $this->database = new Database();
        $this->sessionManager = new SessionManager();
    }
}