<?php 
  $student = student()->get($_GET['edit']);
  if(empty($student)){
    echo "<h1>Course is not found</h1>";
    exit;
  }
?>

<div class="row">
	<div class="col-md-6">
<?php lib()->formResponse();?>
<form action="api/student.php" method="post">
    <input type="number" hidden value="<?php echo $student['student_id'] ?>" name="student_id">
            <div class="form-group">
                <label>Student Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Student Name" value="<?php echo $student['student_name'] ?>">
            </div>

            <div class="form-group">
                <label>Student Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Student Email" value="<?php echo $student['user']['email'] ?>">
            </div>
            <div class="form-group">
                <label>Student Mobile</label>
                <input type="text" name="student_mobile" class="form-control" placeholder="Enter Student Mobile" value="<?php echo $student['student_mobile'] ?>">
            </div>
            <div class="form-group">
                <label>Student Password</label>
                <input type="text" name="password" id="password_field" class="form-control" placeholder="Enter Student Password" value="<?php echo $student['password'] ?>">
                <button type="button" onclick="genRandomPassword()" class="btn btn-sm btn-dark" style="margin-top: 5px;">Make Random Password</button>
            </div>

            <button type="submit" name="update" class="btn btn-primary">Update Student</button>
        </form>

</div>
</div>


<script type="text/javascript">
    function genRandomPassword(){
        let length = prompt("Please enter length of password", "6");
        if(length == null)return;

        if(length < 6 || length > 20){
            alert("Password length must be 6 to 20");
            return;
        }

        var result           = '';
        var characters       = '0123456789abcdefghijklmnopqrstuvwxyz';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        document.getElementById("password_field").value = result;

    }
</script>