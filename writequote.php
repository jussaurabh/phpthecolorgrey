<?php

require "./includes/session.inc.php";

if (!isset($_SESSION['username'])) {
   exit(header("Location: login.php"));
}


require_once "./classes/Validate.php";


// $quoteError = NULL;
// $errors = array();

// if (isset($_POST['quote_submit'])) {

//    $validate = new Validate;

//    $errors = $validate->quoteInput($_SESSION['username'], $_POST['quote']);

//    $quoteError = $errors['quoteErr'];

// }

include "./includes/header.inc.php";

?>


<main>   

<div class="container form_container">

   <div class="form_block center">
      <h5 class="center form_head">Write your quote <?= $_SESSION['username'] ?></h5>

      <p class="registerError" id="quoteErr"><small></small></p>

      <form action="" method="post" class="quote_submit_form">

         <div class="inputbox valign-wrapper">
            <textarea id="textarea1" name="quote" placeholder="Write a quote" style="width:400px; min-width: 300px; border: none;" class="materialize-textarea no-margin" data-length="300"></textarea>
         </div>

         <div class="chips chips-placeholder inputbox" style="text-align: left;"></div>               

         <div class="inputbtn">
            <input type="submit" name="quote_submit" value="Submit">
         </div>
      </form>

   </div>

</div>

</main>


<?php include "./includes/footer.inc.php" ?>