<?php 


session_start();

require_once "includes/function.inc.php";


if ( isset($_POST['author']) && isset($_POST['quote_id']) ) {

	$favCount = getAll("SELECT * FROM favorite WHERE author='" . $_POST['author'] . "' AND quote_id='" . $_POST['quote_id'] . "'");

	$index = -1;
	if (isset($favCount['data'])) {
		foreach ($favCount['data'] as $favData) {
			if ($favData['liked_by'] == $_SESSION['uid'])
				$index = 1;
		}
	}

	if ( (isset($favCount['rowcount']) && ($favCount['rowcount'] > 0)) && $index == 1) {
		echo "<span class='center-align valign-wrapper fav-quote'><i class='material-icons center-align user_like_btn favActive'>favorite</i>" . $favCount['rowcount'] . "</span>";
	}
	elseif ( (isset($favCount['rowcount']) && ($favCount['rowcount'] > 0)) && $index != 1) {
		echo "<span class='center-align valign-wrapper fav-quote'><i class='material-icons center-align user_like_btn'>favorite</i>" . $favCount['rowcount'] . "</span>";	
	}
	else {
		echo "<span class='center-align valign-wrapper fav-quote'><i class='material-icons center-align user_like_btn'>favorite_border</i>0</span>";	
	}
}
else {
	echo "<span class='center-align valign-wrapper fav-quote'><i class='material-icons center-align user_like_btn'>favorite_border</i></span>";
}


?>