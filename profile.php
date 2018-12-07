<?php 

require "./includes/session.inc.php";

require_once "./includes/function.inc.php";

$user_quotes = getAll("SELECT * FROM quote WHERE quote_author='" . $_GET['author'] . "'");

if (isset($_SESSION['uid']) || isset($_GET['i'])) {   

   $id = isset($_SESSION['uid']) ? $_SESSION['uid'] : $_GET['i'];

   // Count of User following number of authors
   $following_count = getAll(
      "SELECT * FROM follow WHERE followed_by_uid='" . $_GET['i'] . "'"
   );

   // Count of User Followers
   $followers_count = getAll(
      "SELECT * FROM follow WHERE followed_to_uid='" . $_GET['i'] . "'"
   );

   // Getting all Followers Data
   // $followers_list = getFollow(
   //    "SELECT followed_by_uid FROM follow WHERE followed_to_uid='" . $_GET['i'] . "'",
   //    "followed_by_uid"
   // );

   // Getting all Followings Data
   $following_list = getFollow(
      "SELECT followed_to_uid FROM follow WHERE followed_by_uid='" . $_GET['i'] . "'",
      "followed_to_uid"
   );


   if (isset($_SESSION['uid'])) {
      $user_collections = getAll("SELECT * FROM user_collection WHERE uid='" . $_SESSION['uid'] . "'");

      $isFollow = getAll("SELECT * FROM follow WHERE followed_by_uid='" . $_SESSION['uid'] . "' AND followed_to_uid='" . $_GET['i'] . "'");
   }
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
                  echo "<p class='center'>" . $_GET['author'] . "</p>";
               ?>
            </div>

            <hr class="lightgrey-hr">

            <div class="user_profile_tag">

               <?php if (isset($_SESSION['username']) && ($_GET['author'] != $_SESSION['username'])): ?>

                  <div class="center follow_btn_wrapper" data-follow-to-id="<?= $_GET['i'] ?>">
                     <?php if (isset($isFollow) && ($isFollow['rowcount'] > 0)): ?>
                        
                        <button class="following_btn">Following</button>
                     
                     <?php else: ?>

                        <button class="follow_btn">Follow</button>

                     <?php endif; ?>
                     
                  </div>

               <?php endif; ?>


               <?php if (isset($_SESSION['uid'])): ?>

                  <p class="center">
                     <span id="follower_count" data-target-uid="<?= $_GET['i'] ?>">
                        <?php 
                           if (isset($followers_count['rowcount']))
                              echo "Followers " . $followers_count['rowcount'];
                           else 
                              echo "Followers 0";
                        ?>
                     </span>
                  </p>

                  <p class="center">
                     <span id="following_count" data-target-uid="<?= $_GET['i'] ?>"> 
                        <?php 
                           if (isset($following_count['rowcount']))
                              echo "Following " . $following_count['rowcount'];
                           else 
                              echo "Following 0";
                        ?>
                     </span>
                  </p>

               <?php endif; ?>

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
                        echo "<p class='no-margin'><small>" . $date . "</small></p>"
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
                           21
                        </span>
                     </div>
                     <div class="quoteBtns valign-wrapper">
                        <span 
                           class="center-align valign-wrapper collection_btn" 
                           data-qtid="<?= $data['quote_id'];?>">
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


         <div class="follow-block-container">

            <span class="follow-block-close valign-wrapper"><i class="material-icons tiny align-center">close</i></span>

            <ul class="follow_tab no-margin-top" style="margin-bottom: 3em;">
               <li>
                  <a href="#followers" class="follow_tab_followers_btn">
                     <?php 
                        if (isset($followers_count['rowcount']))
                           echo "Followers " . $followers_count['rowcount'];
                        else 
                           echo "Followers 0";
                     ?>
                  </a>
               </li>
               <li>
                  <a href="#following" class="follow_tab_following_btn">
                     <?php 
                        if (isset($following_count['rowcount']))
                           echo "Following " . $following_count['rowcount'];
                        else 
                           echo "Following 0";
                     ?>
                  </a>
               </li>
            </ul>


            <?php if (isset($_SESSION['uid'])): ?>
            <section id="follow_data_section">
               
               <div id="followers">
   
               </div>
               <!-- #followers -->
   
               <div id="following">

                  <?php 
                  if (isset($following_list)):
                     foreach ($following_list as $value):
                  ?>
   
                     <div class="follow_row">
                        <div class="user_avatar">
                           <img src="./assets/images/profile.jpg" alt="">
                        </div>
                        <div class="user_name">
                           <p> 
                              <a href="profile.php?author=<?= $value['username'] ?>&i=<?= $value['uid'] ?>">
                                 <?= $value['username'] ?>
                              </a> 
                           </p>
                        </div>
                        <div class="unfollow_btn valign-wrapper follow_btn_wrapper" data-follow-to-id="<?= $value['uid'] ?>">
                           <?php 
                           $chkFollow = getAll(
                              "SELECT * FROM follow WHERE followed_by_uid='" . $_SESSION['uid'] . "' AND followed_to_uid='" . $value['uid'] . "'"
                           );

                           if ($chkFollow['rowcount'] > 0):
                           ?>
                              <button class="following_btn">Following</button>
                           <?php 
                           else:
                           ?>
                              <button class="follow_btn">Follow</button>
                           <?php 
                           endif; 
                           ?>
                        </div>
                     </div>

                  <?php
                     endforeach;
                  else:
                  ?>

                     <div class="valign-wrapper" style="justify-content: center; color: grey; height: 100px;">
                        <p>No Followings yet</p>
                     </div>

                  <?php 
                  endif; 
                  ?>
   
               </div>
               <!-- #following -->

            </section>
            <?php endif; ?>


         </div>
         <!-- .follow-block-container -->

      </div>
      <!-- .mid_cont -->


      <div class="right_cont">

         <?php if (isset($_SESSION['username']) && $_SESSION['username'] == $_GET['author']): ?>

         <div class="collection_list_cont">

            <div class="collection_list_box"> 
               
               <div class="collection_list_head">
                  <h5 class="no-margin">Collections</h5>
               </div>

               <div class="open_make_coll_box valign-wrapper">
                  <span class="center-align valign-wrapper"><i class="material-icons">playlist_add</i></span>
                  <span style="padding-left: 0.5em;">Create Collection</span>
               </div>

               <div class="make_collection_box">
                  <form action="" method="post" name="create_coll_form" class="create_coll_form">
                     <div class="inputbox">
                        <input type="text" name="create_collection" placeholder="Create your Collection">
                     </div>
                     <div class="create_coll_btn">
                        <span id="make_coll_cancel_btn">Cancel</span>
                        <button type="submit" id="make_coll_add_btn">Create</button>
                     </div>
                  </form>
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
                     <button 
                        class="valign-wrapper delete_coll_btn" 
                        data-delete-collection="<?= $collections['collection_name'] ?>" 
                        title="delete collection">
                        <i class="material-icons tiny center-align">close</i>
                     </button>
                  </div>

                  <?php 
                     endforeach; 
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