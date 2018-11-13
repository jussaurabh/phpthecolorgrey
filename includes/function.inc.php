<?php 

require_once "./classes/Data.php";


function getAll($q) {
   $data = new Data;
   $rows = array();

   $rows = $data->getAllData($q);

   return $rows;
}




function getDateDiff($date) {
   $da[] = explode(' ', $date);
   
   $d1 = new DateTime($da[0][0]);
   $present = new DateTime('now');
   
   $diff = date_diff($present, $d1);

   $days = $diff->format("%a days ago");
   $months = $diff->format("%m months ago");
   $years = $diff->format("%y year ago");

   if ($days < 1) {
      return "Today";
   } else if (($days <= 31)) {
      return $days;  
   } else if ($months <= 12) {
      return $months;
   } else {
      return $years;
   }
   
}



function delete($delete_item) {
   $data = new Data;

	// $delete_item = $_POST['coll_name'];

	$coll_id = getAllData("
		SELECT collection_id FROM user_collection WHERE collection_name='" . $delete_item . "' AND uid='" . $_SESSION['uid'] . "'"
	);
	
	if (isset($coll_id['data']['collection_id']))
		$data->deleteData("DELETE FROM quote_collection WHERE collection_id='" . $coll_id['data']['collection_id'] . "'");

	$msg = $data->deleteData("
		DELETE FROM user_collection WHERE collection_name='" . $delete_item . "' AND uid='" . $_SESSION['uid'] . "'"
	);

   if ($msg === true) {
		return $delete_item . " deleted";
	}
	else 
		return "Error in deleting " . $msg;
}

?>