<?php

class Student extends Model
{
	public $table = "students";
    protected $user;
    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
    }
	public function get($studentId)
    {
        $sql = "select * from students where student_id = '{$studentId}'";
        
        $student =  $this->db->getRow($sql);
        if(empty($student))return $student;
        $student['user'] = $this->user->getUser($student['user_id']);
        return $student;
    }

    public function getStudentByUser(){
        
    }

    public function validate($data)
    {
    	
    }
}

function student()
{
    return new Student();
}