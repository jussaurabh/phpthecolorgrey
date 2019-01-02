<?php 
session_start();

require_once "includes/function.inc.php";


if (isset($_POST['edited_quote_id'])) {
	$rslt = getAll("SELECT quote FROM quote WHERE quote_id=" . $_POST['edited_quote_id']);

	foreach ($rslt['data'] as $newquote) {
		// echo "<p id='quote_para'" . $newquote['quote'] . "</p>";
		echo $newquote['quote'];
	}
}

?>