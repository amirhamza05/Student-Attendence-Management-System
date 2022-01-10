<?php 
	include "header.php";
	if(!auth()->check()){
		lib()->redirect("login.php");
	}
	else{
		if(auth()->type() == "admin")include "view/admin/course/course.php";
		else include "view/student/course/course.php";
	}