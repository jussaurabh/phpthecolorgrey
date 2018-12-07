<?php 

require "Dbs.php";
// require_once "includes/function.inc.php";

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


   public function getAllFollow($data, $col_name) {
      $conn = $this->connect();

      $result = array();

      foreach ($data as $value) {
         $sql = "SELECT * FROM user WHERE uid='" . $value[$col_name] . "'";

         $res = $conn->query($sql);
         
         if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
               $temp = [
                  "username" => $row['username'],
                  "uid" => $row['uid']
               ];
               array_push($result, $temp);
            }
         }
      }

      return $result;
   }


}

?>