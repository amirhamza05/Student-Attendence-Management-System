<?php 
	include "header.php";
	if(!auth()->check()){
		lib()->redirect("login.php");
	}
	else{
		if(auth()->type() == "admin")include "view/admin/report/report.php";
		else include "view/student/report/report.php";
	}