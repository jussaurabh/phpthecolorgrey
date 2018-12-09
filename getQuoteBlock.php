
<?php 

session_start();
require_once "includes/function.inc.php";

if (isset($_POST['getquote'])) {
	$quoteBlock = getAll("SELECT * FROM quote WHERE quote_id='" . $_POST['getquote'] . "'");

	$quoteBlock = $quoteBlock['data'][0];

}


?>


<div class="quoteBlock">

	<button class="dropdown-trigger qtBlock-opts valign-wrapper"
		data-target="<?= $quoteBlock['quote_id'] ?>">
	
		<i class="material-icons tiny">create</i>
	
	</button>


	<ul class="dropdown-content"
		id="<?= $quoteBlock['quote_id'] ?>"
		style="border-radius: 5px;">
		
		<li>
			<a href="" style="color: #121212">Edit</a>
		</li>
		<li>
			<a href="" style="color: #121212">Delete</a>
		</li>

	</ul>

	<div class="quoteTags">
		<p class="no-margin">
			<small>
				Tags - <?= $quoteBlock['quote_tags'] ?>
			</small>
		</p>
	</div>

	<div class="quote">
		<p> <?= $quoteBlock['quote'] ?> </p>
		<p>
			<a href="profile.php?author=<?= $quoteBlock['quote_author'] ?>&i=<?= $quoteBlock['uid'] ?>">
				<small>
					- <?= $quoteBlock['quote_author'] ?>
				</small>
			</a>
		</p>
	</div>

	<div class="quoteBlockFooter">
		<div class="quotedTime">
			<?php 
				$date = getDateDiff($quoteBlock['quoted_datetime']);
				echo "<p class='no-margin'> <small> " . $date . " </small> </p>";
			?>
		</div>

		<div class="quoteActions valign-wrapper">
			<div class="quoteBtns valign-wrapper">
				<span class="center-align valign-wrapper cmnt_open_btn"
					data-cmnt-qt="<?= $quoteBlock['quote']
					 ?>"
					data-cmnt-qtauthor="<?= $quoteBlock['quote_author'] ?>"
					data-cmnt-qtdatetime="<?= $date ?>"
					data-cmnt-qtid="<?= $quoteBlock['quote_id'] ?>"
					data-cmnt-uid="<?= $quoteBlock['uid'] ?>">
					<i class="material-icons center-align">comment</i>
				</span>
			</div>

			<div class="quoteBtns valign-wrapper">
				<span class="center-align valign-wrapper">
					<i class="material-icons center-align">favorite_border</i>21
				</span>
			</div>

			<div class="quoteBtns valign-wrapper">
				<span 
					class="center-align valign-wrapper collection_btn" 
					data-qtid="<?= $quoteBlock['quote_id'] ?>">
					<i class="material-icons center-align">add_box</i>
				</span>
			</div>
		</div>
	</div>


</div>