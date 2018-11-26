

<!-- Collection Dropdown Section -->
<div class="dropdown collection_dropdown"> 
	<div class="dropdown_create_btn valign-wrapper">
		<span class="center-align valign-wrapper"><i class="material-icons">playlist_add</i></span>
		<span style="padding-left: 0.5em;">Create Collection</span>
	</div>
	<form action="includes/add_collections.inc.php" method="post" class="create_collection_form" id="dropdown_coll_form">
		<div class="inputbox">
			<input type="text" name="collection_name" placeholder="Create Collection" id="coll_name">
		</div>

		<ul 
			class="dropdown_list collection_dropdown_list" 
			style="overflow-y: scroll; max-height: 150px;">

				
		</ul>

		<div class="dropdown_collection_btn">
			<span id="collection_cancel_btn">Cancel</span>
			<button type="submit" id="collection_add_btn">Add</button>
		</div>
	</form>
</div>
<!-- .collection_dropdown -->





<div class="lightbox">


	<!-- Confirmation Container Section -->
	<div class="confirmation_box">
		<div class="confirmation_msg">
			<p class="no-margin">The quote which are inside this collection will be also deleted.</p>
		</div>
		<div class="confirmation_btns">
			<button class="close_lightbox">Cancel</button>
			<button id="delete_collection">Delete</button>
		</div>
	</div>
	<!-- .confirmation_box -->


	<!-- Comment Container Section -->
	<div class="comment_container">

		<button class="close_lightbox valign-wrapper">
			<i class="material-icons tiny center-align">close</i>
		</button>

		<div class="cmnt_on">
			<div class="cmnt_quote">
				<p></p>
			</div>
			<div class="cmnt_author valign-wrapper">
				<span><small><a></a></small></span>
				<span><small></small></span>
			</div>

			<hr class="lightgrey-hr">
		</div>
		<!-- .cmnt_on -->

		<div class="cmnt_form">
			<form action="./getComment.php" method="post" name="cmnt_form" class="comment_form_block">
				<div class="inputbox">
					<input type="text" name="comment" placeholder="comment">
				</div>
				<div class="inputbtn">
					<button type="submit" class="valign-wrapper" id="submit_cmnt_btn">
						<i class="material-icons tiny centr-align">send</i>
					</button>
					<!-- <button>Submit</button> -->
				</div>
			</form>
		</div>
		<!-- ./cmnt_form -->

		<div class="user_comment_section">

			<div class="user_comment">
				<div class="user_cmnt_right">
					<div class="user_avatar">
						<img src="./assets/images/profile.jpg" alt="">
					</div>
				</div>
				<div class="cmnt_wrapper">
					<div class="cmnt_user">
						<p class="no-margin">
							<span><small>author name</small></span>
							<span style="color: grey;"><small>Today</small></span>
						</p>
					</div>
					<div class="cmnt">
						<p class="no-margin">
							Lorem ipsum dolor sit amet consectetur, adipisicing
						</p>
					</div>
				</div>
			</div>
			<!-- .user_comment -->

			<?php
				for ($i=0; $i<5; $i++):
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
							<span><small>author name</small></span>
							<span><small>Tue, 12 Sep</small></span>
						</p>
					</div>
					<div class="cmnt">
						<p class="no-margin">
							Lorem ipsum dolor sit amet consectetur, adipisicing
						</p>
					</div>
				</div>
			</div>
			<!-- .user_comment -->

			<?php
				endfor;
			?>

		</div>
		<!-- .user_comment_section -->

	</div>
	<!-- .comment_container -->
	



</div>
<!-- .lightbox -->


