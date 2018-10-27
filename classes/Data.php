<?php 

require "Dbs.php";

class Data extends Dbs {

   public function getAllData($table, $author=NULL) {

      $data = array();
      $tabledata = array();
      $i = 0;

      $conn = $this->connect();

      if (isset($author)) {
         $sql = "SELECT * FROM " . $table . " WHERE quote_author='$author'";
      }
      else {
         $sql = "SELECT * FROM " . $table;
      }
     
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