

<!-- Collection Dropdown Section -->
<div class="dropdown collection_dropdown">
	<div class="dropdown_create_btn valign-wrapper">
		<span class="center-align valign-wrapper"><i class="material-icons">playlist_add</i></span>
		<span style="padding-left: 0.5em;">Create Collection</span>
	</div>
	<form action="includes/add_collections.inc.php" method="post" class="create_collection_form">
		<div class="inputbox">
			<input type="text" name="collection_name" placeholder="Create Collection" id="coll_name">
		</div>

		<ul class="dropdown_list">
			<li>
				<label for="happy">
					<input type="checkbox" name="happy" id="happy">
					<span>Happy</span>
				</label>
			</li>
			<li>
				<label for="some">
					<input type="checkbox" name="some" id="some">
					<span>some</span>
				</label>
			</li>
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
			<p class="no-margin">The quote which are inside this collection will bealso deleted.</p>
		</div>
		<div class="confirmation_btns">
			<button class="close_lightbox">Cancel</button>
			<button>Delete</button>
		</div>
	</div>
	<!-- .confirmation_box -->



	<!-- Comment Container Section -->
	<div class="comment_container">

		<button class="close_lightbox valign-wrapper">
			<i class="material-icons tiny center-align">close</i>
		</button>

		<!-- <div class="cmnt_close valign-wrapper">
			<span class="valign-wrapper center-align">
				<i class="material-icons center-align tiny">clear</i>
			</span>
		</div> -->

		<div class="cmnt_on">
			<div class="cmnt_quote">
				<p>You can't process me with normal brain</p>
			</div>
			<div class="cmnt_author valign-wrapper">
				<span><small>- rohan</small></span>
				<span><small>12 days ago</small></span>
			</div>

			<hr class="lightgrey-hr">
		</div>
		<!-- .cmnt_on -->

		<div class="cmnt_form">
			<form class="form_block">
				<div class="inputbox">
					<input type="text" placeholder="comment">
				</div>
				<div class="inputbtn">
					<button type="submit" class="valign-wrapper">
						<i class="material-icons tiny centr-align">send</i>
					</button>
				</div>
			</form>
		</div>
		<!-- ./cmnt_form -->

	</div>
	<!-- .comment_container -->



</div>
<!-- .lightbox -->


