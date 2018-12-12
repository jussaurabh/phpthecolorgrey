<?php 

require "session.inc.php";
require "../classes/Validate.php";


if (isset($_SESSION['uid']) && isset($_POST['quote_id']) && isset($_POST['author'])) {

	$validate = new Validate;

	echo $validate->insertLike($_SESSION['uid'], $_POST['quote_id'], $_POST['author']);

}
else {
	echo false;
}


?>