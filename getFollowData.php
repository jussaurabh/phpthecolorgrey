<?php

session_start();

require "./includes/function.inc.php";


switch ($_GET['fun']) {
	case 'followBtn':
		followBtn($_POST['followuid']);
		break;
	
	default:
		# code...
		return;
}



function followBtn($followuid) {
	$rslt = getAll("SELECT * FROM follow WHERE followed_by_uid='" . $_SESSION['uid'] . "' AND followed_to_uid='" . $followuid . "'");

	if (isset($rslt['rowcount'])) {
		echo "<button class=\"following_btn\" id=\"unfollow\"> Following </button>";
	}
}


?>