<?php 

require "session.inc.php";
require "../classes/Validate.php";


if (isset($_SESSION['uid'])) {
	if (!empty($_POST['collection_name']) && !empty($_POST['sel_qt_id'])) {

		$qt_coll_insert_data = array(
			'coll_name' => $_POST['collection_name'],
			'select_qt_id' => $_POST['sel_qt_id'],
			'uid' => $_SESSION['uid']
		);

		$validate = new Validate;

		echo $validate->insertCollection($qt_coll_insert_data);
	}
	else {
		echo "Collection name is required";
	}
}

?>