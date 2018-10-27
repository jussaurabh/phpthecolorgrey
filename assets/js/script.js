$(document).ready(function () {

   $('.tooltipped').tooltip();

   $('.userProfileImg, .userProfileDummyImg').click(function () {
      $('.profile-dropdown').toggleClass('open-dropdown');
      $('.notify-dropdown').toggleClass('open-dropdown', false);
   });

   $('.notifyIcon').click(function () {
      $('.notify-dropdown').toggleClass('open-dropdown');
      $('.profile-dropdown').toggleClass('open-dropdown', false);
   });

   $('main').click(function () {
      $('.notify-dropdown').toggleClass('open-dropdown', false);
      $('.profile-dropdown').toggleClass('open-dropdown', false);
   });

   $('.collection_btn').click(function () {
      alert('cliked collection');
   })

})