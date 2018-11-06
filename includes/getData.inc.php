<?php 

require "../classes/Data.php";


// function getAllQuote($table, $author=NULL) {
//    $data = new Data;
//    $rows = array();
   
//    if(isset($author))
//       $rows = $data->getAllData($table, $author);
//    else 
//       $rows = $data->getAllData($table);

//    return $rows;
// }

function getAllQuote($q) {
   $data = new Data;
   $rows = array();
   
   print_r($q);
   echo $q['from'];

   // $query = $q;

   $rows = $data->getAllData($q);

   return $rows;
}


$ans = getAllQuote(array(
            'search' => array(),
            'from' => 'quote'
         ));

print_r($ans);


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