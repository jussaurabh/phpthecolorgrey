<?php

require "Dbs.php";

class InsertData extends Dbs {

   protected function insertUser($username, $email, $password) {
      $uid = time('now');

      $sql = "INSERT INTO user(uid, username, email, password) VALUES ('$uid', '$username', '$email', '$password')";

      $conn = Dbs::connect();

      if ($conn->query($sql) === FALSE)
         echo "Error " . $sql . " " . $conn->error;
      else
         header('Location: login.php');


      $conn->close();

   }

   protected function insertQuote($uid, $author, $quote) {

      $quote_id = time('now');

      $sql = "INSERT INTO quote(quote_id, uid, quote_author, quote) VALUES (\"$quote_id\", \"$uid\", \"$author\", \"$quote\")";

      $conn = Dbs::connect();

      if ($conn->query($sql) === FALSE)
         echo "Error " . $sql . " " . $conn->error;
      else
         header('Location: index.php');


      $conn->close();

   }

}

?>