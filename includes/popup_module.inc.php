

<!-- Collection Dropdown Section -->
<div class="dropdown collection_dropdown"> 
	<div class="dropdown_create_btn valign-wrapper">
		<span class="center-align valign-wrapper"><i class="material-icons">playlist_add</i></span>
		<span style="padding-left: 0.5em;">Create Collection</span>
	</div>
	<form action="" method="post" 
		class="create_collection_form" 
		id="dropdown_coll_form">

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

		<?php if (isset($_SESSION['uid'])): ?>

		<div class="cmnt_form">
			<form action="" method="post" name="cmnt_form" class="comment_form_block">
				<div class="inputbox">
					<input type="text" name="comment" placeholder="comment">
				</div>
				<div class="inputbtn">
					<button type="submit" class="valign-wrapper" id="submit_cmnt_btn">
						<i class="material-icons tiny centr-align">send</i>
					</button>
				</div>
			</form>
		</div>
		<!-- ./cmnt_form -->

		<?php endif; ?>

		<div class="user_comment_section">

		</div>
		<!-- .user_comment_section -->

	</div>
	<!-- .comment_container -->
	



</div>
<!-- .lightbox -->


