<?php

class Controller_index extends Controller
{
    private $users;
    function __construct()
    {
        //инициализация виевера
        $this->view = new View_index();
        $this->users= new users();
    }

    function action_view()
    {
        $this->view->get_body();
    }

    function action_get_users_list(){
        $res['status'] = 1;
        $users_list=$this->users->get_users_list();
        if(count($users_list) > 0){
            $res['data'] = $users_list;
        }else{
            $res['status'] = 2;
        }
        $this->view->__set('ajax_res', $res)->get_ajax();
    }
}