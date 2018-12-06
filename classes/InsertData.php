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

         if (isset($values['select_qt_id'])) {
            $sql = "INSERT INTO quote_collection VALUES ('$qt_coll_id', '$usr_coll_id', '$values[select_qt_id]')";
            $conn->query($sql);
         }

         $conn->close();

         return 1;
      }

   } 


   protected function insert_to_comment($comment, $comment_qtid, $username) {
      $cmnt_id = rand();

      $conn = $this->connect();

      $sql = "INSERT INTO comment(comment_id, user_comment, user, cmnt_quote_id) VALUES('$cmnt_id', '$comment', '$username', '$comment_qtid')";

      $conn->query($sql) ? $flag = 1 : $flag = 0;

      $conn->close();

      return $flag;
   }


   protected function insert_follow($uid, $follow_uid) {
      $conn = $this->connect();

      $sql = "INSERT INTO follow (followed_by_uid, followed_to_uid) VALUES ('$uid', '$follow_uid')";

      $conn->query($sql);

      $following = "SELECT * FROM follow WHERE followed_by_uid='" . $uid . "'";
      $rslt = $conn->query($following);

      $following_count = $rslt->num_rows;

      $followers = "SELECT * FROM follow WHERE followed_to_uid='" . $follow_uid . "'";
      $rslt = $conn->query($followers);

      $followers_count = $rslt->num_rows;

      $conn->close();

      if (isset($following_count) && isset($followers_count)) {
         $follow = [
            "following" => $following_count,
            "followers" => $followers_count
         ];
      }
      else {
         $follow = [
            "following" => 0,
            "followers" => 0
         ];
      }


      return $follow;
   }

}

?>