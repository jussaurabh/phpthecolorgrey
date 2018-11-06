(function ($) {
   $.fn.foo = function () {
      alert("foo funciotn");
   }

   $.fn.doo = function () {
      alert("doo function");
   }
})(jQuery);



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

   $('.collection_btn').click(function (e) {
      let top = e.pageY;
      let left = e.pageX;
      $('.collection_dropdown').css({
         'top': top,
         'left': left
      }).fadeIn(1);
      // $('.dropdown_create_btn').fadeIn();
   });

   $('#collection_cancel_btn').click(function () {
      $('.collection_dropdown').fadeOut(1);
      $('.dropdown_create_btn').fadeIn(1);
      $('.create_collection_form > .inputbox').fadeOut(1);
      $('.dropdown_collection_btn > #collection_add_btn').fadeOut(1);
      $('.dropdown_list input[type=checkbox]').prop("checked", false);
   });

   $('.dropdown_create_btn').click(function () {
      $(this).fadeOut(1);
      $('.create_collection_form > .inputbox').fadeIn(1).children().focus();
      $('.dropdown_collection_btn > #collection_add_btn').fadeIn(1);
   });



   // Add Collection
   $('form.create_collection_form').on('submit', function (e) {
      e.preventDefault();

      var collection_name = $('#coll_name').val();

      $.post(
         "includes/add_collections.inc.php",
         { collection_name: collection_name },
         function (res) {
            M.toast({ html: res });
         }
      );

      // $.ajax({
      //    type: "POST",
      //    data: { collection_name: collection_name },
      //    url: "includes/add_collections.inc.php",
      //    success: function (response) {
      //       M.toast({ html: "Quote is added to " + response });
      //    },
      //    error: function (err) {
      //       console.log(err);
      //       M.toast({
      //          html: err,
      //          classes: 'coll_err'
      //       });
      //    }
      // });
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

})