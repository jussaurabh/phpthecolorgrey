<?php 

session_start();

require "includes/function.inc.php";
require "./classes/Validate.php";

if (isset($_POST['addcategory'])) {
	$category = $_POST['newcategory'];

	$validate = new Validate;
	$validate->addCategory($category);
}


$categories = getAll("SELECT * from category ORDER BY categoryName");


include "includes/header.inc.php";

?>

<main>


	<div class="adminProContainer container">

		<div class="row">
			<form action="" method="POST" class="categoryAddBox">
				<div class="inputbox no-margin" style="flex:1; height:3em; margin-right:10px !important;">
					<input type="text" name="newcategory" placeholder="Add a category">
				</div>
				<div class="inputbtn no-margin" style="width:auto; height:2.5em;">
					<input type="submit" value="Add" name="addcategory" style="height:100%;">
				</div>
			</form>
		</div>


		<div class="row">

			<div class="categoriesContainer">

				<h5 class="categoryHeading">A</h5>

				<div class="categoriesOf">
					<?php 
						foreach($categories['data'] as $category)
							echo "<span> " . $category['categoryName'] . " </span>";
					?>
				</div>

			</div>
			<!-- .categoriesContainer -->
			
		</div>

	</div>
	<!-- .adminProContainer -->


</main>

<?php 

include "./includes/popup_module.inc.php";
include "./includes/footer.inc.php";

?>