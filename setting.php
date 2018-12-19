<?php 

session_start();

require_once "./includes/function.inc.php";
require "./classes/Validate.php";

$result = getAll("SELECT * FROM quote");

if (isset($_POST['profileUpdate'])) {
   $description = $_POST['description'];
   $designation = $_POST['designation'];
   $isUpload = false;


   if (!empty($_FILES['avatar']['name'])) {
      $target = "assets/images/profile/";

      $tmp = explode('.', $_FILES['avatar']['name']);
      $ext = end($tmp);

      $newName = $_SESSION['uid'] . "." . $ext;
      
      $target_file = $target . $newName;

      if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file)) {
         echo "Error in uploading file";
      } else {
         $isUpload = true;
      }

   }

   $validate = new Validate;
   $validate->updateUser($description, $designation, $_SESSION['uid'], $_SESSION['username'], $isUpload);

   
}



include "./includes/header.inc.php";


?>


<main>


   <div class="container setting_container">

      <div class="row">
      
         <div class="col m3 right_cont">

            <ul class="setting_list no-margin">
               <li>
                  <a href="#about_author">About Author</a>
               </li>
            </ul>
         
         </div>
         <!-- .right_cont -->

         <div class="col m9 left_cont">
         
            <div id="about_author">

               <form action="" method="post" style="max-width: 400px;" enctype="multipart/form-data">

                  <div class="inputbox" style="margin: 1.2em auto;">
                     <input type="text" name="designation" placeholder="Author Designation">
                  </div>

                  <div class="inputbox" style="margin: 1.2em auto;">
                     <input type="text" name="description" placeholder="Author Description">
                  </div>

                  <div class="file-field input-field inputbox valign-wrapper" style="margin: 1.2em auto;">
                     <div class="btn" 
                        style="background-color:#212121; border-radius:50px; height:2.5em; line-height:2.5em;">
                        <span>File</span>
                        <input type="file" name="avatar">
                     </div>
                     <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload profile image">
                     </div>
                  </div>
                  <!-- <input type="file" name="avatar"> -->

                  <div class="inputbtn">
                     <input type="submit" value="Update" name="profileUpdate">
                  </div>

               </form>
               
            </div>
            <!-- #about_author -->
         
         </div>
         <!-- .left_cont -->

      </div>

   </div>
   <!-- .container -->

</main>


<?php 

include "./includes/popup_module.inc.php";
include "./includes/categories.inc.php";
include "./includes/footer.inc.php";

?>