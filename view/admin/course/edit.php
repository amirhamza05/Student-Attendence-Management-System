<?php 
  $course = course()->get($_GET['edit']);
  if(empty($course)){
    echo "<h1>Course is not found</h1>";
    exit;
  }
?>

<div class="row">
	<div class="col-md-6">
<?php lib()->formResponse();?>
<form action="api/course.php"  method="post">
  <input type="number" hidden="" name="course_id" value="<?php echo $course['course_id']; ?>" name="">
  <div class="form-group">
    <label>Course Name</label>
    <input type="text" name="course_name" value="<?php echo $course['course_name']; ?>" class="form-control" placeholder="Enter Course Name">
  </div>

  <div class="form-group">
    <label>Course Code</label>
    <input type="text" name="course_code" value="<?php echo $course['course_code']; ?>" class="form-control" placeholder="Enter Course Code">
  </div>

  <div class="form-group">
    <label>Section Name</label>
    <input type="text" name="section_name" value="<?php echo $course['section_name']; ?>" class="form-control" placeholder="Enter Section Name">
  </div>

  <div class="form-group">
    <label>Semester</label>
    <input type="text" name="semester" value="<?php echo $course['semester']; ?>" class="form-control" placeholder="Enter Semester">
  </div>


  <button type="submit" name="update"  class="btn btn-primary">Update Course</button>
</form>

</div>
</div>