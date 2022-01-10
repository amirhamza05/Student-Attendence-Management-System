<?php 
	include "header.php";
	if(!auth()->check()){
		lib()->redirect("login.php");
	}
	else{
		if(auth()->type() == "admin")include "view/admin/attendence/attendence.php";
		else include "view/student/home.php";
	}