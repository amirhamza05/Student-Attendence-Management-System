<?php 
	include "header.php";
	if(auth()->check()){
		lib()->redirect("index.php");
	}
	else{
		include "view/login.php";
	}
	
