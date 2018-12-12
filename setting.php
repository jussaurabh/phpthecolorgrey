<?php 

require "./includes/session.inc.php";

require_once "./includes/function.inc.php";

$result = getAll("SELECT * FROM quote");



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
               <li>
                  <a href="#liked_quotes">Liked Quotes</a>
               </li>
            </ul>
         
         </div>
         <!-- .right_cont -->

         <div class="col m9 left_cont">
         
            <div id="about_author">

               <form action="" style="max-width: 400px;">
                  <div class="inputbox">
                     <input type="text" name="author_designation" placeholder="Author Designation">
                  </div>
                  <div class="inputbox">
                     <input type="date" name="author_bdate" placeholder="Birth Date">
                  </div>
                  <div class="inputbox">
                     <input type="text" name="author_description" placeholder="Author Description">
                  </div>
                  <div class="inputbtn">
                     <input type="submit" value="Update" name="autho_into_update">
                  </div>
               </form>
               
            </div>


            <div id="liked_quotes">

               <div class="quote-block-container">
                  
                  <?php 
                     foreach ($result['data'] as $data):        
                  ?>

                  <div class="quoteBlock">

                     <div class="quoteTags">
                        <p class="no-margin"><small>Tags - <?= $data['quote_tags'] ?></small></p>
                     </div>
                     <div class="quote">
                        <p> <?= $data['quote'] ?> </p>
                        <p>
                           <a href="profile.php?author=<?= $data['quote_author'] ?>&i=<?= $data['uid'] ?>">
                              <small>- <?= $data['quote_author'] ?> </small>
                           </a>
                        </p>
                     </div>
                     <div class="quoteBlockFooter">
                        <div class="quotedTime">
                           <?php 
                              $date = getDateDiff($data['quoted_datetime']);
                              echo "<p class=\"no-margin\"><small>" . $date . "</small></p>"
                           ?>
                        </div>
                        <div class="quoteActions valign-wrapper">
                           <div class="quoteBtns valign-wrapper">
                              <span 
                                 class="center-align valign-wrapper cmnt_open_btn"
                                 data-cmnt-qt="<?= $data['quote']; ?>"
                                 data-cmnt-qtauthor="<?= $data['quote_author'] ?>"
                                 data-cmnt-qtdatetime="<?= $date ?>"
                                 data-cmnt-qtid="<?= $data['quote_id'] ?>"
                                 data-cmnt-uid="<?= $data['uid'] ?>"
                                 >
                                 <i class="material-icons center-align">comment</i>
                              </span>
                           </div>
                           <div class="quoteBtns valign-wrapper">
                              <span class="center-align valign-wrapper fav-quote">

                                 <?php 
                                 if (isset($_SESSION['uid'])): 

                                    $favCount = getAll("SELECT * FROM favorite WHERE author='" . $data['uid'] . "' AND quote_id='" . $data['quote_id'] . "'");


                                    if ($favCount['rowcount'] > 0):

                                       $index = -1;
                                       foreach ($favCount['data'] as $favData) {
                                          if ($favData['liked_by'] == $_SESSION['uid'])
                                             $index = 1;
                                       }

                                       if ($index == 1):

                                          echo "<i class='material-icons tiny favActive user_like_btn user_unlike_btn'>favorite</i>" . $favCount['rowcount'];

                                       else:

                                          echo "<i class='material-icons tiny user_like_btn'>favorite</i>" . $favCount['rowcount'];

                                       endif;

                                    else:
                                       echo "<i class='material-icons tiny user_like_btn'>favorite_border</i>0";

                                    endif;
                                 
                                 else: ?>

                                    <i class="material-icons tiny user_like_btn">favorite_border</i>

                                 <?php endif; ?>

                              </span>
                           </div>
                           <div class="quoteBtns valign-wrapper">
                              <span 
                                 class="center-align valign-wrapper collection_btn" 
                                 data-qtid="<?= $data['quote_id']; ?>">
                                 <i class="material-icons center-align">add_box</i>
                              </span>
                           </div>
                        </div>
                        <!-- .quoteActions -->
                     </div>
                     <!-- .quoteBlockFooter -->

                  </div>
                  <!-- .quoteBlock -->

                  <?php endforeach; ?>

               </div>
               <!-- .quote-block-container -->

            </div>
            <!-- #liked_quotes -->
         
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