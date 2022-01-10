<?php 

$studentId = isset($_GET['student_id']) ? $_GET['student_id'] : "";
$courseId = isset($_GET['course_id']) ? $_GET['course_id'] : "";
$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : "";
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : "";

include "view/admin/report/all.php";

?>

<script type="text/javascript">
	window.print();
	setTimeout(function () { window.close(); }, 500);
</script>