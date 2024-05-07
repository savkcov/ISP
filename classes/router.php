<?php
//класс маршрутизации

final class Router
{
    public function start()
    {
        // контроллер и действие по умолчанию (В нашем случае контроллер страницы комментариев)
        $controller_name = 'index';
        $action_name = 'view';

        //получаем массив
        $routes = $this->parseUrl();
        
        // получаем имя контроллера
        if ( !empty($routes[1]) && $routes[1]!="index.php")
        {
            $controller_name = $routes[1];
        }

        // получаем имя экшена
        if ( !empty($routes[2]) )
        {
            $action_name = $routes[2];
            if(strpos($action_name,'?')>0){
				$action_name = substr($action_name,0,strpos($action_name,'?'));
			}
        }

        // добавляем префиксы
        $model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;

        // подключаем файл с классом модели (файла модели может и не быть)
        $model_file = strtolower($model_name).'.php';
        if(file_exists(MODEL_PATH.$model_file)){
			require_once MODEL_PATH.$model_file;
		}

        // подключаем файл с классом контроллера
        if(!file_exists(CONTROLLER_PATH.strtolower($controller_name).'.php')){
			$controller_name = 'Controller_errors';
		}
        // создаем контроллер
        $controller = new $controller_name;
        if(method_exists($controller, $action_name))
        {
            // вызываем действие контроллера
            $controller->$action_name();
        }
        else {
			//вызываем по умолчанию
			$controller->action_view();
		}
    }
    
    public function parseUrl() {
        $uri = explode('/', filter_var(rtrim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL));

        return $uri;
    }
}
