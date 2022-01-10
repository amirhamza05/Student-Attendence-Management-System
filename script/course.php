<?php

class Course extends Model
{
    public $table = "courses";

    public function admit($courseId, $studentId)
    {
        $student = student()->get($studentId);
        if(empty($student)){
            return [
                'error' => 1,
                'error_msg' => "Student id is not valid"
            ];
        }
        if($this->isStudentAlreadyAdmit($courseId, $studentId)){
            return [
                'error' => 1,
                'error_msg' => "This student already added in this course"
            ];
        }
        $res = $this->db->insert("admit", [
            'course_id' => $courseId,
            'student_id' => $studentId,
        ]);
        return $res;
    }

    public function admitDelete($courseId, $studentId)
    {
        $res = $this->db->delete("admit", [
            'course_id' => $courseId,
            'student_id' => $studentId,
        ]);
        return $res;
    }

    public function isStudentAlreadyAdmit($courseId, $studentId){
        $sql = "select * from admit where course_id = '{$courseId}' and student_id = '{$studentId}'";
        $data = $this->db->getRow($sql);
        return !empty($data) ? 1 : 0;
    }


    public function getCouseListByStudent(){
        $studentId = auth()->user()['student']['student_id'];
        $sql = "select courses.course_id,course_code,course_name,section_name,semester from admit inner join courses on admit.course_id = courses.course_id where admit.student_id = {$studentId}";
        $data = $this->db->get($sql);
        return $data;
    }


    public function students($courseId){
        $sql = "select students.student_name, students.student_id from admit INNER JOIN students ON students.student_id=admit.student_id where course_id='{$courseId}'";
        return $this->db->get($sql);
    }

    public function validate($data)
    {
        $error = "";
        if($data['course_name'] == "")$error = "Course Name is required";
        else if($data['course_code'] == "")$error = "Course Code is required";
        else if($data['section_name'] == "")$error = "Section Name is required";
        else if($data['semester'] == "")$error = "Semester is required";

        if($error != "")return [
            'error' => 1,
            'error_msg' => $error
        ];
        return [];
    }

    public function get($courseId)
    {
        $sql = "select * from courses where course_id = '{$courseId}'";
        return $this->db->getRow($sql);
    }
}

function course()
{
    return new Course();
}
