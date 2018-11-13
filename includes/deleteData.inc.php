<?php 


require "session.inc.php";
require_once "function.inc.php";

if (!empty($_POST['coll_name'])) {

	$msg = delete($_POST['coll_name']);

	echo $msg;
	
}



?>