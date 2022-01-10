<?php
include "api.php";

if (isset($_POST['save_attendence'])) {
    $response = attendence()->create($_POST['course_id'], $_POST['attendence_date'], $_POST['status']);
    lib()->apiBack($response);
}

if (isset($_POST['update_attendence'])) {
    $response = attendence()->update($_POST['status']);
    lib()->apiBack($response);
}
