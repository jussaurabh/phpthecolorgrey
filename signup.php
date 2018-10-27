<?php

require "./includes/session.inc.php";

if (isset($_SESSION['username'])) {
   exit(header("Location: index.php"));
}

require "./classes/Validate.php";

$usernameError = $emailError = $passwordError = NULL;
$signupError = array();

if (isset($_POST['signup_submit'])) {

   $validate = new Validate;

   $signupError = $validate->signupInput($_POST['username'], $_POST['email'], $_POST['password']);

   $usernameError = $signupError['username'];
   $emailError = $signupError['email'];
   $passwordError = $signupError['password'];

}


include "./includes/header.inc.php";
?>


<main>   

   <div class="container form_container">

      <div class="form_block center">
         <h5 class="center form_head">Signup</h5>

         <form action="" method="post">
            <div class="inputbox">
               <input type="text" name="username" placeholder="Username">
            </div>
            <?php 
               if ($usernameError)
                  echo "<p class='registerError no-margin'> <small> $usernameError </small> </p>"
            ?>            
            
            <div class="inputbox">
               <input type="email" name="email" placeholder="Email">
            </div>
            <?php 
               if ($emailError)
                  echo "<p class='registerError no-margin'> <small> $emailError </small> </p>"
            ?>            

            <div class="inputbox">
               <input type="text" name="password" placeholder="Password">
            </div>
            <?php 
               if ($passwordError)
                  echo "<p class='registerError no-margin'> <small> $passwordError </small> </p>"
            ?>            

            <div class="inputbtn">
               <input type="submit" name="signup_submit" value="Signup">
            </div>
         </form>

      </div>

   </div>

</main>


<?php include "./includes/footer.inc.php" ?>