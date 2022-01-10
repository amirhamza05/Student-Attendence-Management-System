<?php 
  $user = user()->get($_GET['edit']);
  if(empty($user) || $user['user_type'] == "student"){
    echo "<h1>User is not found</h1>";
    exit;
  }
?>

<div class="row">
	<div class="col-md-6">
<?php lib()->formResponse();?>
<form action="api/admin.php" method="post">
    <input type="number" hidden value="<?php echo $user['user_id'] ?>" name="user_id">
            <div class="form-group">
                <label>User Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Admin Name" value="<?php echo $user['name'] ?>">
            </div>

            <div class="form-group">
                <label>Student Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Admin Email" value="<?php echo $user['email'] ?>">
            </div>

            <button type="submit" name="update" class="btn btn-primary">Update Student</button>
        </form>

</div>
</div>

