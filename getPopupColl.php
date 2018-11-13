<?php 

require "includes/session.inc.php";
require_once "includes/function.inc.php";

if (isset($_SESSION['uid'])) {
   $user_collections = getAll("SELECT * FROM user_collection WHERE uid='" . $_SESSION['uid'] . "'");
}

// if(isset($_POST['quote_id'])) {
// 	$selected_qtid = $_POST['quote_id'];
// }



if (isset($user_collections['data'])): 
?>

<ul 
	class="dropdown_list collection_dropdown_list" 
	data-selected-qtid="<?= $_POST['quote_id'] ?>" 
	style="overflow-y: scroll; max-height: 150px;">

	<?php foreach ($user_collections['data'] as $user_coll): ?>

	<li>
		<label for="<?= $user_coll['collection_name'] ?>">
			<input type="checkbox" name="<?= $user_coll['collection_name'] ?>" id="<?= $user_coll['collection_name'] ?>">
			<span><?= $user_coll['collection_name'] ?></span>
		</label>
	</li>

	<?php endforeach; ?>
</ul>

<?php endif; ?>