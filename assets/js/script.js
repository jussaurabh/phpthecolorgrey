

$(document).ready(function () {

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
   $('form.user_signup_form').on('submit', function (e) {
      e.preventDefault();

      let username = check_user_form.username.value;
      let email = check_user_form.email.value;
      let password = check_user_form.password.value;

      $.post(
         "includes/signup_user.php",
         {
            username: username,
            email: email,
            password: password
         },
         function (err) {
            console.log(err);
         }
      );
   });



   //Check User
   $('#sgn_username, #sgn_email').on('keyup', function () {
      let val = $(this).val();
      console.log("pressed " + val);
      $.post(
         'includes/check_user.inc.php',
         { username: check_user_form.username.value },
         function (err) {
            $('#check-username > small').html(err);
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
         cmnt_qtdatetime = $(this).attr('data-cmnt-qtdatetime');

      $(".cmnt_quote > p").text(cmnt_qt);
      $(".cmnt_author > span:nth-child(1) > small > a")
         .text("- " + cmnt_qtauthor)
         .prop('href', "profile.php?author=" + cmnt_qtauthor);
      $(".cmnt_author > span:nth-child(2) > small").text(cmnt_qtdatetime);


   });



   $(".close_lightbox").click(function () {
      $('.lightbox').fadeOut();
      $('.comment_container').fadeOut();
   });


});