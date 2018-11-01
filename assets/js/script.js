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
   });

   $('.dropdown_create_btn').click(function () {
      $(this).fadeOut(1);
      $('.create_collection_form > .inputbox').fadeIn(1);
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
      $('.comment_container').toggleClass('open_cmnt_container');
   });
   $('.lightbox').click(function () {
      $(this).fadeOut();
      $('.comment_container').toggleClass('open_cmnt_container');
   })

})