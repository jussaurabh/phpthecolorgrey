<?php 

require_once "./classes/Data.php";


function getAll($q) {
   $data = new Data;
   $rows = array();

   $rows = $data->getAllData($q);

   return $rows;
}


function getFollow($sql, $col_name) {
   $data = new Data;
   $rows = array();

   $rows = $data->getAllData($sql);

   if (isset($rows['data'])) {
      $result = $data->getAllFollow($rows['data'], $col_name);
      return $result;
   }

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



?>