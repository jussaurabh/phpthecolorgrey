<?php

require "Dbs.php";

class UserLogin extends Dbs {
   
   public function login($username, $password) {
   
      $conn = $this->connect();
   
      $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
   
      $result = $conn->query($sql);
   
      if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['uid'] = $row['uid'];
				setcookie("username", $_SESSION['username'], time() + (86400*30), "/phpthecolorgrey");
				setcookie("userid", $_SESSION['uid'], time() + (86400*30), "/phpthecolorgrey");
         }
      }
   
   
      if (isset($_SESSION['username'])) {
         // return Null;
         header("Location: index.php");
      }
      else     
         return "Invalide Username and password";
   }

}




?>