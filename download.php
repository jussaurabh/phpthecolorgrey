<?php 

header("Content-disposition: attachment; filename=assets/images/some.png");

header("Content-type: application/pdf");
readfile("assets/images/some.png");




?>