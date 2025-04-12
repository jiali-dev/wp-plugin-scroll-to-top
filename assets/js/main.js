jQuery(function ($) {
  // Bottom To Top Scroll Script
  $(window).on("scroll", function () {
    var height = $(window).scrollTop();
    if (height > 100) {
      $("#jialistt-scroll-to-top").fadeIn();
    } else {
      $("#jialistt-scroll-to-top").fadeOut();
    }
  });

  $("#jialistt-scroll-to-top").on("click", function (event) {
    event.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
  });
});
