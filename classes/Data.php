<?php 

require "Dbs.php";

class Data extends Dbs {

   public function getAllData($table) {

      $data = array();
      $i = 0;

      $conn = Dbs::connect();

      $sql = "SELECT * FROM " . $table;
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
            $data[] = $row;
         }
      }

      return $data;
      
   }

}

?>