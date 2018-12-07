<?php 

session_start();

require "Dbs.php";


class CheckValue extends Dbs {

	public function checkUser($sql) {

		$conn = $this->connect();

		$result = $conn->query($sql);
		$row = $result->num_rows;

		return $row;

	}

}


if (isset($_POST['sgn_username']) || isset($_POST['sgn_email'])) {

	$chkvalue = new CheckValue;
	$username_chk = $email_chk = 0;


	if (isset($_POST['sgn_username']))
		$username_chk = $chkvalue->checkUser("SELECT username FROM user WHERE username='" . $_POST['sgn_username'] . "'");
	
	if (isset($_POST['sgn_email']))
		$email_chk = $chkvalue->checkUser("SELECT email FROM user WHERE email='" . $_POST['sgn_email'] . "'");
	
	
	$value_chk = [
		"username_chk" => $username_chk,
		"email_chk" => $email_chk,
	];
	

	echo json_encode($value_chk);
}

?>