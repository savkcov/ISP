<?php
//класс представления страницы "Комментарии"
Class View_comments Extends View {
	public $page_title = 'Комментарии';
	public $page_name = 'Комментарии';
	
	public function get_content() {
        extract($this->res);
        include TPL_PATH."comments.tpl";
    }
	
}