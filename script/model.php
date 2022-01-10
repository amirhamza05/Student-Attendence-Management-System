<?php

class Model
{
	public $db;

	function __construct()
	{
		$this->db = new DB();
	}

	public function create($data)
    {
        $error = $this->validate($data);
        if(!empty($error))return $error;
        $res = $this->db->insert($this->table, $data);
        return $res;
    }

    public function update($data)
    {
        $error = $this->validate($data);
        if(!empty($error))return $error;
        $res = $this->db->update($this->table, $data);
        return $res;
    }

    public function delete($data)
    {
        $res = $this->db->delete($this->table, $data);
        return $res;
    }

    public function all()
    {
        $sql  = "select * from ".$this->table;
        $data = $this->db->get($sql);
        return $data;
    }
}