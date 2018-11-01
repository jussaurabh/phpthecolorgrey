<?php 

session_start();

if (!isset($_post['addbtn']))
   $_SESSION['num'] = 1;


function set($table, $name=NULL) {
   // echo "<br>table : " . var_dump($table);
   // echo "<br>name : " . var_dump($name);
   // echo "<br>condition : " . var_dump($condition);
   if (isset($name))
      get($table, $name);
   else
      get($table);
}

function get($table, $name=NULL) {

   // echo "<br>table : " . var_dump($table);
   // echo "<br>name : " . var_dump($name) . "<br>";
   // echo "<br>condition : " . var_dump($condition);
   
   if (isset($name))
      echo "<br>table is : " . $table . " name is : " . $name . "<br>";
   else
      echo "<br>table is : " . $table . "<br>";
      

   
}

set('mytablename'); 




$now = strtotime('now');
$time = strtotime('12:2:60');

$nowtime = date('h:m:s', $now);
$newtime = date('h:m:s', $time);
var_dump($newtime);
echo "<br> newtime: " . $newtime . " nowtime: " . $nowtime;

$da = new DateTime();
echo "<br>" . $da->format('Y - m - d h:m:s');

echo date('Y - m - d h:i:s', 1540670879);



// echo $_SESSION['num']++;

?>


