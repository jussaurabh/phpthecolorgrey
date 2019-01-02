<?php 
session_start();

require_once "../classes/Validate.php";

if (isset($_POST['edited_quote']) && isset($_POST['edited_quote_id'])) {

	$edited_quote = $_POST['edited_quote'];
	$edited_quote_id = $_POST['edited_quote_id'];

	$validate = new Validate;

	$validate->editQuote($edited_quote, $edited_quote_id);
}


?>