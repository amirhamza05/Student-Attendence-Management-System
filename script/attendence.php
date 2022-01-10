<?php

class Attendence
{
    public $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function create($courseId, $date, $status)
    {
        if ($this->isAlreadyTaken($courseId, $date) == 1) {
            return [
                'error'     => 1,
                'error_msg' => 'Attendence Already Taken',
            ];
        }

        $attendenceData = $this->db->insert("attendence", [
            'course_id'       => $courseId,
            'attendence_date' => $date,
        ]);

        foreach ($status as $key => $value) {
            $this->db->insert('attendence_status', [
                'attendence_id' => $attendenceData['insert_id'],
                'student_id'    => $key,
                'status'        => $value,
            ]);
        }

        return [
            'error'     => 0,
            'error_msg' => 'Attendence Successfully Taken',
        ];
    }

    public function update($status){
    	foreach ($status as $key => $value) {
            $this->db->update('attendence_status', [
                'attendence_status_id' => $key,
                'status'        => $value,
            ]);
        }

        return [
            'error'     => 0,
            'error_msg' => 'Attendence Successfully Updated',
        ];
    }

    public function isAlreadyTaken($courseId, $date)
    {
        $data = $this->getAttendenceFromDate($courseId, $date);
        return empty($data) ? 0 : 1;
    }

    public function getAttendenceFromDate($courseId, $date)
    {
        $sql  = "select * from attendence where course_id='{$courseId}' and attendence_date = '{$date}'";
        $data = $this->db->getRow($sql);
        return $data;
    }

    public function getStatusList($courseId, $date)
    {
    	$data = $this->getAttendenceFromDate($courseId, $date);
    	$attendenceId = $data['attendence_id'];
    	$sql = "select attendence_status_id, attendence_status.student_id, student_name, status from attendence_status INNER JOIN students ON students.student_id = attendence_status.student_id where attendence_id = '{$attendenceId}'";
    	$data = $this->db->get($sql);
    	return $data;
    }
}

function attendence()
{
    return new Attendence();
}
