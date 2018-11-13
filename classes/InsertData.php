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


   protected function insert_to_collection($values) {
      $usr_coll_id = rand();
      $qt_coll_id = rand();

      $conn = $this->connect();

      $chk_collection = "SELECT collection_name, uid FROM user_collection WHERE collection_name='" . $values['coll_name'] . "' AND uid='" . $values['uid'] . "'";

      if ($conn->query($chk_collection)->num_rows > 0) {
         $conn->close();
         return 0;
      } 
      else {
         $sql = "INSERT INTO user_collection VALUES ('$usr_coll_id', '$values[coll_name]', '$values[uid]')";
         $conn->query($sql);

         $sql = "INSERT INTO quote_collection VALUES ('$qt_coll_id', '$usr_coll_id', '$values[select_qt_id]')";
         $conn->query($sql);

         $conn->close();

         return 1;
      }

   }

}

?>