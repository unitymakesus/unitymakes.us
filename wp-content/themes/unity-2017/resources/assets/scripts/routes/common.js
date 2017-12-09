export default {
  init() {
    // JavaScript to be fired on all pages
  },
  finalize() {
    // Make dropdown menus keyboard accessible
    $(".nav").each(function () {
      var el = $(this);

      $("a", el).focus(function() {
        $(this).parents("li").addClass("hover");
      }).blur(function() {
        $(this).parents("li").removeClass("hover");
      });
    });
  },
};
