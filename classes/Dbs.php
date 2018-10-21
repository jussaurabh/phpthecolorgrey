<?php

define ('HOST', 'localhost');
define ('USERNAME', 'root');
define ('PASSWORD', '');
define ('DB', 'thecolorgrey');


class Dbs {

   public static function connect() {
      $conn = new mysqli(HOST, USERNAME, PASSWORD, DB);

      if ($conn->connect_error)
         die("Connection failed " . $conn->connect_error);

      return $conn;
   }

}


?>