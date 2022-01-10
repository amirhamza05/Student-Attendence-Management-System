
<?php 
	$courses = course()->getCouseListByStudent();
?>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Course Code</th>
      <th scope="col">Course Name</th>
      <th scope="col">Section</th>
      <th scope="col">Semester</th>
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
    </tr>
    <?php } ?>
  </tbody>
</table>
