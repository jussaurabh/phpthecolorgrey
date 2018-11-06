<?php 

require "session.inc.php";
require "../classes/Validate.php";


if (!empty($_POST['collection_name'])) {

	$coll_name = $_POST['collection_name'];

	$validate = new Validate;

	echo $validate->createCollection($coll_name, $_SESSION['uid']);
}
else {
	echo "Collection name is required";
}

?>