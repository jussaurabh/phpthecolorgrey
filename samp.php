<?php 
session_start();

// $arr = array();
// $smap = [
//    "name" => "some",
//    "img" => "some img"
// ];
// array_push($arr, $smap);
// print_r($arr);
// $smap = [
//    "name" => "another",
//    "img" => "another img"
// ];
// array_push($arr, $smap);
// print_r($arr);


// foreach ($arr as $val) {
//    echo $val['name'];
// }








// $now = strtotime('now');
// $time = strtotime('12:2:60');

// $nowtime = date('h:m:s', $now);
// $newtime = date('h:m:s', $time);
// var_dump($newtime);
// echo "<br> newtime: " . $newtime . " nowtime: " . $nowtime;

// $da = new DateTime();
// echo "<br>" . $da->format('Y - m - d h:m:s');

// echo date('Y - m - d h:i:s', 1540670879);



// function createQuery($query) {
//    $select_opts = $delete_opts = $from_tbls = $join = $where = "";

//    echo sizeof($query);

//    if (array_key_exists('select', $query)) {
//        if (count($query['select']) > 0) {
//          foreach ($query['select'] as $cols) {
//             $select_opts .= $cols . ",";
//          }
//          $select_opts = substr($select_opts, 0, strlen($select_opts)-1);
//       }
//       else {
//          $select_opts = "*";
//       }
//    }


//    if (array_key_exists('delete', $query)) {
//       $delete_opts = $query['delete'];
//    }
   
   
//    if (array_key_exists('from', $query)) {
//       if (count($query['from']) > 0){
//          foreach ($query['from'] as $tbls) {
//             $from_tbls .= $tbls;
//          }
//       }
//    }

//    if (array_key_exists('join', $query)) {
//       if (sizeof($query['join']) > 0) {
//          foreach ($query['join'] as $join_tbl => $on_condition) {
//             $join .= " JOIN " . $join_tbl . " ON " . $on_condition;
//          }
//       }
//    }

//    if (array_key_exists('where', $query)) {
//       if (sizeof($query['where']) > 0) {
//          foreach ($query['where'] as $where_cond) {
//             $where .= $where_cond . " ";
//          }
//          $where = " WHERE " . $where;
//       }
//    }
   

//    if (!empty($select_opts)) {
//       if (!empty($where) && !empty($join))
//          $sql = "SELECT " . $select_opts . " FROM " . $from_tbls . $join . $where;
//       elseif (!empty($where))
//          $sql = "SELECT " . $select_opts . " FROM " . $from_tbls . $where;
//       elseif (!empty($join))
//          $sql = "SELECT " . $select_opts . " FROM " . $from_tbls . $join;
//       else 
//          $sql = "SELECT " . $select_opts . " FROM " . $from_tbls;
//    }

//    if (!empty($delete_opts)) {
//       $sql = "DELETE FROM " . $delete_opts . $where;
//    }

   
//    return $sql; 
   
// }

// createQuery(array(
//    'select' => array(
//       'user_collection.coll_name', 
//       'quote.quote',
//       'quote.quote_author'
//    ),
//    'from' => array('user_collection'),
//    'where' => array(
//       'user_collection.collection_name="mycol"',
//       'AND',
//       'user_collection.uid="1539925346"'
//    ),
//    'join' => array(
//       'quote_collection' => 'user_collection.collection_id=quote_collection.coll_id',
//       'quote' => 'quote_collection.quote_id=quote.quote_id'
//    ),
   
// )); 



if (isset($_POST['submit'])) {

   $target = "assets/images/";

   $origName = basename($_FILES['imgfile']['name']);
   $tmp = explode('.', $origName);
   $ext = end($tmp);

   $newName = "some." . $ext;
   
   $target_file = $target . $newName;

   if (move_uploaded_file($_FILES['imgfile']['tmp_name'], $target_file)) {
      echo "\n\n file uploaded";
   }
   else {
      echo "not uploaded";
   }

   // echo "<img src='assets/images/" . $newName . "'/>";

   $files = glob("assets/images/*.*");
   print_r($files);
   
   // foreach ($files as $file) 
   //    if ($file == $target_file) {
   //       echo "<img src='assets/images/" . $newName . "'/>";
   //       break;
   //    }

   if (in_array($target_file, $files)) {
      echo "<img src='assets/images/" . $newName . "'/>";
   }
   

}


// $filearr = glob("assets/images/profile/*.*");
// $n = "stan-lee.jpeg";
// if (in_array("assets/images/profile/" . $n, $filearr))
// 	echo "<br> found <br>";
// else 
// 	echo "<br> not found <br>";



function getAvatar($uid) {
	$profile_img_target = "./assets/images/profile/";
	$files = glob($profile_img_target . "*.*");

	echo "<br><br> all files are : " . print_r($files) . "<br><br>"; 

	$flag = "";

	foreach ($files as $file) {
		$filename = substr($file, strlen($profile_img_target));
		$tmp = explode('.', $filename);
		if ($tmp[0] == $uid) {
			$userProfile = $profile_img_target . $filename;
			$flag = true;
			break;
		}
		else {
			$flag = false;
			echo "<br> filename : " . $filename;
		}
	}
	
	return ($flag) ? $userProfile : "false";
}

$some = getAvatar($_GET['i']);
echo $_GET['i'];
echo "return from getavatar " . $some;

?>

<form action="" method="post" enctype="multipart/form-data">
   <input type="file" name="imgfile">
   <input type="submit" name="submit" value="submit">
</form>


<a href="download.php">download imag</a>




