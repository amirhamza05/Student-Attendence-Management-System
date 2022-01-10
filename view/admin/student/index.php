<?php
$students = student()->all();

?>

<?php lib()->formResponse(); ?>
<div class="float-right" style="margin-bottom: 15px;">
  <a href="?create=true" class="btn btn-primary">Create Student</a>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Student Name</th>
      <th scope="col">Student Mobile</th>
      <th scope="col">Student Email</th>
      <th scope="col">password</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($students as $key => $student) { 
      $student = student()->get($student['student_id']);
      ?>
      <tr>
        <th scope="row"><?php echo $student['student_id']; ?></th>
        <td><?php echo $student['student_name']; ?></td>
        <td><?php echo $student['student_mobile']; ?></td>
        <td><?php echo $student['user']['email']; ?></td>
        <td><?php echo $student['password']; ?></td>
        <td style="text-align: center;">
          <a href="?edit=<?php echo $student['student_id']; ?>" class="btn btn-sm btn-success">Edit</a>
          <button onclick="deletePermission(<?php echo $student['student_id']; ?>)" class="btn btn-sm btn-danger">Delete</button>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<script type="text/javascript">
  function deletePermission(student_id){
    let ok = confirm("Are you want to delete this student?");
    if(!ok)return;
    window.location = "api/student.php?delete="+student_id;
  }
</script>