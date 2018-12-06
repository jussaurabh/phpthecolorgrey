
<?php 

	require_once "includes/function.inc.php";


	if (isset($_POST['comment_qtid'])) {
		$data = getAll("SELECT * FROM comment WHERE cmnt_quote_id='" . $_POST['comment_qtid'] . "'");

		// if (isset($selected_comment_data['user']))
		// 	echo json_encode($selected_comment_data);
		// else
		// 	echo "nothign found";

		// echo json_encode($data['data']);
		
	}


?>

<div class="user_comment_section">

	<?php 
	if (isset($data['data'])):

		foreach ($data['data'] as $comments):
	?>

	<div class="user_comment">
		<div class="user_cmnt_right">
			<div class="user_avatar">
				<img src="./assets/images/profile.jpg" alt="">
			</div>
		</div>
		<div class="cmnt_wrapper">
			<div class="cmnt_user">
				<p class="no-margin">
					<span>
						<small>
							<a href="profile.php?author=<?= $comments['user'] ?>"> 
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
<!-- .user_comment_section -->
