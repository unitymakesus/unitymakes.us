export default {
  finalize() {
    // Scroll to top of form
    function scrollToForm(event) {
      const formID = event.detail.id,
            scrolled = $('.viewport').offset().top,
            formTop = $('#' + formID).offset().top;

      $( '.viewport' ).animate({
        scrollTop: ( scrolled - formTop - 50 ),
      }, 1000 );
    }
    // Handle form submission errors
    document.addEventListener( 'wpcf7invalid', function( event ) {
      scrollToForm(event);
    }, false );
    document.addEventListener( 'wpcf7spam', function( event ) {
      scrollToForm(event);
    }, false );
    document.addEventListener( 'wpcf7mailfailed', function( event ) {
      scrollToForm(event);
    }, false );

    // Handle form submission success
    document.addEventListener( 'wpcf7mailsent', function( event ) {
      const formID = event.detail.id;

      scrollToForm(event);
      $('#' + formID).find('fieldset, .wpcf7-submit').detach();
    }, false );
  },
};
