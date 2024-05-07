<?php
//класс для создания страниц контента
abstract class View {
	
	protected $page_title ='';
	protected $page_name ='';
	protected $page = array();
	protected $res = array();
	protected $ajax_res = array();
	public $res_message = [
        0 => "Ошибка записи",
        1 => "Успешно",
        2 => "Не удалось получить список пользователей",
		3 => "Не удалось получить список транзакций пользователя",
		4 => "Не верный идентификатор пользователя"
    ];

	//метод присвоения значения
	public function __set($name,$value){
		if($value!="" && !is_array($value)){
			$this->$name = trim($value);
		}
		else {
			$this->$name = $value;
		}
		return $this;
	}
	
	//метод получения значения
	public function __get($name){
        if (isset($this->$name)){
			return $this->$name;
		}
        else {
			false;
		}
	}
	//вызов метода
	public function __call($name, $arguments) {
		if(method_exists($this, $name)) return $this->$name(implode(', ', $arguments));
		else return false;
	}


//метод создания заголовка страницы
	protected function get_header() {
		include TPL_PATH."header.tpl";
	}


//метод создания низа страницы
	protected function get_footer() {
		include TPL_PATH."footer.tpl";
	}
//основной метод сбора всей страницы
	public function get_body($str=false) {
		$action='get_content';
		$this->get_header();
		if($str!=false){
			$action=$action."_".$str;
		}
		$this->$action();
		$this->get_footer();
	}
//ajax виевер
	public function get_ajax() {
		if (array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER)
            && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                
            if (!array_key_exists('status', $this->ajax_res)) {
                $this->ajax_res['status'] = '0';
            }
            
            if (!array_key_exists($this->ajax_res['status'], $this->res_message)) {
                $this->ajax_res['message'] = 'Внутренняя ошибка'; 
            } else {
                $this->ajax_res['message'] = $this->res_message[$this->ajax_res['status']];
            }
            
            header('Content-type: application/json; charset=utf-8');

            die(trim(json_encode($this->ajax_res)));
        }
	}

//абстрактная фунция основного контента страницы
	abstract function get_content();
}
?>
