<?php include "view/layout/admin/header.php"; 

$courses = course()->all();

$studentId = isset($_GET['student_id']) ? $_GET['student_id'] : "";
$courseId = isset($_GET['course_id']) ? $_GET['course_id'] : "";
$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : "";
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : "";


?>


<form style="margin-top: 15px;margin-bottom: 15px;">
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
    			<label>Student Id</label>
    			<input type="number" class="form-control" value="<?php echo $studentId; ?>" name="student_id">
  			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
    			<label for="exampleInputEmail1">Select Couse</label>
    			<select class="form-control" name="course_id" required="">
					<option value="">Select Course</option>
					<?php 
						foreach ($courses as $key => $course) {
							$selected = $courseId == $course['course_id'] ? "selected" : "";
							echo "<option value='{$course['course_id']}' {$selected}>{$course['course_name']} ({$course['course_code']})</option>";
						}
					?>
				</select>
  			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
    			<label>Start Date</label>
    			<input required="" type="date" class="form-control" value="<?php echo $startDate; ?>" name="start_date">
  			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
    			<label>End Date</label>
    			<input required="" type="date" class="form-control" value="<?php echo $endDate; ?>" name="end_date">
  			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group" style="text-align: center;">
    			<button class="btn btn-primary" name="take_attendence" value="true">Generate Attendence Report</button>
  			</div>
		</div>
	</div>
</form>




<?php 

	if(!($courseId == "" || $startDate == "" || $endDate == "")){
		$par = "";
		foreach ($_GET as $key => $value) {
			if($par != "")$par .= "&";
			$par .= $key."=".$value;
		}
		echo "<a target='_blank' class='btn btn-info' href='print_report.php?{$par}'>Print Report</a>";
	}

	include "view/admin/report/all.php";
	include "view/layout/admin/footer.php"; 
?>