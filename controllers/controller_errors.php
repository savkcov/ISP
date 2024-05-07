<?php

Class Controller_errors Extends Controller {


	function __construct()
    { 
	//инициализация виевера
	$this->view = new View_errors();
    }

	
	// вывод 404 
	function action_view() {
		//вызов стартовой страницы
		$this->view->get_body();
	}

}


?>
