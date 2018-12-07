<?php

session_start();

require "./includes/function.inc.php";


switch ($_GET['fun']) {
	case 'followBtn':
		followBtn($_POST['followuid']);
		break;

	case 'followCount':
		followCount($_POST['followuid']);
		break;

	case 'followMembers':
		followMembers($_POST['followuid']);
		break;
	
	default:
		return;
}



function followBtn($followuid) {
	$rslt = getAll("SELECT * FROM follow WHERE followed_by_uid='" . $_SESSION['uid'] . "' AND followed_to_uid='" . $followuid . "'");

	if ($rslt['rowcount'] > 0) {
		echo "<button class=\"following_btn\"> Following </button>";
	}
	else 
		echo "<button class=\"follow_btn\"> Follow </button>";
}


function followCount($followuid) {
	$following_count = getAll("SELECT * FROM follow WHERE followed_by_uid='" . $followuid . "'");

	$follower_count = getAll("SELECT * FROM follow WHERE followed_to_uid='" . $followuid . "'");

	$follow = [
		"followers" => $follower_count['rowcount'],
		"following" => $following_count['rowcount']
	];

	echo json_encode($follow);
}



function followMembers($followuid) {

	$followers_list = getFollow(
		"SELECT followed_by_uid FROM follow WHERE followed_to_uid='" . $followuid . "'",
		"followed_by_uid"
	);

?>
               
	<div id="followers">

		<?php 
		if (isset($followers_list)):
			foreach ($followers_list as $value): 
		?>

			<div class="follow_row">
				<div class="user_avatar">
					<img src="./assets/images/profile.jpg" alt="">
				</div>
				<div class="user_name">
					<p> 
						<a href="profile.php?author=<?= $value['username'] ?>&i=<?= $value['uid'] ?>">
							<?= $value['username'] ?>
						</a> 
					</p>
				</div>
			
				<?php  
				if (($value['username'] != $_SESSION['username']) && ($value['uid'] != $_SESSION['uid'])): 
				?>      

					<div class="unfollow_btn valign-wrapper follow_btn_wrapper" data-follow-to-id="<?= $value['uid'] ?>">
						<?php 
						$chkFollow = getAll(
							"SELECT * FROM follow WHERE followed_by_uid='" . $_SESSION['uid'] . "' AND followed_to_uid='" . $value['uid'] . "'"
						);

						if ($chkFollow['rowcount'] > 0):
						?>
							<button class="following_btn">Following</button>
						<?php 
						else:
						?>
							<button class="follow_btn">Follow</button>
						<?php 
						endif; 
						?>
					</div>

				<?php endif; ?>
			</div>
			<!-- .follow_row -->

		<?php
			endforeach;
		else:
		?>

			<div class="valign-wrapper" style="justify-content: center; color: grey; height: 100px;">
				<p>No Followers yet</p>
			</div>

		<?php endif; ?>

	</div>

<?php 

}
// followMembers function

?>