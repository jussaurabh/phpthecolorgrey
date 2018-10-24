<?php

echo "<a href='index.php'>home</a>";


require "./classes/Dbs.php";

$conn = Dbs::connect();
$data = array();
$tabledata = array();


$sql = "SELECT * FROM quote WHERE quote_author='rohan'";

$result = $conn->query($sql);
$rownum = $result->num_rows;

echo "<br> totalrows return are : " . $rownum . " <br>";


if ($rownum > 0) {
   while ($row = $result->fetch_assoc()) {
      // echo " username: " . $row['username'];
      $tabledata[] = $row;
   }
   $data = [
      'rownum' => $rownum,
      'data' => $tabledata
   ];
}
else
   echo "0 rows";



echo json_encode($data);


foreach ($data['data'] as $d) {
   echo "<br>name : " . $d['quote_author'];
}


// foreach ($data as $d) {
   
//    get($d['quoted_datetime']);

// }

// function get($date) {
//    // echo $d['quoted_datetime'];
//    echo $date;
//    // var_dump($d['quoted_datetime']);
//    var_dump($date);
//    // $t = $d['quoted_datetime'];
//    $da[] = explode(' ', $date);
//    echo "<br>";
//    echo "<br> exploded date is ";
//    var_dump($da);

//    echo "<br><br> asn is " . $da[0][0];

//    echo "<br>";

//    // $d1 = strtotime($da[0][0]);
//    // $new = date('Y-m-d', $d1);
//    // echo "<br>" . $new;
//    // var_dump($new);

//    $d1 = new DateTime($da[0][0]);
//    $present = new DateTime('now');
//    $diff = date_diff($present, $d1);
//    echo $d1->format('y m d');
//    // echo $d2->format('y m d');
//    $diffre = $diff->format('%a days');

//    echo "<br> " . $date .  " " . $diffre;
//    // echo "<br>" . $diff->format('%m months');
//    // echo "<br>" . $diff->format('%y years');
// }







?>