<?php 

require "./includes/session.inc.php";


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

                  <div class="quoteBlock">
                     <div class="quoteTags">
                        <p class="no-marign"><small>Tags - tag1, tag2, tag3 ....</small></p>
                     </div>
                     <div class="quote">
                        <p> some quote liked onece </p>
                        <p>
                           <a href="profile.php?author">
                              <small> som eauthor </small>
                           </a>
                        </p>
                     </div>
                     <div class="quoteBlockFooter">
                        <div class="quotedTime">
                           1 day ago
                        </div>
                        <div class="quoteActions valign-wrapper">
                           <div class="quoteBtns valign-wrapper">
                              <span 
                                 class="center-align valign-wrapper cmnt_open_btn"
                                 >
                                 <i class="material-icons center-align">comment</i>
                              </span>
                           </div>
                           <div class="quoteBtns valign-wrapper">
                              <span class="center-align valign-wrapper">
                                 <i class="material-icons center-align">favorite_border</i>
                                 21
                              </span>
                           </div>
                           <div class="quoteBtns valign-wrapper">
                              <span 
                                 class="center-align valign-wrapper collection_btn">
                                 <i class="material-icons center-align">add_box</i>
                              </span>
                           </div>
                        </div>
                        <!-- .quoteActions -->
                     </div>
                     <!-- .quoteBlockFooter -->
                  </div>
                  <!-- .quoteBlock -->

               </div>

            </div>
         
         </div>
         <!-- .left_cont -->

      </div>

   </div>
   <!-- .container -->

</main>


<?php 

include "./includes/categories.inc.php";
include "./includes/footer.inc.php";

?>