
<?php lib()->formResponse();?>
<form action="api/attendence.php" method="post">
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Student Id</th>
      <th scope="col">Student Name</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php 
      foreach ($attendenceStatus as $key => $student) {
        $studentId = $student['student_id'];
        $attendenceId = $student['attendence_status_id'];
    ?>
    <tr>
      <th scope="row"><?php echo $student['student_id']; ?></th>
      <td><?php echo $student['student_name']; ?></td>
      <td>
        <input required type="radio" id="present-<?php echo $attendenceId; ?>" value="present" name="status[<?php echo $attendenceId; ?>]" <?php echo $student['status'] == "present" ? "checked" : ""; ?> > <label for="present-<?php echo $attendenceId; ?>">Present</label> 
        <input required type="radio" id="absent-<?php echo $attendenceId; ?>" value="absent" name="status[<?php echo $attendenceId; ?>]" <?php echo $student['status'] == "absent" ? "checked" : ""; ?> > <label for="absent-<?php echo $attendenceId; ?>">Absent</label> 
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>
<div class="float-right">
  <button type="submit" name="update_attendence" class="btn btn-primary">Update Attendence</button>
</div>
</form>