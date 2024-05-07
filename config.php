<?php
//конфиг сайта
// константы:
define ('DS', DIRECTORY_SEPARATOR); // разделитель для путей к файлам
define ('SITE_PATH', realpath(dirname(__FILE__)).DS); // путь к корневой папке сайта
define("db_host","sql11.freemysqlhosting.net");// хост базы данных
define("db_port","3306"); // порт для базы данных
define("db_user","sql11704781"); //имя пользователя базы данных
define("db_password","jtnlst7HRf"); // пароль к базе данных
define("db_database","sql11704781");// имя базы данных
define('SiteName','Сайт ISM'); //название сайта
define('CLASS_PATH', SITE_PATH . 'classes' . DS); //путь до файлов классов
define('MODEL_PATH', SITE_PATH . 'models' . DS); //путь до файлов моделей
define('CONTROLLER_PATH', SITE_PATH . 'controllers' . DS);////путь до файлов контроллеров
define('VIEW_PATH', SITE_PATH . 'views' . DS); //путь до файлов вьюх
define('TPL_PATH', SITE_PATH . 'tpl' . DS); //путь до файлов шаблонов
define('DEBUG', true); //включить/выключить отображение ошибок
