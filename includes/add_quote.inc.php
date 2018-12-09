<?php 


require "session.inc.php";
require "../classes/Validate.php";



if ((isset($_POST['quote']) && !empty($_POST['quote'])) && isset($_POST['quote_tag'])) {
	$validate = new Validate;

	$result = $validate->quoteInput($_SESSION['username'], $_POST['quote'], $_POST['quote_tag']);
	echo $result;
}
else {
	echo "false";
}


?>