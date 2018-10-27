<?php

require "./includes/session.inc.php";

if (!isset($_SESSION['username'])) {
   exit(header("Location: login.php"));
}


require_once "./classes/Validate.php";


$authorError = $quoteError = NULL;
$errors = array();

if (isset($_POST['quote_submit'])) {

   $validate = new Validate;

   $errors = $validate->quoteInput($_SESSION['username'], $_POST['quote']);

   $authorError = $errors['authorErr'];
   $quoteError = $errors['quoteErr'];

}

include "./includes/header.inc.php";

?>


<main>   

<div class="container form_container">

   <div class="form_block center">
      <h5 class="center form_head">Write your quote</h5>

      <form action="" method="post">
         <!-- <div class="inputbox">
            <input type="text" name="quote_author" placeholder="Author" styles="width: 400px; min-width: 300px;">
         </div> -->
         <?php 
            // if ($authorError)
            //    echo "<p class='registerError no-margin'> <small> $authorError </small> </p>"

            echo "<h5>" . $_SESSION['username'] . "</h5>";
         ?>     

         <div class="inputbox">
            <input type="text" name="quote" placeholder="Write a quote" styles="width: 400px; min-width: 300px;">
         </div>
         <?php 
            if ($quoteError)
               echo "<p class='registerError no-margin'> <small> $quoteError </small> </p>"
         ?>                 

         <div class="inputbtn">
            <input type="submit" name="quote_submit" value="Submit">
         </div>
      </form>

   </div>

</div>

</main>


<?php include "./includes/footer.inc.php" ?>