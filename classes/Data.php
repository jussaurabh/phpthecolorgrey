<?php 

require "Dbs.php";
require_once "includes/function.inc.php";

class Data extends Dbs {

   public function getAllData($sql) { 

      $data = array();
      $tabledata = array();

      $conn = $this->connect();
     
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


   public function deleteData($sql) {
      $conn = $this->connect();

      if ($conn->query($sql) === TRUE) {
         return true;
      }
      else
         return "Error : " . $conn->error;
   }


}

?>