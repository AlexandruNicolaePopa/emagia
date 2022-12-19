<?php

use Dotenv\Dotenv;

require_once('vendor/autoload.php');
class Config
{
    public string $dbName;
    public string $dbUserName;
    public string $dbPassword;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        $this->dbName = $_ENV['DB_DATABASE'];
        $this->dbUserName = $_ENV['DB_USERNAME'];
        $this->dbPassword = $_ENV['DB_PASSWORD'];
    }
}
