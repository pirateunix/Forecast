<?php

namespace models;

use config\Config;

class DbClass
{

    /** @var  DbClass */
    private static $instance;

    private function __construct()
    {
    }

    /**
     * @return DbClass
     */
    private function __clone()
    {
        if (self::$instance === null) {
            throw new \RuntimeException('instance not exists');
        }
        return self::$instance;
    }

    private static function connect()
    {
        self::$instance = new self();
        $config = Config::getInstance();
        self::$instance = new \Mongo("mongodb://" . $config['db_host'] . ":" . $config['db_port'] . "/" . $config['db_database']);
        if (!self::$instance) {
            throw new \RuntimeException("Ошибка подключения к базе данных: ");
        }
    }

    /**
     * Получение инстанса
     *
     *
     * @return DbClass
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::connect();
            return self::$instance;
        }
        return self::$instance;
    }
}