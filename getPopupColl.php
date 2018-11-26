<?php 

require "includes/session.inc.php";
require_once "includes/function.inc.php";

if (isset($_SESSION['uid'])) {
   $user_collections = getAll("SELECT * FROM user_collection WHERE uid='" . $_SESSION['uid'] . "'");
}

if (isset($user_collections['data'])):
?>


<ul 
	class="dropdown_list collection_dropdown_list" 
	style="overflow-y: scroll; max-height: 150px;"
	data-selected-qtid="<?= $_POST['quote_id'] ?>">

	<?php foreach($user_collections['data'] as $colls): ?>

	<li>
		<label for="<?= $colls['collection_name'] ?>"
			class="dropdown_collection_list_chkbox">

			<input 
				type="checkbox" 
				name="<?= $colls['collection_name'] ?>" 
				id="<?= $colls['collection_name'] ?>">

			<span><?= $colls['collection_name'] ?></span>
		</label>
	</li>

	<?php endforeach; ?>
		
</ul>


<?php 

endif;

?>
