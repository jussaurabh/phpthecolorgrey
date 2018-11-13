<?php 

require "./includes/session.inc.php";

require_once "./includes/function.inc.php";

$user_quotes = getAll("SELECT * FROM quote WHERE quote_author='" . $_GET['author'] . "'");

if (isset($_SESSION['uid'])) {
   $user_collections = getAll("SELECT * FROM user_collection WHERE uid='" . $_SESSION['uid'] . "'");
}

include "./includes/header.inc.php";

?>



<main id="user_profile_page">


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
                  <?php echo $user_quotes['rowcount']; ?>
               </span>
               </p>
            </div>

            <div class="about_author">
               <p class="no-margin">Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, distinctio eos. Animi officiis ipsam sequi id, quis ipsa veniam odio ducimus aliquam dignissimos laboriosam eius at in eaque asperiores repellat!</p>
            </div>
         </div>
         <!-- .user_profile_box -->

      </div>
      <!-- .left_cont -->

      <div class="mid_cont">

         <div class="quote-block-container">

            <?php if (!isset($user_quotes['data'])): ?>

            <div class="default-placeholder valign-wrapper">
               <span class="center-align">No Quotes writen yet</span>
            </div>

            <?php 
            else:
               foreach ($user_quotes['data'] as $data):
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
                           21
                        </span>
                     </div>
                     <div class="quoteBtns valign-wrapper">
                        <span class="center-align valign-wrapper collection_btn" data-qtid="<?= $data['quote_id'];?>">
                           <i class="material-icons center-align">add_box</i>
                        </span>
                     </div>
                  </div>
                  <!-- .quoteActions -->
               </div>
               <!-- .quoteBlockFooter -->
            </div>
            <!-- .quoteBlock -->

            <?php 
               endforeach;
            endif;
            ?>

         </div>
         <!-- .quote-block-container -->

      </div>
      <!-- .mid_cont -->


      <div class="right_cont">

         <?php if (isset($_SESSION['username']) && $_SESSION['username'] == $_GET['author']): ?>

         <div class="collection_list_cont">

            <div class="collection_list_box">
               
               <div class="collection_list_head">
                  <h5 class="no-margin">Collections</h5>
               </div>

               <div class="user_profile_collection_list">
                  <!-- .collection_list here -->
                  <?php
                  if (isset($user_collections['data'])):
                     foreach ($user_collections['data'] as $collections): 
                  ?>

                  <div class="collection_list">
                     <div class="user_collection">
                        <?=  
                           "<a href='collection.php?author=" . $_SESSION['username'] . "&collection=" . $collections['collection_name'] . "'>" . $collections['collection_name'] . "</a>";
                        ?>
                     </div>
                     <button class="valign-wrapper delete_coll_btn" data-delete-collection="<?= $collections['collection_name'] ?>" title="delete collection">
                        <i class="material-icons tiny center-align">close</i>
                     </button>
                  </div>

                  <?php 
                     endforeach; 
                  else:
                  ?>

                  <div class="make_collection_box">
                     <form action="" method="post" name="create_coll_form" class="create_coll_form">
                        <div class="inputbox">
                           <input type="text" name="create_collection" placeholder="Create your Collection">
                        </div>
                        <div class="create_coll_btn">
                           <button type="submit" id="coll_add_btn">Create</button>
                        </div>
                     </form>
                  </div>

                  <?php
                  endif;
                  ?> 

               </div>
               <!-- #user_profile_collection_list -->
               
            </div>
            <!-- .collection_list_box -->

         </div>
         <!-- .collection_list_cont -->

         <?php endif; ?>

      </div>
      <!-- .right_cont -->

   </div>
   <!-- .profile_container -->


</main>





<?php 

include "./includes/popup_module.inc.php";
include "./includes/categories.inc.php";
include "./includes/footer.inc.php";

?>