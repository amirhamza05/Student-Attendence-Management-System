
<?php 
	$courses = course()->all();
?>

<?php lib()->formResponse(); ?>
<div class="float-right" style="margin-bottom: 15px;">
	<a href="?create=true" class="btn btn-primary">Create Course</a>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Course Code</th>
      <th scope="col">Course Name</th>
      <th scope="col">Section</th>
      <th scope="col">Semester</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($courses as $key => $course) { ?>
    <tr>
      <th scope="row"><?php echo $key+1; ?></th>
      <td><?php echo $course['course_code']; ?></td>
      <td><?php echo $course['course_name']; ?></td>
      <td><?php echo $course['section_name']; ?></td>
      <td><?php echo $course['semester']; ?></td>
      <td style="text-align: center;">
        <a href="?show=<?php echo $course['course_id']; ?>" class="btn btn-sm btn-primary">Show</a>
        <a href="?edit=<?php echo $course['course_id']; ?>" class="btn btn-sm btn-success">Edit</a>
        <button onclick="deletePermission(<?php echo $course['course_id']; ?>)" class="btn btn-sm btn-danger">Delete</button>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>

<script type="text/javascript">
  function deletePermission(courseId){
    let ok = confirm("Are you want to delete this course?");
    if(!ok)return;
    window.location = "api/course.php?delete="+courseId;
  }
</script>