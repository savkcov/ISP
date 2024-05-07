<?php

class View_index extends View {
    public $page_title = 'Баланс по меяцам';
    public $page_name = 'Баланс по меяцам';

    public function get_content() {
        extract($this->res);
        include TPL_PATH."index.tpl";
    }

}