<?php 
	include "view/layout/login/header.php";
?>

<div class="row" style="margin-top: 20px">
	<div class="col-md-3"></div>
	<div class="col-md-6">

<?php lib()->formResponse(); ?>
<form action="api/login.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email Address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <button type="submit" name="login" class="btn btn-primary">Submit</button>
</form>

	</div>
</div>


<?php 
	include "view/layout/login/footer.php";
?>