<?php

session_start();

require "./classes/Validate.php";


if (isset($_POST['follow_uid'])) {

	$follow_uid = $_POST['follow_uid'];
	$uid = $_SESSION['uid'];

	$validate = new Validate;

	$follow_count = $validate->insertFollow($uid, $follow_uid);

	echo json_encode($follow_count);

}

?>