<?php
//класс вывода ошибок
class View_errors extends View {
	public $page_title = 'Ошибка 404';
	public $page_name = 'Страница не найдена';
	//404 ошибка
	public function get_content() {include TPL_PATH."404.tpl";}

}
?>
