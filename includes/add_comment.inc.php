<?php

session_start();

require_once "../classes/Validate.php";

if (isset($_POST['comment']) && isset($_POST['comment_qtid'])) {

	$comment = $_POST['comment'];
	$comment_qtid = $_POST['comment_qtid'];
	$validate = new Validate;

	return $validate->insertComment($comment, $comment_qtid, $_SESSION['username'], $_SESSION['uid']);

}

?>