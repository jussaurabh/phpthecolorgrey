

$(document).ready(function () {

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



   //Add User
   //    $('form.user_signup_form').on('submit', function (e) {         
   //       e.preventDefault();

   //       let username = check_user_form.username.value;
   //       let email = check_user_form.email.value;

   //       $.post(
   //          "includes/signup_user.php",
   //          {
   //             username: username,
   //             email: email
   //          },
   //          function (err) {
   //             console.log(err);
   //          }
   //       );
   //    });



   //Check User
   $('#sgn_username, #sgn_email').on('keyup', function () {
      let sgn_username_val = $("#sgn_username").val();
      let sgn_email_val = $("#sgn_email").val();

      console.log("email : " + sgn_email_val);
      console.log("username : " + sgn_username_val);

      $.post(
         'includes/check_user.inc.php',
         {
            username: sgn_username_val,
            email: sgn_email_val
         },
         function (err) {
            $('#signup_error > small').text(err);
         }
      );
   });


   // Add Collection
   $('form.create_collection_form, form.create_coll_form').on('submit', function (e) {
      e.preventDefault();

      let collection_name = $(this).find(".inputbox > input[type=text]").val();
      let sel_qt_id = $('form.create_collection_form').find(".collection_dropdown_list").attr('data-selected-qtid');

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



   $('.collection_btn').click(function (e) {
      let top = e.pageY,
         left = e.pageX,
         quote_id = $(this).attr('data-qtid');

      $('.collection_dropdown').css({
         'top': top,
         'left': left
      }).fadeIn(1);

      $.post(
         "getPopupColl.php",
         { quote_id: quote_id },
         function (data) {
            $(".collection_dropdown_list").replaceWith(data);
         }
      );
   });


   $('body').on('click', '.collection_dropdown_list > li > label > input[type=checkbox]', function (e) {

      $(this).change(function () {
         alert("coll checkbx changed");
      });

      console.log($(this).prop('id'));
      console.log(e);

      $(this).unbind('click');

   });



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
   });


   $('.quoteBtns > span.cmnt_open_btn').click(function () {
      $('.lightbox').fadeIn();
      $('.comment_container').fadeIn();

      let cmnt_qt = $(this).attr('data-cmnt-qt'),
         cmnt_qtauthor = $(this).attr('data-cmnt-qtauthor'),
         cmnt_qtdatetime = $(this).attr('data-cmnt-qtdatetime'),
         cmnt_qtid = $(this).attr('data-cmnt-qtid');

      $(".cmnt_quote > p").text(cmnt_qt);

      $(".cmnt_author > span:nth-child(1) > small > a")
         .text("- " + cmnt_qtauthor)
         .prop('href', "profile.php?author=" + cmnt_qtauthor);

      $(".cmnt_author > span:nth-child(2) > small").text(cmnt_qtdatetime);

      $(".comment_form_block").attr('data-cmnting-qtid', cmnt_qtid);

      console.log("quote id: " + cmnt_qtid);

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
         }
      );
   });




   // Follow Section
   $("#follow").click(function () {

      let uid = $(this).parent('.follow_btn_wrapper').attr('data-follow-to-id');

      $.post(
         'follow.php',
         { follow_uid: uid },
         function (res) {
            console.log(res);
            let data = JSON.parse(res);
            $("#follower_count").text("Followers " + data['followers']);
            $("#following_count").text("Following " + data['following']);

            $.post(
               'getFollowData.php?fun=followBtn',
               { followuid: uid },
               function (btn) {
                  $("#follow").replaceWith(btn);
               }
            );
         }
      );



   });



   // Unfollow Section
   $("#unfollow").click(function () {

      let uid = $(this).parent('.follow_btn_wrapper').attr('data-follow-to-id');

      $.post(
         'classes/DeleteData.php',
         { unfollow_uid: uid },
         function (res) {
            console.log("unfollowed");
         }
      );

   });



   // Showing Followers and Following list
   $("#following_count").click(function () {
      $(".quote-block-container").hide();
      $(".follow-block-container").show();
      $(".follow_tab_following_btn").addClass("active_follow_tab_btn");
      $(".follow_tab_followers_btn").removeClass("active_follow_tab_btn");
      $("#following").show();
      $("#followers").hide();
   });

   $("#follower_count").click(function () {
      $(".quote-block-container").hide();
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
      $(tab_btn).toggleClass("active_follow_tab_btn");
      $(this).siblings().find('a').toggleClass("active_follow_tab_btn");
      $(tab_id).show();
      $(tab_id).siblings().hide();
   });

   $(".follow-block-close").click(function () {
      $(".quote-block-container").show();
      $(".follow-block-container").hide();
      $("#following, #followers").hide();
      $(".follow_tab_following_btn, .follow_tab_followers_btn").removeClass("active_follow_tab_btn");
   });



   // User Settings Area 
   $(".setting_list > li > a").click(function () {
      var selected = $(this).attr('href');
      $(selected).show();
      $(selected).siblings().hide();
   });



   $(".close_lightbox").click(function () {
      $('.lightbox').fadeOut();
      $('.comment_container').fadeOut();
   });


});