<?php

namespace config;


class Templater
{

    private static $instance;
    private $smarty;

    private function __construct()
    {
        $config = Config::getInstance();
        $this->smarty = new \Smarty();
        $this->smarty->template_dir = $config->get('smarty')['template_dir'];
        $this->smarty->compile_dir = $config->get('smarty')['templates_c'];
        $this->smarty->cache_dir = $config->get('smarty')['cache'];
        $this->smarty->config_dir = $config->get('smarty')['config_dir'];
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

    public function smarty() {
        return $this->smarty;
    }
}