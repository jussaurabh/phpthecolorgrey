<?php 

require "./classes/Data.php";


function getAllQuote($table) {
   $data = new Data;
   $rows = array();
   $rows = $data->getAllData($table);
   return $rows;
}


function getDateDiff($date) {
   $da[] = explode(' ', $date);
   
   $d1 = new DateTime($da[0][0]);
   $present = new DateTime('now');
   
   $diff = date_diff($present, $d1);

   $days = $diff->format("%a days");
   $months = $diff->format("%m months");
   $years = $diff->format("%y year");

   if (($days <= 31)) {
      return $days;  
   } else if ($months <= 12) {
      return $months;
   } else {
      return $years;
   }
   
}





?>