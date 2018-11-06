<?php

require "Dbs.php";

class InsertData extends Dbs {

   protected function insertUser($username, $email, $password) {
      $uid = rand();

      $sql = "INSERT INTO user(uid, username, email, password) VALUES ('$uid', '$username', '$email', '$password')";

      $conn = $this->connect();

      if ($conn->query($sql) === FALSE) {
         $err = "Error " . $sql . " " . $conn->error;
         return $err;
      }
      else
         header('Location: login.php');


      $conn->close();

   }

   protected function insertQuote($uid, $author, $quote) {

      $quote_id = rand();

      $sql = "INSERT INTO quote(quote_id, uid, quote_author, quote) VALUES ('$quote_id', '$uid', '$author', '$quote')";

      $conn = $this->connect();

      if ($conn->query($sql) === FALSE)
         echo "Error " . $sql . " " . $conn->error;
      else
         header('Location: profile.php?author=' . $author);


      $conn->close();

   }


   protected function insertCollection($coll_name, $uid) {
      $coll_id = rand();

      $sql = "INSERT INTO user_collection VALUES ('$coll_id', '$coll_name', '$uid')";

      $conn = $this->connect();
      $conn->query($sql);

      $conn->close();
   }

}

?>