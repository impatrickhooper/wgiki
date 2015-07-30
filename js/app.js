/* ==========================================================================
   WGIki JavaScript / jQuery
   ========================================================================== */
(function($) {

/* Global
   ========================================================================== */

  /* Adds webkit class if this is a webkit browser, no-webkit otherwise */
  ($.browser.webkit) ? $('html').addClass('webkit') : $('html').addClass('no-webkit');

/* Navigation
   ========================================================================== */

  /* Initializes side navigation and toggle button */
  $('.side-nav_collapse').sideNav({
    menuWidth: 280
  });

/* Taxonomy Pages
   ========================================================================== */

  /* Debounced function to center buttons in the middle of a resource card */
  var sizeResourceButton = _.debounce(function() {

    /* Run only on medium and large screens */
    if (!Modernizr.mq('max-width: 40rem')) {

      /* Get all action buttons and loop through each one */
      $('.card-resource .card_action').each(function() {

        /* Get half the height of the parent card */
        var halfParent = $(this).parent().outerHeight() / 2;

        /* Get half the height of the button */
        var halfSelf = $(this).outerHeight() /2 ;

        /* Move button to middle of card */
        $(this).css('top', halfParent - halfSelf);
      });
    }
  }, 300);

  /* Run on load and window resize (only every 300ms) */
  sizeResourceButton();
  $(window).resize(sizeResourceButton);

})(jQuery);

