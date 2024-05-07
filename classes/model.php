<?php

class model{
    protected $db;
    protected $mysqli;
    function __construct()
    {
        $this->db=Database::getInstance();
        $this->mysqli=$this->db->getConnection();
    }
}