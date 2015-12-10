<?php
date_default_timezone_set('Asia/Novosibirsk');
require_once 'config/Templater.php';
require_once 'config/Config.php';
require_once 'Router.php';


$projectDir = __DIR__;
define ('PROJECTDIR', $projectDir);
define ('DIRSEP', DIRECTORY_SEPARATOR);

function autoloader($class)
{

    $class = trim($class, '/\\');
    $parts = explode('\\', $class);
    require_once __DIR__ . '/' . $parts[0] . '/' . $parts[1] . '.php';
}

spl_autoload_register('autoloader');

$smarty = \config\Templater::getInstance()->smarty();
// Вывести верхний колонтитул
$smarty->display('header.tpl');

$router = new Router();
$router->delegate();

// Вывести нижний колонтитул
$smarty->display('footer.tpl');
