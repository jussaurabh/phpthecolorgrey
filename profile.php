<?php 

require "./includes/session.inc.php";

require_once "./includes/function.inc.php";

$user_quotes = getAll("SELECT * FROM quote WHERE uid='" . $_GET['i'] . "' ORDER BY quoted_datetime");

$user_profile_details_data = getAll("SELECT designation, description FROM user WHERE uid='" . $_GET['i'] . "'");
$user_profile_details = $user_profile_details_data['data'][0];


if (isset($_SESSION['uid']) || isset($_GET['i'])) {   


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


   // Getting like counts
   $likeCount = getAll("SELECT * FROM favorite WHERE liked_by='" . $_GET['i'] . "'");

   $likedQuote = getAll("
      SELECT quote.uid, quote.quote_id, quote.quote, quote.quote_author, quote.quoted_datetime, quote_tags FROM quote JOIN favorite ON quote.quote_id = favorite.quote_id WHERE favorite.liked_by='" . $_GET['i'] . "'
   ");


   if (isset($_SESSION['uid'])) {
      $user_collections = getAll("SELECT * FROM user_collection WHERE uid='" . $_SESSION['uid'] . "'");

      $isFollow = getAll("SELECT * FROM follow WHERE followed_by_uid='" . $_SESSION['uid'] . "' AND followed_to_uid='" . $_GET['i'] . "'");
   }
}


// Checking if user profile exist or not
$profile_img_target = "assets/images/profile/";
$files = glob($profile_img_target . "*.*");

if (isset($_SESSION['uid'])) {
   foreach ($files as $file) {
      $filename = substr($file, strlen($profile_img_target));
      $tmp = explode('.', $filename);
      if ($tmp[0] == $_GET['i']) {
         $userProfile = $profile_img_target . $filename;
      }
   }
}


include "./includes/header.inc.php";

?>



<main id="user_profile_page">


   <div class="container-fluid profile_container"> 

      <div class="left_cont">

         <div class="user_profile_box">
            <div class="user_avatar valign-wrapper">

               <?php if (!isset($userProfile)): ?>
                  <span class="valign-wrapper center-align">
                     <i class="material-icons center-align medium">account_circle</i>
                  </span>
               <?php else: ?>
                  <div class="avatar valign-wrapper">
                     <img src="<?= $userProfile ?>" class="center-align"/>
                  </div>
               <?php endif; ?>

            </div>

            <div class="username">
               <p class="center"> <?= $_GET['author'] ?> </p>

               <?php 
               if (!empty($user_profile_details['designation'])):
               ?>
                  <p class="center no-margin-bottom" style="color:grey"><small>Designation</small></p>

                  <p class="center no-margin-top"> <?= $user_profile_details['designation'] ?> </p>
               <?php 
               endif;
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
                     <?= $user_quotes['rowcount']; ?>
                  </span>
               </p>

               <p class="center" class="user_qt_like_count">
                  <span id="user_qt_like_count"> Likes 
                     <?= $likeCount['rowcount'] ?>
                  </span>
               </p>
            </div>
            <!-- .user_profile_tag -->

            <?php if (!empty($user_profile_details['description'])): ?>

            <div class="about_author">
               <p class="no-margin">
                  <?= $user_profile_details['description'] ?>
               </p>
            </div>

            <?php endif; ?>
         </div>
         <!-- .user_profile_box -->

      </div>
      <!-- .left_cont -->

      <div class="mid_cont">

         <?php if (isset($_SESSION['uid']) && ($_GET['i'] == $_SESSION['uid'])): ?>

         <div class="quote_form_block">
            <form action="" method="post" class="quote_submit_form">

               <p class="no-margin-top" id="quoteErr"><small></small></p>

               <div class="inputbox valign-wrapper" 
                  style="max-width: 100%; background-color: #f7f7f7;">

                  <textarea id="textarea1" name="quote" placeholder="Write a quote <?= $_SESSION['username'] ?>" style="border: none;" class="materialize-textarea no-margin" data-length="300"></textarea>
               </div>


               <div class="chips chips-placeholder inputbox" 
                  style="text-align: left; max-width: 100%; background-color: #f7f7f7;"></div>               

               <div class="inputbtn" style="margin: auto 0px auto auto; width: 100px;">
                  <input type="submit" name="quote_submit" value="Submit">
               </div>
            
            </form>
         </div>

         <?php endif; ?>

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

               <?php if (isset($_SESSION['uid']) && ($_GET['i'] == $_SESSION['uid'])): ?>

                  <button class="qtBlock-opts valign-wrapper" 
                     style="cursor: pointer;"
                     data-target="<?= $data['quote_id'] ?>">
                     <i class="material-icons tiny">create</i>
                  </button>

                  <ul class="quote-edit-opts no-margin" 
                     id="<?= $data['quote_id'] ?>">
                     
                     <li class="qtEditBtn">
                        <a href="" style="color: #121212;">Edit</a>
                     </li>
                     <li class="qtDeleteBtn">
                        <a href="" style="color: #121212;">Delete</a>
                     </li>
                  
                  </ul>

               <?php endif; ?>

               <div class="quoteTags">
                  <p class="no-marign"><small>Tags - <?= $data['quote_tags'] ?></small></p>
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

                                    echo "<i class='material-icons tiny favActive user_like_btn user_unlike_btn'>favorite</i><i class='material-icons tiny' style='color:grey; font-size:5px; padding: 0 2.5px;'>fiber_manual_record</i>" . $favCount['rowcount'];

                                 else:

                                    echo "<i class='material-icons tiny user_like_btn'>favorite</i><i class='material-icons tiny' style='color:grey; font-size:5px; padding: 0 2.5px;'>fiber_manual_record</i>" . $favCount['rowcount'];

                                 endif;

                              else:
                                 echo "<i class='material-icons tiny user_like_btn'>favorite_border</i>";

                              endif;
                           
                           else: ?>

                              <i class="material-icons tiny user_like_btn">favorite_border</i>

                           <?php endif; ?>

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


         <!-- ------ Followers Wollowing List ----------------- -->
         <div class="follow-block-container">

            <span class="block-close valign-wrapper"><i class="material-icons tiny align-center">close</i></span>

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

                        <?php if(($value['username'] != $_SESSION['username']) && ($value['uid'] != $_SESSION['uid'])): ?>

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

                        <?php endif; ?>

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


         <div class="liked-quote-container">

            <div class="liked_qt_cont_header">
               <h5 class="no-margin">Likes</h5>
               <span class="block-close valign-wrapper">
                  <i class="material-icons tiny align-center">close</i>
               </span>
            </div>

            <?php if ($likedQuote['rowcount'] == 0): ?>

               <div style="height: 100px; text-align: center;" class="valign-wrapper">
                  <p style="margin:auto; color: grey;">No quotes liked yet!!</p>
               </div>

            <?php else: ?>

            <div class="liked_qt_list">

               <?php foreach ($likedQuote['data'] as $likeqt): ?>

               <div class="liked_qt_block">

                  <div class="liked_qt_header">
                     <div class="qt_avatar">
                        <img src="./assets/images/profile.jpg" class="imgfitparent" alt="">
                     </div>
                     <div class="qt_username valign-wrapper">
                        <p class="no-margin">
                           <a href="profile.php?author=<?= $likeqt['quote_author'] ?>&i=<?= $likeqt['uid'] ?>"><?= $likeqt['quote_author'] ?></a>
                        </p>
                     </div>
                  </div>

                  <div class="liked_qt">
                     <p> <?= $likeqt['quote'] ?>
                        <br/>
                        <a href="profile.php?author=<?= $likeqt['quote_author'] ?>&i=<?= $likeqt['uid'] ?>">- <?= $likeqt['quote_author'] ?></a>
                     </p>
                  </div>

                  <div class="liked_qt_footer">

                     <div class="qt_time">
                        <span>
                           <small style="color: grey;">
                              <?php 
                                 $date = getDateDiff($likeqt['quoted_datetime']);
                                 echo $date;
                              ?>
                           </small>
                        </span>
                     </div>

                     <div class="qt_actions valign-wrapper">

                        <div class="qt_btns quoteBtns valign-wrapper">
                           <span 
                              class="center-align valign-wrapper cmnt_open_btn"
                              data-cmnt-qt="<?= $likeqt['quote']; ?>"
                              data-cmnt-qtauthor="<?= $likeqt['quote_author'] ?>"
                              data-cmnt-qtdatetime="<?= $date ?>"
                              data-cmnt-qtid="<?= $likeqt['quote_id'] ?>"
                              data-cmnt-uid="<?= $likeqt['uid'] ?>"
                              >
                              <i class="material-icons center-align" style="font-size: 20px;">comment</i>
                           </span>
                        </div>

                        <div class="qt_btns quoteBtns valign-wrapper">
                           <span class="center-align valign-wrapper fav-quote">

                              <?php 
                              if (isset($_SESSION['uid'])): 

                                 $favCount = getAll("SELECT * FROM favorite WHERE author='" . $likeqt['uid'] . "' AND quote_id='" . $likeqt['quote_id'] . "'");


                                 if ($favCount['rowcount'] > 0):

                                    $index = -1;
                                    foreach ($favCount['data'] as $favData) {
                                       if ($favData['liked_by'] == $_SESSION['uid'])
                                          $index = 1;
                                    }

                                    if ($index == 1):

                                       echo "<i class='material-icons tiny favActive user_like_btn user_unlike_btn'>favorite</i><i class='material-icons tiny' style='color:grey; font-size:5px; padding: 0 2.5px;'>fiber_manual_record</i>" . $favCount['rowcount'];

                                    else:

                                       echo "<i class='material-icons tiny user_like_btn'>favorite</i><i class='material-icons tiny' style='color:grey; font-size:5px; padding: 0 2.5px;'>fiber_manual_record</i>" . $favCount['rowcount'];

                                    endif;

                                 else:
                                    echo "<i class='material-icons tiny user_like_btn'>favorite_border</i>";

                                 endif;
                              
                              else: ?>

                                 <i class="material-icons tiny user_like_btn">favorite_border</i>

                              <?php endif; ?>

                           </span>
                        </div>

                        <div class="qt_btns quoteBtns valign-wrapper">
                           <span 
                              class="center-align valign-wrapper collection_btn" 
                              data-qtid="<?= $likeqt['quote_id'];?>">
                              <i class="material-icons center-align" style="font-size: 20px;">add_box</i>
                           </span>
                        </div>

                     </div>
                     <!-- .qt_actions -->

                  </div>
                  <!-- .liked_qt_footer -->

               </div>
               <!-- .liked_qt_block -->

               <?php endforeach; ?>

            </div>
            <!-- .liked_qt_list -->

            <?php endif; ?>

         </div>
         <!-- .liked-quote-container -->

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