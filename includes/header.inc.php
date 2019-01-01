

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>thecolorgrey</title>

   <link rel="stylesheet" href="./assets/css/style.css">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

   <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet"> -->

   
</head>
<body>


   <header>
      <div class="logo">
         <h5>
            <a href="index.php">thecolorgrey</a>
         </h5>
      </div>

      <div class="profileicon">
         <div class="headerLogo valign-wrapper">
            <span class="searchIcon center-align valign-wrapper search_btn">
               <i class="material-icons center-align small">
                  search
               </i>
            </span>
         </div>  

         <!-- <div class="notifylogo valign-wrapper">
            <span class="notifyIcon center-align valign-wrapper">
               <i class="material-icons center-align small">notifications</i>
            </span>

            <div class="notify-dropdown">
               <div class="notify-head">
                  <h6 class="no-margin">Notifications</h6>
               </div>
               <div class="notify-body">
                  <ul class="no-margin"> 

                     <div class="default-placeholder valign-wrapper">
                        <span>No new notifications</span>
                     </div>

                     <li class="notify-li">
                        <a href="#">
                           <div class="notify-row">
                              <div class="notify-avatar valign-wrapper">
                                 <img src="./assets/images/profile.jpg" alt="" class="center-align">
                              </div>
                              <div class="notify-username">
                                 <p class="no-margin">
                                    <b>Username</b>
                                    <span><small>Tue 12:30Pm</small></span>
                                 </p>
                              </div>
                           </div>
                           <div class="notify-user-msg">
                              <p class="no-margin">Username liked your quote : "asdadad"</p>
                           </div>
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
         </div> -->
			<!-- .notifylogo -->

         <div class="profilelogo valign-wrapper">

            <?php 
				if (isset($_SESSION['uid'])):
					if(getAvatar($_SESSION['uid']) == true): 
				
				?>

            <div class="userProfileImg center-align">
               <img src="<?= getAvatar($_SESSION['uid']) ?>" alt="profile image" class="imgfitwithheight">
            </div>

            <?php 
					else: 
				?>

            <span class="userProfileDummyImg center-align valign-wrapper">
               <i class="material-icons center-align small">account_circle</i>
            </span>

            <?php 
					endif; 
				else:
				?>

				<span class="userProfileDummyImg center-align valign-wrapper">
               <i class="material-icons center-align small">account_circle</i>
            </span>

				<?php endif; ?>

            <div class="dropdown" id="profile_dropdown">
               <ul class="dropdown_list">
                  <?php 
                     if (isset($_SESSION['username']) && $_SESSION['username'] != "admin") {
                        echo "<li><a href=\"profile.php?author=" . $_SESSION['username'] . "&i=" . $_SESSION['uid'] . "\">" . $_SESSION['username'] . "</a></li>";
                        echo "<li><hr/></li>";
                     }   

							if (isset($_SESSION['username']) && $_SESSION['username'] == "admin") {
								echo "<li> <a href=\"adminProfile.php?author=" . $_SESSION['username'] . "&i=" . $_SESSION['uid'] . "\">" . $_SESSION['username'] . "</a></li>";
								echo "<li><hr/></li>";
							}
                  ?>
                  <!-- <li><a href="#">Categories</a></li> -->
                  <?php
                     if (!isset($_SESSION['username'])) {
                        echo "<li><a href=\"login.php\">Login</a></li>";
                        echo "<li><a href=\"signup.php\">Signup</a></li>";
                     }
                  ?>
                  <?php
                     if (isset($_SESSION['username'])) {
                        echo "<li><a href=\"setting.php\">Setting</a></li>";
                        echo "<li><a href=\"logout.php\">Logout</a></li>";
                     }
                  ?>
               </ul>
            </div>
            <!-- .dropdown -->

         </div>
      </div>
      <!-- .profileicon -->


      <div class="search_container">
         <div class="search_inputbox container">
            <form action="" method="POST" class="user_search_box">
               <input type="text" name="" id="searchinputbox" placeholder="Search your favorite quote, author or tag">
					<input type="submit" value="" hidden>
            </form>
            <div class="close_search_inputbox valign-wrapper">
               <span class="valign-wrapper center-align close_searchbox">
                  <i class="material-icons small center-align">clear</i>
               </span>
            </div>
         </div>

			<div class="search_opt_box container" id="search_opt_box">
				
			</div>
			<!-- .search_opt_box -->

      </div>
      <!-- .search_container -->
   </header>
