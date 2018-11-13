

$(document).ready(function () {

   $('.userProfileImg, .userProfileDummyImg').click(function () {
      $('#profile_dropdown').toggleClass('open-dropdown');
      $('.notify-dropdown').toggleClass('open-dropdown', false);
      // $(this).doo();
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
   });

   $('.dropdown_create_btn').click(function () {
      $(this).fadeOut(1);
      $('.create_collection_form > .inputbox').fadeIn(1).children().focus().val('');
      $('.dropdown_collection_btn > #collection_add_btn').fadeIn(1);
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



   $('.collection_btn').click(function (e) {
      let top = e.pageY;
      let left = e.pageX;
      $('.collection_dropdown').css({
         'top': top,
         'left': left
      }).fadeIn(1);

      let quote_id = $(this).attr('data-qtid');

      // Getting the user collection from database without refreshing page
      $.post(
         "getPopupColl.php",
         { quote_id: quote_id },
         function (data) {
            $(".collection_dropdown_list").replaceWith(data);
         }
      );
   });



   // Add Collection
   $('form.create_collection_form, form.create_coll_form').on('submit', function (e) {
      e.preventDefault();

      let collection_name = $(this).find(".inputbox > input[type=text]").val();
      let sel_qt_id = $('form.create_collection_form').find(".collection_dropdown_list").attr('data-selected-qtid');

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

      // $.post(
      //    "includes/add_quote_to_collection.inc.php",
      //    // {selected_quote: }
      // );
   });



   // Deleting Collection
   $('.delete_coll_btn').click(function () {
      let coll_name = $(this).attr('data-delete-collection');
      $('#delete_collection').attr('data-delete-collection-name', coll_name);
   });

   $('#delete_collection').click(function () {
      let coll_name = $(this).attr('data-delete-collection-name');

      // coll_name = "coll_name=" + coll_name;

      $.post(
         "includes/deleteData.inc.php",
         { coll_name: coll_name },
         function (res) {
            // M.toast({ html: res });
            console.log(res);
         }
      );
   });



   // Submiting Comment Section
   // $(".comment_form_block").on('submit', function (e) {
   //    e.preventDefault();

   //    let comment = cmnt_form.comment.value;

   //    // $.post(
   //    //    './'
   //    // );
   // });






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
   });

   $('.delete_coll_btn').click(function () {
      $('.lightbox').fadeIn();
      $('.confirmation_box').fadeIn();
   });
   $('.close_lightbox').click(function () {
      $('.lightbox').fadeOut();
      $('.lightbox > *').fadeOut();
   });
   // $('.lightbox').click(function () {
   //    $(this).fadeOut();
   //    $('.comment_container').removeClass('open_cmnt_container');
   // })



});