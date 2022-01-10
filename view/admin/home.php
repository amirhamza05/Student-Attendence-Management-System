<?php 
	include "view/layout/admin/header.php";
?>
<div class="row">
	<div class="col-md-4">
		<div class="card bg-light mb-3">
  			<div class="card-header">Total Courses</div>
  			<div class="card-body">
    			<h1 class="card-title"><?php echo report()->totalCourse(); ?></h1>
 			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card bg-light mb-4">
  			<div class="card-header">Total Students</div>
  			<div class="card-body">
    			<h1 class="card-title"><?php echo report()->totalStudent(); ?></h1>
 			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card bg-light mb-3" >
  			<div class="card-header">Total Admin</div>
  			<div class="card-body">
    			<h1 class="card-title"><?php echo report()->totalAdmin(); ?></h1>
 			</div>
		</div>
	</div>
</div>


<?php include "view/layout/admin/footer.php" ?>