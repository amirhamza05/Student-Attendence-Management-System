<?php 
  $course = course()->get($_GET['show']);
  if(empty($course)){
    echo "<h1>Course is not found</h1>";
    exit;
  }
?>

<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered">
			<tr>
				<th scope="col">Course Code</th>
				<th scope="col">Course Name</th>
				<th scope="col">Section Name</th>
				<th scope="col">Semester</th>
			</tr>
			<tr>
				<td><?php echo $course['course_code']; ?></td>
				<td><?php echo $course['course_name']; ?></td>
				<td><?php echo $course['section_name']; ?></td>
				<td><?php echo $course['semester']; ?></td>
			</tr>
		</table>
	</div>
	<div class="col-md-6" style="border: 1px solid #eeeeee;padding: 5px;">
		<form action="api/course.php" method="post">
			<?php lib()->formResponse("admit_area"); ?>
			<div class="form-group">
				<input type="number" hidden="" value="<?php echo $course['course_id']; ?>" name="course_id">
    			<input type="text" name="student_id" placeholder="Enter Student Id">
    			<button type="submit" name="admit_student" class="btn btn-primary">Add Student</button>
  			</div>
			
		</form>
		<table class="table table-bordered">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Student Id</th>
				<th scope="col">Student Name</th>
				<th scope="col"></th>
			</tr>

			<?php 
				$students = course()->students($course['course_id']);
				foreach ($students as $key => $student) {
			?>
			<tr>
				<td scope="col"><?php echo $key+1; ?></td>
				<td><?php echo $student['student_id']; ?></td>
				<td><?php echo $student['student_name']; ?></td>
				<td>
					<form action="api/course.php" method="post">
						<input type="number" name="student_id" value="<?php echo $student['student_id'] ?>" hidden>
						<input type="number" name="course_id" value="<?php echo $course['course_id'] ?>" hidden>
						<button type="submit" name="delete_admit" class="btn btn-sm btn-danger">Delete</button>
					</form>
				</td>
			</tr>

			<?php } ?>
		</table>
	</div>
</div>


