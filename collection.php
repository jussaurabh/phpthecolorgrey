<?php 

require "./includes/session.inc.php";

require_once "./includes/function.inc.php";


if (isset($_SESSION['uid'])) {
	$user_collections = getAll("SELECT * FROM user_collection WHERE uid='" . $_SESSION['uid'] . "'");

	$collection_quotes = getAll("
		SELECT user_collection.collection_name, quote.quote_id, quote.uid, quote.quote, quote.quote_author, quote.quote_tags, quote.quoted_datetime FROM user_collection JOIN quote_collection ON user_collection.collection_id = quote_collection.collection_id JOIN quote ON quote_collection.quote_id = quote.quote_id WHERE user_collection.collection_name='" . $_GET['collection'] . "' AND user_collection.uid='" . $_SESSION['uid'] . "'"
	);

	// Getting like counts
   $likeCount = getAll("SELECT * FROM favorite WHERE liked_by='" . $_SESSION['uid'] . "'");

	$user_profile_details_data = getAll("SELECT designation, description FROM user WHERE uid='" . $_GET['i'] . "'");
	$user_profile_details = $user_profile_details_data['data'][0];
}
else {
	exit(header("Location: index.php"));
}



include "./includes/header.inc.php";

?>



<main id="user_profile_page">


	<div class="container-fluid profile_container"> 

		<div class="left_cont">

			<div class="user_profile_box">
				<div class="user_avatar valign-wrapper">

               <?php if (getAvatar($_GET['i']) == false): ?>
                  <span class="valign-wrapper center-align">
                     <i class="material-icons center-align medium">account_circle</i>
                  </span>
               <?php else: ?>
                  <div class="avatar">
                     <img src="<?= getAvatar($_GET['i']) ?>" class="imgfitwithheight"/>
                  </div>
               <?php endif; ?>

            </div>

				<div class="username">
               <p class="center"> <?= $_GET['author'] ?> </p>

               <?php 
               if (!empty($user_profile_details['designation'])):
               ?>
                  <p class="center no-margin-bottom" style="color:grey"><small>Designation</small></p>

                  <p class="center no-margin-top"> <?= $user_profile_details['designation'] ?> </p>
               <?php 
               endif;
               ?>
				</div>

				<hr class="lightgrey-hr">

				<div class="user_profile_tag">

					<p class="center">
					<span> Quotes 
						<?= $collection_quotes['rowcount']; ?>
					</span>
					</p>
				</div>

				<?php if (!empty($user_profile_details['description'])): ?>

            <div class="about_author">
					<p class="no-margin"><small style="color:grey;">Description</small></p>
               <p class="no-margin">
                  <?= $user_profile_details['description'] ?>
               </p>
            </div>

            <?php endif; ?>

			</div>
			<!-- .user_profile_box -->

		</div>
		<!-- .left_cont -->

		<div class="mid_cont">	
			
			<h5> <?= $_GET['collection'] ?> </h5>

			<div class="quote-block-container">

				<?php if (!isset($collection_quotes['data'])): ?>

				<div class="default-placeholder valign-wrapper">
					<span class="center-align">No Quotes writen yet</span>
				</div>

				<?php 
				else:
					foreach ($collection_quotes['data'] as $data):
				?>

				<div class="quoteBlock">

					<div class="quoteTags">
						<p class="no-marign"><small>Tags - <?= $data['quote_tags'] ?></small></p>
					</div>

					<div class="quote">
						<p> <?= $data['quote'] ?> </p>
						<p>
							<a href="profile.php?author=<?= $data['quote_author'] ?>&i=<?= $data['uid'] ?>">
							<small>- <?= $data['quote_author'] ?> </small>
							</a>
						</p>
					</div>

					<div class="quoteBlockFooter">
						<div class="quotedTime">
							<?php 
							$date = getDateDiff($data['quoted_datetime']);
							echo "<p class='no-margin'><small>" . $date . "</small></p>"
							?>
						</div>

						<div class="quoteActions valign-wrapper">
							<div class="quoteBtns valign-wrapper">
							<span 
								class="center-align valign-wrapper cmnt_open_btn"
								data-cmnt-qt="<?= $data['quote']; ?>"
								data-cmnt-qtauthor="<?= $data['quote_author'] ?>"
								data-cmnt-qtdatetime="<?= $date ?>"
								data-cmnt-qtid="<?= $data['quote_id'] ?>"
								data-cmnt-uid="<?= $data['uid'] ?>"
								>
								<i class="material-icons center-align">comment</i>
							</span>
							</div>

							<div class="quoteBtns valign-wrapper">
								<span class="center-align valign-wrapper fav-quote">

									<?php 
									if (isset($_SESSION['uid'])): 

										$favCount = getAll("SELECT * FROM favorite WHERE author='" . $data['uid'] . "' AND quote_id='" . $data['quote_id'] . "'");


										if ($favCount['rowcount'] > 0):

											$index = -1;
											foreach ($favCount['data'] as $favData) {
												if ($favData['liked_by'] == $_SESSION['uid'])
													$index = 1;
											}

											if ($index == 1):

											echo "<i class='material-icons tiny favActive user_like_btn user_unlike_btn'>favorite</i><i class='material-icons tiny' style='color:grey; font-size:5px; padding: 0 2.5px;'>fiber_manual_record</i>" . $favCount['rowcount'];

											else:

											echo "<i class='material-icons tiny user_like_btn'>favorite</i><i class='material-icons tiny' style='color:grey; font-size:5px; padding: 0 2.5px;'>fiber_manual_record</i>" . $favCount['rowcount'];

											endif;

										else:
											echo "<i class='material-icons tiny user_like_btn'>favorite_border</i><i class='material-icons tiny' style='color:grey; font-size:5px; padding: 0 2.5px;'>fiber_manual_record</i>0";

										endif;
									
									else: ?>

										<i class="material-icons tiny user_like_btn">favorite_border</i>

									<?php endif; ?>

								</span>
							</div>

							<div class="quoteBtns valign-wrapper">
							<span 
								class="center-align valign-wrapper collection_btn" 
								data-qtid="<?= $data['quote_id'];?>">
								<i class="material-icons center-align">add_box</i>
							</span>
							</div>
						</div>
						<!-- .quoteActions -->
					
					</div>
					<!-- .quoteBlockFooter -->
				</div>
				<!-- .quoteBlock -->

				<?php 
					endforeach;
				endif;
				?>

			</div>
			<!-- .quote-block-container -->


		</div>
		<!-- .mid_cont -->


		<div class="right_cont">

			<?php if (isset($_SESSION['username']) && $_SESSION['username'] == $_GET['author']): ?>

			<div class="collection_list_cont">

			<div class="collection_list_box"> 
				
				<div class="collection_list_head">
					<h5 class="no-margin">Collections</h5>
				</div>

				<div class="open_make_coll_box valign-wrapper">
					<span class="center-align valign-wrapper"><i class="material-icons">playlist_add</i></span>
					<span style="padding-left: 0.5em;">Create Collection</span>
				</div>

				<div class="make_collection_box">
					<form action="" method="post" name="create_coll_form" class="create_coll_form">
						<div class="inputbox">
						<input type="text" name="create_collection" placeholder="Create your Collection">
						</div>
						<div class="create_coll_btn">
						<span id="make_coll_cancel_btn">Cancel</span>
						<button type="submit" id="make_coll_add_btn">Create</button>
						</div>
					</form>
				</div>

				<div class="user_profile_collection_list">
					<!-- .collection_list here -->
					<?php
					if (isset($user_collections['data'])):
						foreach ($user_collections['data'] as $collections): 
					?>

					<div class="collection_list">
						<div class="user_collection">
						<?=  
							"<a href='collection.php?author=" . $_SESSION['username'] . "&i=" . $_SESSION['uid'] . "&collection=" . $collections['collection_name'] . "'>" . $collections['collection_name'] . "</a>";
						?>
						</div>
						<button 
						class="valign-wrapper delete_coll_btn" 
						data-delete-collection="<?= $collections['collection_name'] ?>" 
						title="delete collection">
						<i class="material-icons tiny center-align">close</i>
						</button>
					</div>

					<?php 
						endforeach; 
					endif;
					?> 

				</div>
				<!-- #user_profile_collection_list -->
				
			</div>
			<!-- .collection_list_box -->

			</div>
			<!-- .collection_list_cont -->

			<?php endif; ?>

		</div>
		<!-- .right_cont -->

	</div>
	<!-- .profile_container -->


</main>





<?php 

include "./includes/popup_module.inc.php";
include "./includes/categories.inc.php";
include "./includes/footer.inc.php";

?>