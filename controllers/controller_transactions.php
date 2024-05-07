<?php

class Controller_transactions extends Controller
{
    private $transactions;
    function __construct()
    {
        //инициализация виевера
        $this->view = new View_index();
        $this->transactions= new transactions();
    }
    public function action_view()
    {
        return false;
    }

    public function action_get_user_balances()
    {
        $res['status'] = 1;
        if(filter_var($_GET['user_id'], FILTER_VALIDATE_INT)){
            $user_id = $_GET['user_id'];
            $res['data'] = $this->transactions->get_user_balance($user_id);
        }else{
            $res['status'] = 4;
        }


        $this->view->__set('ajax_res', $res)->get_ajax();
    }

}