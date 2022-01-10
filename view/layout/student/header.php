<!DOCTYPE html>
<html>
<head>
	<title>Attendence Management System</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<style type="text/css">
	.container-header{
		background-color: #f8f9fa;
		color: #353b48;
		font-size: 20px;
		padding: 10px;
		font-weight: bold;
		border-bottom: 1px solid #f5f5f5;
	}
	body{
		background-color: #aaaaaa;
		
	}
	.container-body{
		background-color: #ffffff;
		border: 1px solid #eeeeee; 
		min-height: 615px;
		padding: 20px;
		box-shadow: 1 1 3px 3px #aaaaaa;
	}

	.table th{
		background-color: #f8f8f8;
	}

	.navbar li{
		border: 1px solid #eeeeee;
		background-color: #f3f3f3;
		color: #353b48;
		font-weight: bold;
		border-radius: 5px;
		padding: 0px 10px 0px 10px;
		margin-right: 5px;
	}

</style>

<body>

	<div class="container">
		<div class="container-header">
			Attendence Management System<br/>
			<font size="3px;" color="#718093">Student Panel</font>
		</div>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="course.php">Course</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="report.php">Report</a>
      </li>
      
    </ul>
    <ul class="navbar-nav ml-auto">
    	<li class="nav-item">
        	<a class="nav-link" href="logout.php">Logout</a>
      	</li>
      	<li class="nav-item">
        	<a class="nav-link disabled" href=""><?php echo auth()->user()['email']; ?></a>
      	</li>
  	</ul>
  </div>
</nav>

	<div class="container-body" style="">
			
		