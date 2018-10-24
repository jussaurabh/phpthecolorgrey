<?php

require "Dbs.php";

if (isset($_POST['login_submit'])) {

   $username = $_POST['username'];
   $password = $_POST['password'];

   $conn = Dbs::connect();

   $sql = "SELECT * FROM user WHERE username='$username' and password='$password'";

   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
         $_SESSION['username'] = $row['username'];
         $_SESSION['uid'] = $row['uid'];
      }
   }


   if (isset($_SESSION['username']))
      header("Location: index.php");
   else     
      $loginError = "Invalide Username and password";

}


?>