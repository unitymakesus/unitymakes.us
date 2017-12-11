export default {
  init() {
    // JavaScript to be fired on all pages
  },
  finalize() {
    // Make dropdown menus keyboard accessible
    $('.nav').each(function () {
      var el = $(this);

      $('a', el).on('focus', function() {
        $(this).parents('li').addClass('hover');

        setTimeout(function () {
          if ($(':focus').closest('#sidenav').length > 0) {
            $('body').addClass('sidenav-active');
          }
        }, 200);
      }).on('focusout', function() {
        $(this).parents('li').removeClass('hover');

        setTimeout(function () {
          if ($(':focus').closest('#sidenav').length == 0) {
            $('body').removeClass('sidenav-active');
          }
        }, 200);
      });
    });

    // Show sidenav
    $('.menu-trigger').on('focus click', function(e) {
      e.preventDefault();
      $('body').addClass('sidenav-active');
    });

    // Hide sidenav
    $('.sidenav-overlay').on('click', function() {
      $('body').removeClass('sidenav-active');
    });
  },
};
