<?php 

require_once "./classes/Data.php";


// To get data of any table form the database
function getAll($q) {
   $data = new Data;
   $rows = array();

   $rows = $data->getAllData($q);

   return $rows;
}


// To get the Followers/Followings
function getFollow($sql, $col_name) {
   $data = new Data;
   $rows = array();

   $rows = $data->getAllData($sql);

   if (isset($rows['data'])) {
      $result = $data->getAllFollow($rows['data'], $col_name);
      return $result;
   }

}


// To get Difference between any two dates
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


// To get Users Avatar(Profile Picture)
function getAvatar($uid) {
	$profile_img_target = "./assets/images/profile/";
	$files = glob($profile_img_target . "*.*");
	$flag = "";

	foreach ($files as $file) {
		$filename = substr($file, strlen($profile_img_target));
		$tmp = explode('.', $filename);
		if ($tmp[0] == $uid) {
			$userProfile = $profile_img_target . $filename;
			$flag = true;
			break;
		}
		else 
			$flag = false;
	}
	
	return ($flag) ? $userProfile : false;
}



?>