<?php

class DB
{
    public $host = 'localhost';
    public $user = 'root';
    public $pass = '';
    public $db   = 'attendence_system';
    public $result;
    public $conn;
    public $isLoggedIn;
    public $userRole;

    //conection start
    public function __construct()
    {
        $this->connection();
        date_default_timezone_set('Asia/Dhaka');
    }

    public function connection()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if (!$this->conn) {
            echo "Conection failed";
        }
    }

    public function buildSqlString($string)
    {
        return mysqli_real_escape_string($this->conn, $string);
    }

    public function select($sql)
    {
        $this->result = mysqli_query($this->conn, $sql);
        return $this->result;
    }

    public function getSelectLastId($query)
    {

        if (mysqli_query($this->conn, $query)) {
            return mysqli_insert_id($this->conn);
        } else {
            0;
        }

    }

    public function getRow($sql)
    {
        $data = $this->get($sql);
        if (isset($data[0])) {
            $data = $data[0];
        }

        return $data;
    }

    public function get($sql, $json = false)
    {
        $data = $this->getSqlArray($sql);
        return $json ? json_encode($data) : $data;
    }

    public function delete($table, $data)
    {
        $sql   = $this->buildDeleteSql($data, $table);
        $res   = $this->select($sql);
        $error = mysqli_error($this->conn);

        $response = [
            'error' => 0,
            'error_msg' => "Record Deleted Successfully !!"
        ];

        if ($error) {
            $response = [
                'error'         => 1,
                'error_message' => mysqli_error($this->conn),
            ];
        }

        return $response;
    }

    public function update($table, $data)
    {
        $sql = $this->buildUpdateSql($data, $table);
        $res = $this->select($sql);

        $error    = mysqli_error($this->conn);
        $response = [
            'error' => 0,
            'error_msg' => "Record Updated Successfully !!"
        ];

        if ($error) {
            $response = [
                'error'         => 1,
                'error_msg' => mysqli_error($this->conn),
            ];
        }
        return $response;
    }

    public function insert($table, $data)
    {
        $sql = $this->buildInsertSql($data, $table);
        $res = $this->select($sql);

        $error = mysqli_error($this->conn);

        $response = [
            'error' => 0,
            'error_msg' => "Record Inserted Successfully !!"
        ];

        if ($error) {
            $response = [
                'error'         => 1,
                'error_msg' => mysqli_error($this->conn),
            ];
        }

        if (isset($this->conn->insert_id)) {
            $response['insert_id'] = $this->conn->insert_id;
        }

        return $response;
    }

    public function processMysqlArray($info)
    {
        $res = array();
        $c   = 0;
        foreach ($info as $key => $value) {
            if ($c % 2 == 1) {
                $res[$key] = $value;
            }

            $c++;
        }
        return $res;
    }

    public function getSqlArray($sql)
    {
        $info = array();
        $res  = $this->select($sql);
        while ($row = mysqli_fetch_array($res)) {
            $sub = array();
            $sub = $this->processMysqlArray($row);
            array_push($info, $sub);
        }
        return $info;
    }

    public function makeJsonMsg($error, $msg)
    {
        $data          = array();
        $data['error'] = $error;
        $data['msg']   = $msg;
        return json_encode($data);
    }

    public function buildInsertSql($arr, $table)
    {
        $sql = "";
        $sql .= "INSERT INTO " . $table;
        $sql .= " (" . implode(",", array_keys($arr)) . ") VALUES ";
        $sql .= " ('" . implode("','", array_values($arr)) . "')";
        return $sql;
    }

    public function buildUpdateSql($arr, $table)
    {
        $pk  = $this->getPk($table);
        $sql = "";
        $sql .= "UPDATE " . $table . " SET ";
        $condition = "";
        $size      = sizeof($arr);
        $c         = 0;
        foreach ($arr as $key => $value) {
            $condition .= $key . "='" . $value . "'";
            if ($c != $size - 1) {
                $condition .= ",";
            }

            $c++;
        }
        $sql .= $condition;
        $sql .= " WHERE $pk=" . $arr[$pk];
        return $sql;
    }

    public function buildDeleteSql($arr, $table)
    {

        $sql  = "DELETE FROM $table WHERE ";
        $size = sizeof($arr);
        $c    = 0;

        foreach ($arr as $key => $value) {
            $sql .= $key . "='" . $value . "'";
            if ($c != $size - 1) {
                $sql .= " and ";
            }

            $c++;
        }
        return $sql;

    }

    public function getPk($table_name)
    {

        $sql = "SHOW KEYS FROM $table_name WHERE Key_name = 'PRIMARY'";
        $res = $this->get($sql);
        $pk  = $res[0]['Column_name'];
        return $pk;
    }

}
