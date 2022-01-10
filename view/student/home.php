<?php 
	include "view/layout/student/header.php";
?>
<div class="row">
	<div class="col-md-4">
		<div class="card bg-light mb-3">
  			<div class="card-header">Total Courses</div>
  			<div class="card-body">
    			<h1 class="card-title"><?php echo report()->totalCourseByStudents(); ?></h1>
 			</div>
		</div>
	</div>
</div>

<?php 

	$data = auth()->user();

?>

<table class="table table-bordered" style="width: 45%">
    <tr>
      <th scope="col" style="width: 40%">ID</th>
      <td ><?php echo $data['student']['student_id']; ?></td>
    </tr>
    <tr>
      <th scope="col" style="width: 40%">Name</th>
      <td ><?php echo $data['student']['student_name']; ?></td>
    </tr>
    <tr>
      <th scope="col" style="width: 40%">Email</th>
      <td ><?php echo $data['email']; ?></td>
    </tr>
    <tr>
      <th scope="col" style="width: 40%">Mobile</th>
      <td ><?php echo $data['student']['student_mobile']; ?></td>
    </tr>
</table>

<?php include "view/layout/student/footer.php" ?>