<?php

class transactions extends model
{
    private $users;

    public function __construct()
    {
        parent::__construct();
        $this->users = new users();
    }

    public function get_user_balance($user_id)
    {
        $user_accounts = $this->users->get_user_accounts($user_id);
        $user_transactions= $this->get_user_transactions($user_id);
        $balances=[];

        if(count($user_transactions)>0){
            foreach ($user_transactions as $month=>$transactions){
                $balance=0;
                for($i=0; $i<count($transactions); $i++){
                    if(in_array($transactions[$i]['account_from'], $user_accounts)){
                        $balance=$balance-$transactions[$i]['amount'];
                    }else{
                        $balance=$balance+$transactions[$i]['amount'];
                    }
                }
                $balances[]=[$month=>$balance];
            }
        }
        return $balances;
    }

    public function get_user_transactions($user_id)
    {
        $result=[];

        //Запрос предоставляет информацию по транзакциям пользователя.
        //Исключает транзакции между своими счетами пользователя
        $sql="select d.id, d.account_from, d.account_to, d.amount, 
        EXTRACT(MONTH FROM d.trdate) AS month FROM transactions d 
        WHERE id NOT IN (select a.id FROM transactions a CROSS JOIN (SELECT id FROM `user_accounts` WHERE `user_id`=$user_id) b 
        ON a.account_from=b.id 
        CROSS JOIN (SELECT id FROM `user_accounts` WHERE `user_id`=$user_id) c 
        ON a.account_to=c.id) 
        and ( account_from in (SELECT id FROM `user_accounts` WHERE `user_id`=$user_id) OR account_to in (SELECT id FROM `user_accounts` WHERE `user_id`=$user_id) )";

        $query = $this->mysqli->query($sql);
        while($res=$query->fetch_assoc()){
            $month=$res['month'];
            $result[$month][]=$res;
        }
        return $result;
    }
}