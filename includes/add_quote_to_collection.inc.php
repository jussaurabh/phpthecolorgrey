<?php 

require "session.inc.php";
require "../classes/Validate.php";


if (isset($_SESSION['uid'])) {

	$selected_quote = $_POST['qt-id'];

	if (!empty($selected_quote)) {

		$validate = new Validate;

		// echo $validate->insert(, $_SESSION['uid']);
	}

}

?>