<?php

class User extends Model
{
    public $table = "users";

    public function getUser($userId)
    {
        $sql  = "select * from users where user_id = {$userId}";
        $data = $this->db->getRow($sql);
        return $data;
    }

    public function get($userId)
    {
        $sql  = "select * from users where user_id = {$userId}";
        $data = $this->db->getRow($sql);
        if ($data['user_type'] == "student") {
            $data['student'] = $this->getStudent($userId);
        }
        return $data;
    }

    public function getStudent($userId)
    {
        $sql  = "select * from students where user_id = {$userId}";
        $data = $this->db->getRow($sql);
        return $data;
    }

    public function validate($data)
    {
        return [];
    }

    public function process($data)
    {

    }
}

function user()
{
    return new User();
}
