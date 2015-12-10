<?php

namespace config;

class Config
{
    private static $instance;
    private $config;

    private function __construct()
    {
        $this->config = yaml_parse_file('config.yml');
    }

    private function __clone()
    {
        if (self::$instance === null) {
            throw new \RuntimeException('instance not exists');
        }
        return self::$instance;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get($index)
    {
        if (isset($this->config[$index])) {
            $result = $this->config[$index];
        } else {
            $result = null;
        }
        return $result;
    }
}