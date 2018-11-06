<?php 

require "Dbs.php";

class Data extends Dbs {

   // public function getAllData($table, $condition=NULL) { 
   public function getAllData($query) { 

      $data = array();
      $tabledata = array();

      $conn = $this->connect();

      // if (isset($condition)) {
      //    $sql = "SELECT * FROM " . $table . " WHERE quote_author='$condition'";
      // }
      // else {
      //    $sql = "SELECT * FROM " . $table;
      // }

      $select_opts = $from_tbls = $join = $where = "";

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
     
      $result = $conn->query($sql);
      $rowcount = $result->num_rows;

      if ($rowcount > 0) {
         while ($row = $result->fetch_assoc()) {
            $tabledata[] = $row;
         }

         $data = [
            'rowcount' => $rowcount,
            'data' => $tabledata
         ];
      }
      else {
         $data = [
            'rowcount' => 0
         ];
      }

      return $data;
      
   }

}

?>