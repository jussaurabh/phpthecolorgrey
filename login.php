<?php 
require "./includes/session.inc.php";
include "./classes/UserLogin.php";


if (isset($_SESSION['username'])) {
   header("Location: index.php");
}


if (isset($_POST['login_submit'])) {
   $loginError = NUll;
   $userLogin = new UserLogin;
   $loginError = $userLogin->login($_POST['username'], $_POST['password']);
}

include "./includes/header.inc.php";



?>

<main>

   <div class="container form_container">

      <div class="form_block center">
         <h5 class="center form_head">Login</h5>

         <p>
            <?php 
               if (isset($loginError))
                  echo $loginError;
            ?>
         </p>

         <form action="" method="post">
            <div class="inputbox">
               <input type="text" name="username" placeholder="Username">
            </div>

            <div class="inputbox">
               <input type="text" name="password" placeholder="Password">
            </div>

            <div class="inputbtn">
               <input type="submit" name="login_submit" value="Login">
            </div>
         </form>

         <p class="signupPara">Don't have an account? <a href="signup.php">Signup</a></p>
      </div>

   </div>

</main>

<?php include "./includes/footer.inc.php" ?>