
<?php 

	require_once "includes/function.inc.php";


	if (isset($_POST['comment_qtid'])) {
		$data = getAll("SELECT * FROM comment WHERE cmnt_quote_id='" . $_POST['comment_qtid'] . "' ORDER BY comment_date DESC");
	}


?>

<div class="user_comment_section">

	<?php 
	if (isset($data['data'])):

		foreach ($data['data'] as $comments):
	?>

	<div class="user_comment">
		<div class="user_cmnt_right">

			<?php if (getAvatar($comments['uid']) == true): ?>

			<div class="user_avatar">
				<img src="<?= getAvatar($comments['uid']) ?>">
			</div>
			
			<?php else: ?>
			
			<span class="userProfileDummyImg center-align valign-wrapper">
				<i class="material-icons center-align small" style="color:grey;">account_circle</i>
			</span>
			
			<?php endif; ?>

		</div>
		<div class="cmnt_wrapper">
			<div class="cmnt_user">
				<p class="no-margin">
					<span>
						<small>
							<a href="profile.php?author=<?= $comments['user'] ?>&i=<?= $comments['uid'] ?>"> 
								<?= $comments['user'] ?> 
							</a>
						</small>
					</span>
					<span style="color: grey;">
						<small> <?= getDateDiff($comments['comment_date']) ?> </small>
					</span>
				</p>
			</div>
			<div class="cmnt">
				<p class="no-margin">
					<?= $comments['user_comment'] ?>
				</p>
			</div>
		</div>
	</div>
	<!-- .user_comment -->

	<?php 
		endforeach;
	endif;
	?>

</div>
