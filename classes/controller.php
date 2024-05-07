<?php
//класс контроллера базовый 

abstract class Controller {
    
    public $model;
    public $view;
	
	abstract function action_view();
}
