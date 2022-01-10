
<?php lib()->formResponse();?>
<form action="api/attendence.php" method="post">
<input type="number" name="course_id" value="<?php echo $selectedCourse; ?>" hidden>
<input type="date" name="attendence_date" value="<?php echo $selectedAttendenceDate; ?>" hidden>
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
      foreach ($courseStudents as $key => $student) {
        $studentId = $student['student_id'];
    ?>
    <tr>
      <th scope="row"><?php echo $student['student_id']; ?></th>
      <td><?php echo $student['student_name']; ?></td>
      <td>
        <input required type="radio" id="present-<?php echo $studentId; ?>" value="present" name="status[<?php echo $studentId; ?>]"> <label for="present-<?php echo $studentId; ?>">Present</label> 
        <input required type="radio" id="absent-<?php echo $studentId; ?>" value="absent" name="status[<?php echo $studentId; ?>]"> <label for="absent-<?php echo $studentId; ?>">Absent</label> 
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>
<div class="float-right">
  <button type="submit" name="save_attendence" class="btn btn-primary">Create New Attendence</button>
</div>
</form>