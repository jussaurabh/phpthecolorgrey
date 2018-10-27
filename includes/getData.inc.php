<?php 

require "./classes/Data.php";


function getAllQuote($table, $author=NULL) {
   $data = new Data;
   $rows = array();
   
   if(isset($author))
      $rows = $data->getAllData($table, $author);
   else 
      $rows = $data->getAllData($table);

   return $rows;
}


function getDateDiff($date) {
   $da[] = explode(' ', $date);

   // $t1 = 
   
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