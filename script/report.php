<?php

class Report
{
    public $db;
    public function __construct()
    {
        $this->db = new DB();
    }

    public function getAllAttendence()
    {
        $sql  = "select student_id, student_name, (select count(*) from attendence_status WHERE attendence_status.student_id = students.student_id and status = 'present') as total_present , (select count(*) from attendence_status WHERE attendence_status.student_id = students.student_id and status = 'absent') as total_absent  from students";
        $data = $this->db->get($sql);
        return $data;
    }

    public function get($filter){
    	$studentId = isset($filter['student_id']) ? $filter['student_id'] : "";
    	$startDate = isset($filter['start_date']) ? $filter['start_date'] : "";
    	$endDate = isset($filter['end_date']) ? $filter['end_date'] : "";
    	$courseId = isset($filter['course_id']) ? $filter['course_id'] : "";

    	if($studentId != "")$studentId = " and students.student_id = {$studentId}";

    	$sql = "select  attendence.attendence_id,students.student_id, students.student_name, attendence.attendence_date, status from attendence_status 
			INNER JOIN attendence ON attendence_status.attendence_id = attendence.attendence_id
			INNER JOIN students ON attendence_status.student_id = students.student_id
			WHERE attendence.course_id=$courseId $studentId
			and attendence.attendence_date BETWEEN '$startDate' AND '$endDate'
			ORDER by attendence.attendence_date ASC";

    	$datas = $this->db->get($sql);
    	
    	$reportData = [];
    	$studentNames = [];
    	$attendenceState = [];

    	foreach ($datas as $key => $data) {

    		$attendenceDate = $data['attendence_date'];
    		$status = $data['status'];
    		$studentId = $data['student_id'];
    		$studentName = $data['student_name'];
    		$year = date('Y', strtotime($attendenceDate));
    		$month = date('m', strtotime($attendenceDate));
    		$day = date('d', strtotime($attendenceDate));

    		if(!isset($attendenceState[$studentId])){
    			$attendenceState[$studentId] = [
    				'absent' => 0,
    				'present' => 0
    			];
    		}

    		$attendenceState[$studentId][$status] += 1;

    		$studentNames[$studentId] = $studentName;
    		$reportData[$year][(int)$month][(int)$studentId][(int)$day] = $status;
    	}

        $tmpAttendenceStat = [];

        foreach ($attendenceState as $key => $value) {
            $value['student_id'] = $key;
            array_push($tmpAttendenceStat, $value);
        }

        

        if (!empty($tmpAttendenceStat)) {
            usort($tmpAttendenceStat, function ($a, $b) use ($key) {
                if ($a['present'] == $b['present']) {
                    return $a['absent'] <=> $b['absent'];
                }

                return $b['present'] <=> $a['present'];
            });
        }

    	return [
    		'studentNames' => $studentNames,
    		'reportData' => $reportData,
    		'attendenceState' => $tmpAttendenceStat
    	];
    }

    public function totalCourseByStudents(){
    	$studentId = auth()->user()['student']['student_id'];
    	$sql = "select count(*) as total from admit where student_id={$studentId}";
    	$data = $this->db->getRow($sql);
    	return $data['total'];
    }

    public function totalCourse(){
    	$sql = "select count(*) as total from courses";
    	$data = $this->db->getRow($sql);
    	return $data['total'];
    }

    public function totalStudent(){
    	$sql = "select count(*) as total from students";
    	$data = $this->db->getRow($sql);
    	return $data['total'];
    }

    public function totalAdmin(){
    	$sql = "select count(*) as total from users where user_type='admin'";
    	$data = $this->db->getRow($sql);
    	return $data['total'];
    }
}

function report()
{
    return new Report();
}
