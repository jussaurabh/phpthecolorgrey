<?php

session_start();
require_once "Dbs.php";
// require_once "./includes/function.inc.php";


class DeleteData extends Dbs {

	public function deleteCollections ($delete_item) {
		$conn = $this->connect();
		$coll_id = array();

		$rslt = $conn->query("
		 	SELECT collection_id FROM user_collection WHERE collection_name='" . $delete_item . "' AND uid='" . $_SESSION['uid'] . "'");

		if ($rslt->num_rows > 0) {
			$coll_id = $rslt->fetch_assoc();

			if (isset($coll_id['collection_id'])) {
				$conn->query("DELETE FROM quote_collection WHERE collection_id='" . $coll_id['collection_id'] . "'");
			}
		}

		$msg = $conn->query("
			DELETE FROM user_collection WHERE collection_name='" . $delete_item . "' AND uid='" . $_SESSION['uid'] . "'");

		if ($msg === true) 
			return $delete_item . " deleted";
		else 
			return "Error in deleting " . $msg;
	}


	public function unFollow ($uid, $unfollow_uid) {
		$conn = $this->connect();

		$sql = "DELETE FROM follow WHERE followed_by_uid='" . $uid . "' AND followed_to_uid='" . $unfollow_uid . "'";

		if ($conn->query($sql) === TRUE) 
			return true;
		else 
			return false;
	}

}


if (isset($_POST['coll_name'])) {
	$del_coll = new DeleteData;
	echo $del_coll->deleteCollections($_POST['coll_name']);
}


if (isset($_POST['unfollow_uid'])) {
	$unfollow = new DeleteData;
	echo $unfollow->unFollow($_SESSION['uid'], $_POST['unfollow_uid']);
}

?>