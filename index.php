<?php 

require "./includes/session.inc.php";

require_once "./includes/function.inc.php";

$result = getAll("SELECT * FROM quote");

if (isset($_SESSION['uid'])) {
   $user_collections = getAll("SELECT * FROM user_collection WHERE uid='" . $_SESSION['uid'] . "'");
}





include "./includes/header.inc.php";

?>


   <main id="home">
      
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
                           <span class="center-align valign-wrapper">
                              <i class="material-icons center-align">favorite_border</i>
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
            <!-- .quote-blocks-container -->
         </div>
         <!-- .row -->
      </div>
      <!-- .container -->

   </main>


<?php 

   include "./includes/popup_module.inc.php";
   include "./includes/categories.inc.php";
   include "./includes/footer.inc.php";

?>
