
<?php 

	require_once "includes/function.inc.php";

	// $somedata = [
	// 	"quote" => "some quote by author",
	// 	"quote_author" => "saurabh"
	// ];

	if (isset($_POST['quote_id'])) {
		$data = getAll("SELECT * FROM quote WHERE quote_id='" . $_POST['quote_id'] . "'");

		$selected_quote_data = [
			"quote" => $data['data']['quote'],
			"quote_author" => $data['data']['quote_author'],
			"quote_date" => getDateDiff($data['data']['quoted_datetime'])
		];

		echo json_encode($selected_quote_data);
	}


?>
