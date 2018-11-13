<?php 

require "includes/session.inc.php";
require_once "includes/function.inc.php";

if (isset($_SESSION['uid'])) {
   $user_collections = getAll("SELECT * FROM user_collection WHERE uid='" . $_SESSION['uid'] . "'");
}


?>

<div class="user_profile_collection_list">


	<?php
	if (isset($user_collections['data'])):
		foreach ($user_collections['data'] as $collections): 
	?>

	<div class="collection_list">
		<div class="user_collection">
			<?=  
				"<a href='collection.php?author=" . $_SESSION['username'] . "&collection=" . $collections['collection_name'] . "'>" . $collections['collection_name'] . "</a>";
			?>
		</div>
		<button class="valign-wrapper delete_coll_btn" data-delete-collection="<?= $collections['collection_name'] ?>" title="delete collection">
			<i class="material-icons tiny center-align">close</i>
		</button>
	</div>

	<?php 
		endforeach; 
	else:
	?>

	<div class="make_collection_box">
		<form action="" method="post" name="create_coll_form" class="create_coll_form">
			<div class="inputbox">
				<input type="text" name="create_collection" placeholder="Create your Collection">
			</div>
			<div class="create_coll_btn">
				<button type="submit" id="coll_add_btn">Create</button>
			</div>
		</form>
	</div>

	<?php
	endif;
	?>



</div>