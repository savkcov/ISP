<?php

class users extends model
{

    public function get_users_list()
    {
        $sql="SELECT DISTINCT a.id, a.name FROM users AS a
                INNER JOIN user_accounts AS b ON a.id=b.user_id";
        $query = $this->mysqli->query($sql);
        $result=[];
        while($res=$query->fetch_assoc()){
            $result[]=$res;
        }
        return $result;
    }

    public function get_user_accounts($user_id)
    {
        $sql="SELECT id FROM user_accounts WHERE user_id=$user_id";
        $query = $this->mysqli->query($sql);
        $result=[];
        while($res=$query->fetch_assoc()){
            $result[]=$res['id'];
        }
        return $result;
    }
}