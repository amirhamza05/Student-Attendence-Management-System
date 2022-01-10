<?php 
	include "header.php";
	auth()->logout();
	lib()->redirect("login.php");