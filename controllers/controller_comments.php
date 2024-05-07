<?php
//Контроллер страницы "Комментарии"
class Controller_comments extends Controller
{
	function __construct()
    {
        //инициализация виевера
        $this->view = new View_comments();
		//инициализация модели
        $this->model = new comments();
    }
	
	 // просмотр
    function action_view()
    {

       // $res=['comments'=>$this->model->get_comments()];
        $result=[];
        $arr=[10,11];
        $db=Database::getInstance()->getConnection();
        //$this->mysqli=$this->db->getConnection();
        $sql="
        select d.id, d.account_from, d.account_to, d.amount, 
        EXTRACT(MONTH FROM d.trdate) AS month FROM transactions d 
        WHERE id NOT IN (select a.id FROM transactions a CROSS JOIN (SELECT id FROM `user_accounts` WHERE `user_id`=10) b 
        ON a.account_from=b.id 
        CROSS JOIN (SELECT id FROM `user_accounts` WHERE `user_id`=10) c 
        ON a.account_to=c.id) 
        and ( account_from in (SELECT id FROM `user_accounts` WHERE `user_id`=10) OR account_to in (SELECT id FROM `user_accounts` WHERE `user_id`=10) )
        ";
        $query=$db->query($sql);
        while($res=$query->fetch_assoc()){

            $result[$res['month']][]=$res;
        }
        $balance_arr=[];
        foreach ($result as $key=>$val){
            $balance=0;
            for($i=0; $i<count($val); $i++){
                if(in_array($val[$i]['account_from'], $arr)){
                    $balance=$balance-$val[$i]['amount'];
                }else{
                    $balance=$balance+$val[$i]['amount'];
                }

            }
            $balance_arr[$key]=$balance;

        }

        $this->view->__set('result', $balance_arr)->get_body();
    }
	
	function action_add_comment(){
		$res['status'] = 1;
		if(empty($_POST['uname']) || empty($_POST['comment'])){
			$res['status']=2;
			$this->view->__set('ajax_res', $res)->get_ajax();
			return false;
		}
		
		$uname=$_POST['uname'];
		$comment=$_POST['comment'];
		
		if(!$this->model->add_comment($uname, $comment)){
			$res['status'] = 3;
			$this->view->__set('ajax_res', $res)->get_ajax();
			return false;
		}
	
        $this->view->__set('ajax_res', $res)->get_ajax();
	}
	
}