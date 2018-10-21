

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>thecolorgrey</title>

   <link rel="stylesheet" href="./assets/css/style.css">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  

   
</head>
<body>


   <header>
      <div class="logo">
         <h5>
            <a href="index.php">thecolorgrey
               <?php
                  if (isset($_SESSION['username']))
                     echo $_SESSION['username'];
               ?>
            </a>
         </h5>
      </div>

      <div class="searchbox_container">
         <div class="searchbox">
            <form>
               <div class="search-input-box">
                  <input type="text" placeholder="Search your favorite quote">
               </div>
               <div class="search-btn valign-wrapper">
                  <span class="center-align">
                     <i class="material-icons">search</i>
                  </span>
               </div>
            </form>
         </div>
      </div>

      <div class="profileicon">
         <div class="notifylogo valign-wrapper">
            <span class="notifyIcon center-align valign-wrapper">
               <i class="material-icons center-align small">notifications</i>
            </span>

            <div class="notify-dropdown">
               <div class="notify-head">
                  <h6 class="no-margin">Notifications</h6>
               </div>
               <div class="notify-body">
                  <ul class="no-margin">
                     <?php 
                        for ($i=0; $i < 6; $i++) {
                     ?>
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
                     <?php
                        }
                     ?>
                  </ul>
               </div>
            </div>
         </div>

         <div class="profilelogo valign-wrapper">
            <!-- <span class="userProfileDummyImg center-align valign-wrapper">
                  <i class="material-icons center-align small">account_circle</i>
                  </span> -->

            <div class="userProfileImg center-align valign-wrapper">
               <img src="./assets/images/profile.jpg" alt="profile image" class="center-align">
            </div>

            <div class="profile-dropdown">
               <ul class="user-menu">
                  <!-- <li>
                     <a href="#">   
                     </a>
                  </li>
                  <li><hr/></li> -->
                  <?php 
                     if (isset($_SESSION['username'])) {
                        echo "<li><a href=\"#\">" . $_SESSION['username'] . "</a></li>";
                        echo "<li><hr/></li>";
                     }
                  
                  ?>
                  <li><a href="writequote.php">Write a quote</a></li>
                  <li><a href="#">Categories</a></li>
                  <?php
                     if (!isset($_SESSION['username']))
                        echo "<li><a href=\"login.php\">Login</a></li>"
                  ?>
                  <?php
                     if (isset($_SESSION['username']))
                        echo "<li><a href=\"logout.php\">Logout</a></li>"
                  ?>
               </ul>
            </div>

         </div>
      </div>
   </header>
