<?php
include "api.php";

$db = new DB();
if (isset($_POST['create'])) {
    
    $sql = "select * from users where email = '{$_POST['email']}'";
    $student =  $db->getRow($sql);
    $error_msg = "";

    if ($_POST['name'] == "")  $error_msg .= "Name is required";
    else if ($_POST['email'] == "") $error_msg .= "Email is required";
    else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))$error_msg .= "Invalid email format";
    else if($_POST['student_mobile'] == "") $error_msg .= "Mobile is required";
    else if (!empty($student)) $error_msg .= "Email already exists";
    
    if ($error_msg != "") {
        $response = [
            'error' => 1,
            'error_msg' => $error_msg,
        ];
        lib()->apiBack($response);
        return;
    }
    $password = lib()->createRandomPassword(6);
    $response = user()->create([
        'name'  => $_POST['name'],
        'email'  => $_POST['email'],
        'password' => md5($password),
        'user_type' => "student",
    ]);
    
    $userId = $response['insert_id'];
    $response = student()->create([
        'user_id' => $userId,
        'student_mobile' => $_POST['student_mobile'],
        'student_name' => $_POST['name'],
        'password' => $password,
    ]);
    lib()->apiBack($response);
}

if (isset($_POST['update'])) {
    $studentid = $_POST['student_id'];
    $sutdent = student()->get($studentid);

    $sql = "select * from users where email = '{$_POST['email']}' and user_id != '{$sutdent['user']['user_id']}'";

    $existingUser =  $db->getRow($sql);
    $error_msg = "";

    if ($_POST['name'] == "")  $error_msg .= "Name is required";
    else if ($_POST['email'] == "") $error_msg .= "Email is required";
    else if ($_POST['password'] == "") $error_msg .= "Password is required";
    else if(strlen($_POST['password']) < 6)$error_msg .= "Password length must be 6";
    else if($_POST['student_mobile'] == "") $error_msg .= "Mobile is required";
    else if (!empty($existingUser)) $error_msg .= "Email already exists";

    if ($error_msg != "") {
        $response = [
            'error' => 1,
            'error_msg' => $error_msg,
        ];
        lib()->apiBack($response);
        return;
    }

    $response = student()->update([
        'student_id' => $_POST['student_id'],
        'student_mobile' => $_POST['student_mobile'],
        'student_name' => $_POST['name'],
        'password' => $_POST['password'],
    ]);

    $response = user()->update([
        'user_id' => $sutdent['user']['user_id'],
        'name'  => $_POST['name'],
        'email'  => $_POST['email'],
        'password' => md5($_POST['password']),
    ]);

    lib()->apiBack($response);
}

if (isset($_GET['delete'])) {
    $stuednt = student()->get($_GET['delete']);
    $response = student()->delete([
        'student_id' => $_GET['delete'],
    ]);
    $response = user()->delete([
        'user_id' => $stuednt['user']['user_id'],
    ]);
    lib()->apiBack($response);
}
