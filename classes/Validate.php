<?php

require "InsertData.php";

define("USERNAME_MAX_LENGTH", 15);
define("PASSWORD_MAX_LENGTH", 15);
define("USERNAME_MIN_LENGTH", 4);
define("PASSWORD_MIN_LENGTH", 8);
define("QUOTE_MAX_LENGTH", 300);
define("AUTHOR_MAX_LENGTH", 15);


class Validate extends InsertData {


   public function signupInput($username, $email, $password) {

      $errors = array();
   
      if (empty($username))
         $usernameError = "Username is required";
      else if ((strlen($username) > USERNAME_MAX_LENGTH) || (strlen($username) < USERNAME_MIN_LENGTH))
         $usernameError = "Username should be min. " . USERNAME_MIN_LENGTH . " chars and max. " . USERNAME_MAX_LENGTH;
      else
         $usernameError = NULL;
   
      if (empty($email))
         $emailError = "Email is required";
      else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
         $emailError = "Not a valid Email";
      else
         $emailError = NULL;
            
      if (empty($password))
         $passwordError = "Password is required";
      else if ((strlen($password) > PASSWORD_MAX_LENGTH) || (strlen($password) < PASSWORD_MIN_LENGTH))
         $passwordError = "Password should be min. " . PASSWORD_MIN_LENGTH . " chars and max. " . PASSWORD_MAX_LENGTH;
      else
         $passwordError = NULL;


      $errors = array(
         'username' => $usernameError,
         'email' => $emailError,
         'password' => $passwordError
      );



      if (isset($usernameError) || isset($emailError) || isset($passwordError)) {
         return $errors;
      }
      else {
         $this->insertUser($username, $email, $password);
      }


   }


   public function quoteInput($author, $quote, $quote_tag) {

      $errors = array();
   
      if (empty($author))
         $authorError = "Author name is required";
      else if (strlen($author) > AUTHOR_MAX_LENGTH)
         $authorError = "Author name can be max. " . AUTHOR_MAX_LENGTH;
      else
         $authorError = NULL;
   
      if (empty($quote))
         $quoteError = "Quote is required";
      else if (strlen($quote) > QUOTE_MAX_LENGTH)
         $quoteError = "Quote cannot exced more than " . QUOTE_MAX_LENGTH . " characters.";
      else
         $quoteError = NULL;


      $errors = array(
         'authoErr' => $authorError,
         'quoteErr' => $quoteError
      );

      if (!isset($authorError) && !isset($quoteError)) {
         return $this->insertQuote($_SESSION['uid'], $author, $quote, $quote_tag);
      }
      else {
         return $errors;
      }

   }


   public function insertCollection($values) {
      $flag = $this->insert_to_collection($values);

      return ($flag) ? "Quote added to " . $values['coll_name'] : "Collection already exists";
      
   }

   public function insertComment($comment, $comment_qtid, $username, $uid) {
      $flag = $this->insert_to_comment($comment, $comment_qtid, $username, $uid);

      return ($flag) ? "comment is : " . $comment . " \n comment quote id is : " . $comment_qtid . " \n user id is : " . $username : "some error commenting";
   }


   public function insertFollow($uid, $follow_uid) {
      return $this->insert_follow($uid, $follow_uid);
   }

}




?>