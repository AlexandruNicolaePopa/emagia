<?php

namespace Emagia\Database\Classes;

use Laminas\Db\Adapter\Adapter;
use Config;


class DatabaseAdapterClass
{
    private Adapter $adapter;

    public function __construct()
    {
        $config = new Config;
        $this->adapter = new Adapter([
            'driver'   => 'Pdo_Mysql',
            'hostname' => 'db',
            'database' => $config->dbName,
            'username' => $config->dbUserName,
            'password' => $config->dbPassword,
        ]);
    }

    public function getAdapter(): Adapter
    {
        return $this->adapter;
    }
}
