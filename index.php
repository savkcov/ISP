<?php
//подключаем конфигурационный файл
require_once 'config.php';

// включем/выключаем отображение всех ошибок
if (DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}
//автозагрузка классов
set_include_path(get_include_path() . PATH_SEPARATOR . CLASS_PATH . PATH_SEPARATOR . VIEW_PATH . PATH_SEPARATOR . MODEL_PATH . PATH_SEPARATOR . CONTROLLER_PATH);
spl_autoload_extensions('.php');
spl_autoload_register();

// задание кодировки
mb_internal_encoding('UTF-8');
ini_set('default_charset', 'utf-8');
setlocale(LC_ALL, 'ru_RU.utf-8');

ob_start();
//запускаем роутер
$router=new Router();
$router->start();
?>
		