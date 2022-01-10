<?php
include "api.php";

$db = new DB();
if (isset($_POST['create'])) {
    
    $sql = "select * from users where email = '{$_POST['email']}'";
    $users =  $db->getRow($sql);
    $error_msg = "";

    if ($_POST['name'] == "")  $error_msg .= "Name is required";
    else if ($_POST['email'] == "") $error_msg .= "Email is required";
    else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))$error_msg .= "Invalid email format";
    else if ($_POST['password'] == "") $error_msg .= "Password is required";
    else if(strlen($_POST['password']) < 6)$error_msg .= "Password length must be 6";
    else if (!empty($users)) $error_msg .= "Email already exists";
    
    if ($error_msg != "") {
        $response = [
            'error' => 1,
            'error_msg' => $error_msg,
        ];
        lib()->apiBack($response);
        return;
    }

    $response = user()->create([
        'name'  => $_POST['name'],
        'email'  => $_POST['email'],
        'password' => md5($_POST['password']),
        'user_type' => "admin",
    ]);
    
    lib()->apiBack($response);
}

if (isset($_POST['update'])) {
    $userId = $_POST['user_id'];
    $user = user()->get($userId);

    $sql = "select * from users where email = '{$_POST['email']}' and user_id != '{$user['user_id']}'";

    $existingUser =  $db->getRow($sql);
    $error_msg = "";

    if ($_POST['name'] == "")  $error_msg .= "Name is required";
    else if ($_POST['email'] == "") $error_msg .= "Email is required";
    else if (!empty($existingUser)) $error_msg .= "Email already exists";

    if ($error_msg != "") {
        $response = [
            'error' => 1,
            'error_msg' => $error_msg,
        ];
        lib()->apiBack($response);
        return;
    }


    $response = user()->update([
        'user_id' => $user['user_id'],
        'name'  => $_POST['name'],
        'email'  => $_POST['email'],
    ]);

    lib()->apiBack($response);
}

if (isset($_GET['delete'])) {

    $response = user()->delete([
        'user_id' => $_GET['delete'],
    ]);
    lib()->apiBack($response);
}
