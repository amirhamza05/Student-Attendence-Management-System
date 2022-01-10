<div class="row">
	<div class="col-md-6">
<?php lib()->formResponse();?>
<form action="api/course.php" method="post">
  <div class="form-group">
    <label>Course Name</label>
    <input type="text" name="course_name" class="form-control" placeholder="Enter Course Name">
  </div>

  <div class="form-group">
    <label>Course Code</label>
    <input type="text" name="course_code" class="form-control" placeholder="Enter Course Code">
  </div>

  <div class="form-group">
    <label>Section Name</label>
    <input type="text" name="section_name" class="form-control" placeholder="Enter Section Name">
  </div>

  <div class="form-group">
    <label>Semester</label>
    <input type="text" name="semester" class="form-control" placeholder="Enter Semester">
  </div>


  <button type="submit" name="create" class="btn btn-primary">Create New Course</button>
</form>

</div>
</div>