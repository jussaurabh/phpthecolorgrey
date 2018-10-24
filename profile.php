<?php 

require "./includes/session.inc.php";

require "./includes/getData.inc.php";
$result = getAllQuote('quote', $_GET['author']);

include "./includes/header.inc.php";

?>



<main>


   <div class="container-fluid profile_container"> 

      <div class="left_cont">

         <div class="user_profile_box">
            <div class="user_avatar valign-wrapper">
               <!-- <span class="valign-wrapper center-align">
                  <i class="material-icons center-align medium">account_circle</i>
               </span> -->

               <div class="avatar valign-wrapper">
                  <img src="./assets/images/profile.jpg" class="center-align"/>
               </div>
            </div>

            <div class="username">
               <?php  
                  echo "<p class=\"center\">" . $_GET['author'] . "</p>";
               ?>
            </div>

            <hr class="lightgrey-hr">

            <div class="user_profile_tag">
               <p class="center"><span> Followers 23 </span></p>
               <p class="center"><span> Following 12 </span></p>
               <p class="center">
               <span> Quotes 
                  <?php echo $result['rowcount']; ?>
               </span>
               </p>
            </div>
         </div>

      </div>
      <!-- .left_cont -->

      <div class="right_cont">

         <div class="quote-block-container">

            <?php 
               foreach ($result['data'] as $data) {
            ?>

            <div class="quoteBlock">
               <div class="quoteTags">
                  <p class="no-marign"><small>Tags - tag1, tag2, tag3 ....</small></p>
               </div>
               <div class="quote">
                  <?php 
                     echo "<p>" . $data['quote'] . "</p>";
                     echo "<p><a href=\"profile.php?author=" . $data['quote_author'] . "\"><small>- " . $data['quote_author'] . "</small></a></p>";
                  ?>
               </div>
               <div class="quoteBlockFooter">
                  <div class="quotedTime">
                     <?php 
                        $date = getDateDiff($data['quoted_datetime']);
                        echo "<p class=\"no-margin\"><small>" . $date . " ago</small></p>"
                     ?>
                  </div>
                  <div class="quoteActions valign-wrapper">
                     <div class="quoteLikeBtn valign-wrapper">
                        <span class="center-align valign-wrapper">
                           <i class="material-icons center-align">
                              favorite_border
                           </i>
                        </span>
                     </div>
                  </div>
               </div>
            </div>
            <!-- .quoteBlock -->

            <?php } ?>

         </div>
         <!-- .quote-block-container -->

      </div>
      <!-- .right_cont -->

   </div>


</main>



<?php 

include "./includes/categories.inc.php";
include "./includes/footer.inc.php";

?>