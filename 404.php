<?php

echo "<a href='index.php'>home</a>";


require "./classes/Dbs.php";

$conn = Dbs::connect();
$data = array();


$sql = "SELECT * FROM quote";

$result = $conn->query($sql);
$rownum = $result->num_rows;

echo "<br> totalrows return are : " . $rownum . " <br>";


if ($result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
      // echo " username: " . $row['username'];
      $data[] = $row;
   }
}
else
   echo "0 rows";


foreach ($data as $d) {
   
   get($d['quoted_datetime']);

}

function get($date) {
   // echo $d['quoted_datetime'];
   echo $date;
   // var_dump($d['quoted_datetime']);
   var_dump($date);
   // $t = $d['quoted_datetime'];
   $da[] = explode(' ', $date);
   echo "<br>";
   echo "<br> exploded date is ";
   var_dump($da);

   echo "<br><br> asn is " . $da[0][0];

   echo "<br>";

   // $d1 = strtotime($da[0][0]);
   // $new = date('Y-m-d', $d1);
   // echo "<br>" . $new;
   // var_dump($new);

   $d1 = new DateTime($da[0][0]);
   $present = new DateTime('now');
   $diff = date_diff($present, $d1);
   echo $d1->format('y m d');
   // echo $d2->format('y m d');
   $diffre = $diff->format('%a days');

   echo "<br> " . $date .  " " . $diffre;
   // echo "<br>" . $diff->format('%m months');
   // echo "<br>" . $diff->format('%y years');
}

// echo "<br>" . $diff->format('%a days');
//    echo "<br>" . $diff->format('%m months');
//    echo "<br>" . $diff->format('%y years');



function clicked() {
   echo "button clicked";
}

echo "<button onClick='" . clicked() . "'>click</button>"



?>