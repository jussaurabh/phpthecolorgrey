<?php


class Dbs {

   private $host = "localhost";
   private $username = "root";
   private $password = "";
   private $db = "thecolorgrey";

   protected function connect() {
      $conn = new mysqli($this->host, $this->username, $this->password, $this->db);

      if ($conn->connect_error)
         die("Connection failed " . $conn->connect_error);

      return $conn;
   }

}


?>