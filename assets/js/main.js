jQuery(function ($) {
  // Bottom To Top Scroll Script
  $(window).on("scroll", function () {
    var height = $(window).scrollTop();
    if (height > 100) {
      $("#jst-scroll-to-top").fadeIn();
    } else {
      $("#jst-scroll-to-top").fadeOut();
    }
  });

  $("#jst-scroll-to-top").on("click", function (event) {
    event.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
  });
});
