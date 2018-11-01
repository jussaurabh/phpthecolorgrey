<?php 

require "./includes/session.inc.php";

require "./includes/getData.inc.php";
$result = getAllQuote('quote');

include "./includes/header.inc.php";

?>


   <main>
      
      <div class="container">
         <div class="row">

            <div class="quoteCategoryOption">

               <label for="all">
                  <input type="radio" checked name="radio" id="all">
                  <span class="quoteChip chipChecked">All</span>
               </label>

               <label for="cat">
                  <input type="radio" name="radio" id="cat">
                  <span class="quoteChip">Category</span>
               </label>

            </div>
            <!-- .quoteCategoryOptions -->

            <div class="quote-block-container">

               <?php 
                  foreach ($result['data'] as $data) {         
               ?>

               <div class="quoteBlock">
                  <div class="quoteTags">
                     <p class="no-margin"><small>Tags - tag1, tag2, tag3, tag1, tag2, tag3</small></p>
                  </div>
                  <div class="quote">
                     <?php 
                        echo "<p>" . $data['quote'] . "</p>";
                        echo "<p><a href=\"profile.php?author=" . $data['quote_author'] ."\"><small>- " . $data['quote_author'] . "</small></a></p>";
                     ?>
                  </div>
                  <div class="quoteBlockFooter">
                     <div class="quotedTime">
                        <!-- <p class="no-margin"><small>- AUthor Name</small></p> -->
                        <?php 
                           $date = getDateDiff($data['quoted_datetime']);
                           echo "<p class=\"no-margin\"><small>" . $date . "</small></p>"
                        ?>
                     </div>
                     <div class="quoteActions valign-wrapper">
                        <div class="quoteBtns valign-wrapper">
                           <span class="center-align valign-wrapper cmnt_open_btn">
                              <i class="material-icons center-align">comment</i>
                           </span>
                        </div>
                        <div class="quoteBtns valign-wrapper">
                           <span class="center-align valign-wrapper">
                              <i class="material-icons center-align">favorite_border</i>
                           </span>
                        </div>
                        <div class="quoteBtns valign-wrapper">
                           <span class="center-align valign-wrapper collection_btn">
                              <i class="material-icons center-align">add_box</i>
                           </span>
                        </div>
                     </div>
                     <!-- .quoteActions -->
                  </div>
                  <!-- .quoteBlockFooter -->

               </div>
               <!-- .quoteBlock -->

               <?php } ?>


            </div>
            <!-- .quote-blocks-container -->
         </div>
         <!-- .row -->
      </div>
      <!-- .container -->

   </main>



   <div class="dropdown collection_dropdown">
      <div class="dropdown_create_btn valign-wrapper">
         <span class="center-align valign-wrapper"><i class="material-icons">playlist_add</i></span>
         <span style="padding-left: 0.5em;">Create Collection</span>
      </div>
      <form class="create_collection_form">
         <div class="inputbox">
            <input type="text" placeholder="Create Collection">
         </div>

         <!-- <ul class="dropdown_list">
            <li>
               <label for="happy">
                  <input type="checkbox" name="happy" id="happy">
                  <span>Happy</span>
               </label>
            </li>
         </ul> -->
         <div class="dropdown_collection_btn">
            <span id="collection_cancel_btn">Cancel</span>
            <button id="collection_add_btn">Add</button>
         </div>
      </form>
   </div>
   <!-- .collection_dropdown -->


<?php 

   include "./includes/comment.inc.php";
   include "./includes/categories.inc.php";
   include "./includes/footer.inc.php";

?>
