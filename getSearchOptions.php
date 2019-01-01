<?php 

require "includes/function.inc.php";

// unset($found_data);

if (isset($_POST['search_data'])) {
	$search_data = $_POST['search_data'];

	$authors = getAll("SELECT username, uid, designation FROM user");

	foreach ($authors['data'] as $key => $author) {
		$substr = substr_compare($search_data, $author['username'], 0, strlen($search_data));
		if ($substr == 0 && $author['username'] != "admin") {
			
			$num_quotes = getAll("SELECT quote FROM quote WHERE uid='" . $author['uid'] . "'");	
			$num_follow = getAll("SELECT * FROM follow WHERE followed_to_uid='" . $author['uid'] . "'");

			$found_data[$key]['author'] 		= $author['username'];
			$found_data[$key]['uid'] 			= $author['uid'];
			$found_data[$key]['designation']	= $author['designation'];
			$found_data[$key]['avatar'] 		= getAvatar($author['uid']);
			$found_data[$key]['num_quotes'] 	= $num_quotes['rowcount'];
			$found_data[$key]['num_follow'] 	= $num_follow['rowcount'];
		
		}
	}


}

?>


<div class="search_opt_box container displayblock" id="search_opt_box">

	<div style="max-height:300px; overflow-y:scroll; padding-right:10px;">

		<?php
		if (isset($found_data)):
			foreach($found_data as $data):
		?>

		<div class="search_opt_row valign-wrapper">
			<div class="srch_opt_left_sec valign-wrapper">

				<?php if ($data['avatar']): ?>

					<div class="target_avatar">
						<img src="<?= $data['avatar'] ?>" class="imgfitwithheight">
					</div>
				
				<?php else: ?>

					<span class="dummy_target_avatar valign-wrapper">
						<i class="material-icons">account_circle</i>
					</span>

				<?php endif; ?>

				<div class="target_name">
					<a href="index.php?search=<?= $data['uid'] ?>"> <?= $data['author'] ?> </a>
					<?php 
						if (!empty($data['designation']))
							echo "<small style='color:grey; padding-left:5px;'>" . $data['designation'] . "</small>"
					?>
				</div>
			</div>

			<div class="srch_opt_right_sec">
				<div class="target_data colorgrey">
					<small> 
						<span> <?= $data['num_quotes'] . " Quotes, " . $data['num_follow'] . " Followers" ?> </span> 
					</small>
				</div>
			</div>
		</div>

		<?php 
			endforeach;
		else:
		?>

		<div class="otherwise_msg valign-wrapper">
			No search results
		</div>

		<?php endif; ?>

	</div>
	
</div>


