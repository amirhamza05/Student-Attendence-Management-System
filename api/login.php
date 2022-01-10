<?php

include "api.php";
	
if(isset($_POST['login'])){
	$response = auth()->login($_POST);
	lib()->apiBack($response);
}
