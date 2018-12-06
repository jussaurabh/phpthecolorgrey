<?php 

require "session.inc.php";
require "function.inc.php";



if (isset($_POST['username']) || isset($_POST['email'])) {

	$uname = $_POST['username'];
	$email = $_POST['email'];

	if (isset($uname))
		$data = getAll("SELECT username FROM user WHERE username='" . $uname . "'");
	else
		$data = getAll("SELECT email FROM user WHERE email='" . $email . "'");

	

	if ($data['rowcount'] == 0) {
		echo "Available";
	}
	else {
		echo "Unavailable";
	}
}

?>