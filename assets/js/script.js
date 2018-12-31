
$(document).ready(function () {

	// User Like Action ------------------
	$("body").on("click", ".user_like_btn", function () {

		let $this = $(this).parent();

		let quote_id = $(this).parents(".quoteBtns").siblings().children(".collection_btn").attr("data-qtid");

		let author = $(this).parents(".quoteBtns").siblings().children(".cmnt_open_btn").attr("data-cmnt-uid");

		if ($(this).hasClass("favActive")) {

			$.post(
				'classes/DeleteData.php',
				{
					author: author,
					quote_id: quote_id
				},
				function (res) {
					$.post(
						'checkUserIsActive.php',
						{
							author: author,
							quote_id: quote_id
						},
						function (like) {
							$this.replaceWith(like);
							console.log(like);
						}
					);
				}
			);

		}
		else {

			$.post(
				'./includes/favorite_quote.php',
				{
					author: author,
					quote_id: quote_id
				},
				function (res) {
					if (res == false)
						window.location.replace('login.php');
					else {
						$.post(
							'checkUserIsActive.php',
							{
								author: author,
								quote_id: quote_id
							},
							function (like) {
								$this.replaceWith(like);
								console.log(like);
							}
						);
					}

				}
			);

		}


	});


	// Delete operation for quotes
	$("body").on("click", ".qtDeleteBtn", function (e) {
		e.preventDefault();
		let qtId = $(this).parent().attr("id"),
			$this = $(this).parents('.quoteBlock');

		$.post(
			'classes/DeleteData.php',
			{ qtId: qtId },
			function (res) {
				console.log(res);
				$this.remove();
				M.toast({ html: res });
			}
		);
	});



	$(".quote-block-container").jaliswall({
		item: '.quoteBlock',
		columnClass: '.wall-column'
	});


	// Quote Edit options
	$("body").on("focus", ".qtBlock-opts", function () {
		let target = $(this).attr("data-target");
		$("#" + target).fadeIn(1);
	});

	// $("body").on("blur", ".qtBlock-opts", function () {
	//    $(".quote-edit-opts").fadeOut(1);
	// });



	$('.chips-placeholder').chips({
		placeholder: 'Enter a tag',
		secondaryPlaceholder: '+Tag',
	});

	$('.userProfileImg, .userProfileDummyImg').click(function () {
		$('#profile_dropdown').toggleClass('open-dropdown');
		$('.notify-dropdown').toggleClass('open-dropdown', false);
	});

	$('.notifyIcon').click(function () {
		$('.notify-dropdown').toggleClass('open-dropdown');
		$('#profile_dropdown').toggleClass('open-dropdown', false);
	});

	$('main').click(function () {
		$('.notify-dropdown').toggleClass('open-dropdown', false);
		$('#profile_dropdown').toggleClass('open-dropdown', false);
	});


	$('#collection_cancel_btn, #collection_add_btn').click(function () {
		$('.collection_dropdown').fadeOut(1);
		$('.dropdown_create_btn').fadeIn(1);
		$('.create_collection_form > .inputbox').fadeOut(1);
		$('.dropdown_collection_btn > #collection_add_btn').fadeOut(1);
		$('.dropdown_list input[type=checkbox]').prop("checked", false);
		$(".collection_dropdown_list").empty();
	});

	$('.dropdown_create_btn').click(function () {
		$(this).fadeOut(1);
		$('.create_collection_form > .inputbox').fadeIn(1).children().focus().val("");
		$('.dropdown_collection_btn > #collection_add_btn').fadeIn(1);
	});

	$(".open_make_coll_box").click(function () {
		$(this).hide();
		$(".make_collection_box").show();
	});
	$("#make_coll_cancel_btn, #make_coll_add_btn").click(function () {
		$(".make_collection_box").hide();
		$('.open_make_coll_box').show();
	});




	//Check User
	$('#sgn_username').on('keyup', function () {
		let sgn_username_val = $(this).val();

		if (sgn_username_val == "") {
			$("#username_value_err > small").text("");
		}
		else {

			$.post(
				'classes/CheckValue.php',
				{ sgn_username: sgn_username_val },
				function (res) {
					let err = JSON.parse(res);

					$("#username_value_err > small").text(
						(err['username_chk'] == 0) ? "Available" : "Username already exists!!"
					);
				}
			);

		}

	});

	$('#sgn_email').on('keyup', function () {
		let sgn_email_val = $(this).val();

		if (sgn_email_val == "") {
			$("#email_value_err > small").text("");
		}
		else {

			$.post(
				'classes/CheckValue.php',
				{ sgn_email: sgn_email_val },
				function (res) {
					let err = JSON.parse(res);

					$("#email_value_err > small").text(
						(err['email_chk'] == 0) ? "Available" : "Email already exists!!"
					);
				}
			);

		}

	});



	// Quote Submit Form
	$(".quote_submit_form").on('submit', function (e) {
		e.preventDefault();


		let quote = $(this).find(".inputbox > textarea").val(),
			quote_tag = "",
			random_columns = $(".quote-block-container").children().length,
			$quoteTxt = $(this).find(".inputbox > textarea");

		random_columns = 1 + Math.floor(Math.random() * random_columns);

		if ($(".chips").children(".chip").length > 0) {

			$('.chip').each(function () {
				let tag = $(this).text();
				quote_tag += tag.substring(0, tag.length - 5) + ', ';
			});

			quote_tag = quote_tag.substring(0, quote_tag.length - 2);

		}

		$.post(
			'includes/add_quote.inc.php',
			{
				quote: quote,
				quote_tag: quote_tag
			},
			function (res) {
				if (res == "false") {
					M.toast({ html: "Please enter a quote." });
					$(".inputbox > textarea").focus();
				}
				else {
					M.toast({ html: "Quote inserted" });

					$quoteTxt.val("");
					$(".chips").children(".chip").remove();

					$.post(
						'getQuoteBlock.php',
						{ getquote: res },
						function (quoteblock) {
							$(".wall-column:nth-child(" + random_columns + ")").prepend(quoteblock);
						}
					);
				}
			}
		);

	});




	// Add Collection
	$('form.create_collection_form, form.create_coll_form').on('submit', function (e) {
		e.preventDefault();

		let collection_name = $(this).find(".inputbox > input[type=text]").val();
		let sel_qt_id = $('form.create_collection_form').attr('data-selected-qtid');

		console.log("coll Nmae : " + collection_name + " selected qt id : " + sel_qt_id);

		$.post(
			"includes/add_collections.inc.php",
			{
				collection_name: collection_name,
				sel_qt_id: sel_qt_id
			},
			function (res) {
				if (res) {
					M.toast({ html: res });
					console.log(res);
					$.get(
						"getPopupColl.php",
						function (data) {
							$(".collection_dropdown_list").replaceWith(data);
						}
					);
					$.get(
						"getCollection.php",
						function (data) {
							$(".user_profile_collection_list").replaceWith(data);
						}
					);
				}
				else
					window.location.replace('login.php');
			}
		);

		$(this).find("input[type=text]").val("");
	});



	$('body').on('click', '.collection_btn', function (e) {
		let top = e.pageY,
			left = e.pageX,
			quote_id = $(this).attr('data-qtid');

		$(".create_collection_form").attr("data-selected-qtid", quote_id);

		$('.collection_dropdown').css({
			'top': top,
			'left': left
		}).fadeIn(1);

		$.post(
			"getPopupColl.php",
			{ quote_id: quote_id },
			function (data) {
				$(".collection_dropdown_list").replaceWith(data);
				$(".collection_dropdown_list").attr("data-selected-qtid", quote_id);
			}
		);
	});


	// $('body').on('click', '.collection_dropdown_list > li > label > input[type=checkbox]', function (e) {

	// 	$(this).change(function () {
	// 		alert("coll checkbx changed");
	// 	});

	// 	console.log($(this).prop('id'));
	// 	console.log(e);

	// 	$(this).unbind('click');

	// });



	// Deleting Collection
	$('body').on('click', '.delete_coll_btn', function () {
		let coll_name = $(this).attr('data-delete-collection');

		if (confirm("The quotes inside " + coll_name + " collections will be deleted too ")) {

			$.post(
				"classes/DeleteData.php",
				{ coll_name: coll_name },
				function (res) {
					$.get(
						"getCollection.php",
						function (data) {
							$(".user_profile_collection_list").replaceWith(data);
						}
					);
					M.toast({ html: res });
				}
			);

		}
	});




	$('.search_btn').click(function () {
		$('.search_container').addClass('open_searchbox').fadeIn();
		$('.search_inputbox > form > input[type=text]').focus();
	});
	$('.close_searchbox').click(function () {
		$('.search_container').toggleClass('open_searchbox', false).fadeOut();
		$('.search_inputbox > form > input[type=text]').blur();
		$('.search_inputbox > form > input[type=text]').val('');
		$('.search_opt_box').removeClass('displayblock');
	});

	$("#searchinputbox").on("keyup", () => {
		var search_data = $(this).val();

		$('.search_opt_box').addClass('displayblock');

		$.post(
			'getSearchOptions.php',
			{ search_data: search_data },
			(res) => {
				$("#search_opt_box").replaceWith(res);
			}
		);
	});



	$('body').on('click', 'span.cmnt_open_btn', function () {
		$('.lightbox').fadeIn();
		$('.comment_container').fadeIn();

		let cmnt_qt = $(this).attr('data-cmnt-qt'),
			cmnt_qtauthor = $(this).attr('data-cmnt-qtauthor'),
			cmnt_qtdatetime = $(this).attr('data-cmnt-qtdatetime'),
			cmnt_qtid = $(this).attr('data-cmnt-qtid'),
			cmnt_uid = $(this).attr('data-cmnt-uid');

		$(".cmnt_quote > p").text(cmnt_qt);

		$(".cmnt_author > span:nth-child(1) > small > a")
			.text("- " + cmnt_qtauthor)
			.prop('href', "profile.php?author=" + cmnt_qtauthor + "&i=" + cmnt_uid);

		$(".cmnt_author > span:nth-child(2) > small").text(cmnt_qtdatetime);

		$(".comment_form_block").attr('data-cmnting-qtid', cmnt_qtid);

		$.post(
			"getComment.php",
			{ comment_qtid: cmnt_qtid },
			function (res) {
				$(".user_comment_section").replaceWith(res);
			}
		);



	});


	// Insert Comment
	$(".comment_form_block").on('submit', function (e) {
		e.preventDefault();

		let comment = $(this).find("input[type=text]").val(),
			comment_qtid = $(this).attr('data-cmnting-qtid');

		console.log("user comment is : " + comment);
		console.log("quote id is : " + comment_qtid);

		$.post(
			"includes/add_comment.inc.php",
			{
				comment: comment,
				comment_qtid: comment_qtid
			},
			function (res) {
				console.log(res);

				$(".comment_form_block > .inputbox > input[type=text]").val("");
				let cmnt_qtid = $(".comment_form_block").attr('data-cmnting-qtid');

				$.post(
					"getComment.php",
					{ comment_qtid: cmnt_qtid },
					function (res) {
						$(".user_comment_section").replaceWith(res);
					}
				);

				$.post(
					"getCommentCount.php",
					{ comment_qtid: comment_qtid },
					function (res) {
						$(".commentCount").replaceWith(res);
					}
				);
			}
		);
	});




	// Follow Section
	$("body").on('click', '.follow_btn', function () {
		let followBtn = $(this);
		let uid = $(this).parent('.follow_btn_wrapper').attr('data-follow-to-id');

		$.post(
			'follow.php',
			{ follow_uid: uid },
			function (res) {
				console.log(res);
				let data = JSON.parse(res);
				$("#follower_count").text("Followers " + data['followers']);
				$("#following_count").text("Following " + data['following']);

				$(".follow_tab_followers_btn").text("Followers " + data['followers']);
				$(".follow_tab_following_btn").text("Following " + data['following']);

				$.post(
					'getFollowData.php?fun=followBtn',
					{ followuid: uid },
					function (btn) {
						$(followBtn).replaceWith(btn);
					}
				);
			}
		);



	});



	// Unfollow Section
	$("body").on('click', '.following_btn', function () {
		let unfollowBtn = $(this);

		let uid = $(this).parent('.follow_btn_wrapper').attr('data-follow-to-id');

		$.post(
			'classes/DeleteData.php',
			{ unfollow_uid: uid },
			function (res) {

				$.post(
					'getFollowData.php?fun=followCount',
					{ followuid: uid },
					function (data) {
						let count = JSON.parse(data);
						$("#follower_count").text("Followers " + count['followers']);
						$("#following_count").text("Following " + count['following']);

						$(".follow_tab_followers_btn").text("Followers " + count['followers']);
						$(".follow_tab_following_btn").text("Following " + count['following']);
					}
				);

				$.post(
					'getFollowData.php?fun=followBtn',
					{ followuid: uid },
					function (btn) {
						$(unfollowBtn).replaceWith(btn);
					}
				);

				$.post(
					'getFollowData.php?fun=followMembers',
					{ followuid: uid },
					function (res) {
						$("#follow_data_section > #followers").replaceWith(res);
					}
				);
			}
		);

	});



	// Showing User Liked Quotes
	$("#user_qt_like_count").click(function () {
		$(".quote-block-container").hide();
		$(".quote_form_block").hide();

		$(".follow-block-container").hide();

		$(".liked-quote-container").show();
	});



	// Showing Followers and Following list
	$("#following_count").click(function () {
		$(".quote-block-container").hide();
		$(".quote_form_block").hide();

		$(".liked-quote-container").hide();

		$(".follow-block-container").show();
		$(".follow_tab_following_btn").addClass("active_follow_tab_btn");
		$(".follow_tab_followers_btn").removeClass("active_follow_tab_btn");
		$("#following").show();
		$("#followers").hide();
	});

	$("body").on("click", "#follower_count", function () {

		let followuid = $(this).attr("data-target-uid");

		$.post(
			'getFollowData.php?fun=followMembers',
			{ followuid: followuid },
			function (res) {
				$("#follow_data_section > #followers").replaceWith(res);
			}
		);

		$(".quote-block-container").hide();
		$(".quote_form_block").hide();
		$(".follow-block-container").show();
		$(".follow_tab_followers_btn").addClass("active_follow_tab_btn");
		$(".follow_tab_following_btn").removeClass("active_follow_tab_btn");
		$("#followers").show();
		$("#following").hide();
	});

	$(".follow_tab > li").click(function (e) {
		e.preventDefault();
		var tab_id = $(this).find('a').attr("href");
		var tab_btn = $(this).find('a');
		$(tab_btn).addClass("active_follow_tab_btn");
		$(this).siblings().find('a').removeClass("active_follow_tab_btn");
		$(tab_id).show();
		$(tab_id).siblings().hide();
	});

	$(".block-close").click(function () {
		$(".quote-block-container").show();
		$(".quote_form_block").show();

		$(".follow-block-container").hide();
		$("#following, #followers").hide();
		$(".follow_tab_following_btn, .follow_tab_followers_btn").removeClass("active_follow_tab_btn");

		$(".liked-quote-container").hide();
	});



	// User Settings Area ------------------
	$(".setting_list > li > a").click(function () {
		var selected = $(this).attr('href');
		$(selected).addClass("active");
		$(selected).siblings().removeClass("active");
	});



	$(".close_lightbox").click(function () {
		$('.lightbox').fadeOut();
		$('.comment_container').fadeOut();
	});


	$(".qtcategories-trigger, .selected-qtcategory-txt").focus(function () {
		$(".qtcategories-trigger").hide();
		$(".qtcategories-opt-block").show();
		$(".selected-qtcategory-txt").show().focus();
	});

	$(".selected-qtcategory-txt").blur(function () {
		if ($(this).val() == "") {
			$(".qtcategories-opt-block").hide();
			$(".selected-qtcategory-txt").hide().val("").attr("placeholder", "Choose a category");
			$(".qtcategories-trigger").show().children("span").text("Choose a category");
		}
	});

	$("body").on("mouseover", ".qtcategory-item", function () {
		$(".selected-qtcategory-txt").val($(this).text());
	});

	$("body").on("click", ".qtcategory-item", function () {
		var qtcat_item = $(this).attr("data-qtcat_item");
		console.log(qtcat_item);
		$(".qtcategories-trigger")
			.attr("data-selected-qtcont", qtcat_item)
			.show()
			.children("span")
			.text(qtcat_item);
		$(".qtcategories-opt-block").hide();
		$(".selected-qtcategory-txt").hide().val("").attr("placeholder", "Choose a category");
	});





});