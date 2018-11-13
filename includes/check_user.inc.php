<?php 

require "session.inc.php";
require "function.inc.php";



if (isset($_POST['username'])) {

	$uname = $_POST['username'];

	$data = getAll("SELECT username FROM user WHERE username='" . $uname . "'");

	if ($data['rowcount'] == 0) {
		echo "Available";
	}
	else {
		echo "Unavailable";
	}
}

?>