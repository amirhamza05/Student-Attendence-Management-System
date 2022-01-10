<?php
$courses = course()->all();

if (isset($_POST['take_attendence'])) {

}


$selectedCourse = isset($_GET['course_id']) ? $_GET['course_id'] : "";
$selectedAttendenceDate = isset($_GET['attendence_date']) ? $_GET['attendence_date'] : "";

?>


<form>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-3">
			<div class="form-group">
    			<label for="exampleInputEmail1">Select Couse</label>
    			<select class="form-control" name="course_id" required="">
					<option value="">Select Course</option>
					<?php 
						foreach ($courses as $key => $course) {
							$selected = $selectedCourse == $course['course_id'] ? "selected" : "";
							echo "<option value='{$course['course_id']}' {$selected}>{$course['course_name']} ({$course['course_code']})</option>";
						}
					?>
				</select>
  			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
    			<label>Attendence Date</label>
    			<input required="" type="date" class="form-control" value="<?php echo $selectedAttendenceDate; ?>" name="attendence_date">
  			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
    			<button class="btn btn-primary" name="take_attendence" value="true" style="margin-top: 30px;">Take Attendence</button>
  			</div>
		</div>
	</div>
</form>


<?php 
	if($selectedCourse != "" && $selectedAttendenceDate != ""){
		$courseStudents = course()->students($selectedCourse);
		if(attendence()->isAlreadyTaken($selectedCourse, $selectedAttendenceDate)){
			$attendenceStatus = attendence()->getStatusList($selectedCourse, $selectedAttendenceDate);
			include "view/admin/attendence/update_attendence.php";
		}
		else include "view/admin/attendence/take_attendence.php";
	}
?>