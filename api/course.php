<?php
include "api.php";

if (isset($_POST['create'])) {
    $response = course()->create([
        'course_name'  => $_POST['course_name'],
        'course_code'  => $_POST['course_code'],
        'section_name' => $_POST['section_name'],
        'semester'     => $_POST['semester'],
    ]);
    lib()->apiBack($response);
}

if (isset($_GET['delete'])) {
    $response = course()->delete([
        'course_id' => $_GET['delete'],
    ]);
    lib()->apiBack($response);
}

if (isset($_POST['update'])) {
    $response = course()->update([
        'course_id'    => $_POST['course_id'],
        'course_name'  => $_POST['course_name'],
        'course_code'  => $_POST['course_code'],
        'section_name' => $_POST['section_name'],
        'semester'     => $_POST['semester'],
    ]);
    lib()->apiBack($response);
}


if(isset($_POST['admit_student'])){
    $response = course()->admit($_POST['course_id'], $_POST['student_id']);
    lib()->apiBack($response, "admit_area");
}

if(isset($_POST['delete_admit'])){
    $response = course()->admitDelete($_POST['course_id'], $_POST['student_id']);
    lib()->apiBack($response, "admit_area");
}