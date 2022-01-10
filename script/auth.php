<?php

class Auth
{
    public $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function login($data)
    {
        if (isset($data['password'])) {
            $data['password'] = md5($data['password']);
        }

        $sql      = "select * from users where email='{$data['email']}' and password='{$data['password']}'";
        $data     = $this->db->getRow($sql);

        $response = [
            'error'     => 1,
            'error_msg' => 'Invalid email or password',
        ];
        if (!empty($data)) {
            $_SESSION["user_id"] = $data['user_id'];
            $response            = [
                'error'     => 0,
                'error_msg' => "Successfully login",
            ];
        }
        return $response;
    }

    public function user()
    {
        if (!isset($_SESSION["user_id"])) {
            return [];
        }

        $userId = $_SESSION['user_id'];
        $data   = user()->get($userId);
        return $data;
    }

    public function check()
    {
        $userData = $this->user();
        return empty($userData) ? 0 : 1;
    }

    public function type()
    {
        $userData = $this->user();
        return !isset($userData['user_type']) ? -1 : $userData['user_type'];
    }

    public function logout()
    {
        if(isset($_SESSION['user_id']))unset($_SESSION['user_id']);
    }

}

function auth()
{
    return new Auth();
}
