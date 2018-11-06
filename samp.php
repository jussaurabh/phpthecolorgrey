<?php 

// session_start();

// if (!isset($_post['addbtn']))
//    $_SESSION['num'] = 1;


function set($table, $name=NULL) {
   // echo "<br>table : " . var_dump($table);
   // echo "<br>name : " . var_dump($name);
   // echo "<br>condition : " . var_dump($condition);
   if (isset($name))
      get($table, $name);
   else
      get($table);
}






// $now = strtotime('now');
// $time = strtotime('12:2:60');

// $nowtime = date('h:m:s', $now);
// $newtime = date('h:m:s', $time);
// var_dump($newtime);
// echo "<br> newtime: " . $newtime . " nowtime: " . $nowtime;

// $da = new DateTime();
// echo "<br>" . $da->format('Y - m - d h:m:s');

// echo date('Y - m - d h:i:s', 1540670879);

function met ($query) {
   get($query);
}



function get($query) {
   $select_opts = $from_tbls = $join = $where = "";

   // met($query);

   echo sizeof($query);

   if (count($query['select']) > 0) {
      foreach ($query['select'] as $cols) {
         $select_opts .= $cols . ",";
      }
      $select_opts = substr($select_opts, 0, strlen($select_opts)-1);
   }
   else {
      $select_opts = "*";
   }
   
   if (count($query['from']) > 0){
      foreach ($query['from'] as $tbls) {
         $from_tbls .= $tbls;
      }
   }

   if (array_key_exists('join', $query)) {
      if (sizeof($query['join']) > 0) {
         foreach ($query['join'] as $join_tbl => $on_condition) {
            $join .= " JOIN " . $join_tbl . " ON " . $on_condition;
         }
      }
   }

   if (array_key_exists('where', $query)) {
      if (sizeof($query['where']) > 0) {
         foreach ($query['where'] as $where_cond) {
            $where .= $where_cond . " ";
         }
         $where = " WHERE " . $where;
      }
   }
   

   $sql = "SELECT " . $select_opts . " FROM " . $from_tbls . $join . $where;
      
   echo "<h3>" . $sql . "</h3>";
   
}

met(array(
   'select' => array(
      'user_collection.coll_name', 
      'quote.quote',
      'quote.quote_author'
   ),
   'from' => array('user_collection'),
   'where' => array(
      'user_collection.collection_name=mycol',
      'AND',
      'user_collection.uid=1539925346'
   ),
   'join' => array(
      'quote_collection' => 'user_collection.collection_id=quote_collection.coll_id',
      'quote' => 'quote_collection.quote_id=quote.quote_id'
   ),
   
)); 

// echo $_SESSION['num']++;

?>


