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
                           <span class="center-align valign-wrapper tooltipped" data-position="bottom" data-tooltip="Comments">
                              <i class="material-icons center-align">comment</i>
                           </span>
                        </div>
                        <div class="quoteBtns valign-wrapper">
                           <span class="center-align valign-wrapper">
                              <i class="material-icons center-align">favorite_border</i>
                           </span>
                        </div>
                        <div class="quoteBtns valign-wrapper tooltipped" data-position="bottom" data-tooltip="Add to collection">
                           <span class="center-align valign-wrapper collection_btn">
                              <i class="material-icons center-align">add_box</i>
                           </span>
                        </div>
                     </div>
                  </div>

                  <div class="collection_opts">
                     <form action="">
                        <ul>
                           <li class="collections">
                              <span>
                                 Create Container
                              </span>
                           </li>
                           <li class="divider"><hr></li>
                           <li class="collections">
                              <label for="a">
                                 <input type="checkbox" id="a">
                                 Collection name
                              </label>
                           </li>
                           <li class="collections">
                              <label for="b">
                                 <input type="checkbox" id="b">
                                 Collection name
                              </label>
                           </li>
                        </ul>
                     </form>
                  </div>
                  <!-- .collection_opts -->

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


<?php 

   include "./includes/categories.inc.php";
   include "./includes/footer.inc.php";

?>
