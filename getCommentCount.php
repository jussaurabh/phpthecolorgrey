<?php 

require "includes/function.inc.php";

$cmntCount = getAll("SELECT user_comment FROM comment WHERE cmnt_quote_id='" . $_POST['comment_qtid'] . "'");

?>

<span class="center-align valign-wrapper commentCount">
	<i class='material-icons tiny' style='color:grey; font-size:5px; padding: 0 2.5px;'>fiber_manual_record</i>
	<?= $cmntCount['rowcount'] ?>
</span>