<?php 
session_start();

unset($_SESSION['username']);
unset($_SESSION['uid']);
unset($_COOKIE['username']);
unset($_COOKIE['userid']);

setcookie("username", null, -1, "/phpthecolorgrey");
setcookie("userid", null, -1, "/phpthecolorgrey");

session_destroy();

header("Location: index.php");

?>


