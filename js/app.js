/* ==========================================================================
   WGIki JavaScript / jQuery
   ========================================================================== */
(function($) {

/* Global
   ========================================================================== */

  /* Adds webkit class if this is a webkit browser, no-webkit otherwise */
  ($.browser.webkit) ? $('html').addClass('webkit') : $('html').addClass('no-webkit');
  /* Add Modernizr test for IE10 flexbox syntax */
  Modernizr.addTest('flexboxtweener', Modernizr.testAllProps('flexAlign', 'end', true));

/* Navigation
   ========================================================================== */

  /* Initializes side navigation and toggle button */
  $('.side-nav_collapse').sideNav({
    menuWidth: 280
  });

/* Search
   ========================================================================== */

  /* Add class to indicate when this field is in focus or not */
  $('.search-field #s').focusin(function() {
    $(this).parent().addClass('has-focus');
  }).focusout(function() {
    $(this).parent().removeClass('has-focus');
  });


  /* When the search toggle is clicked on mobile, slide down the search form */
  $('.search_toggle').on('click', function() {
    $activatedElement = $('#' + $(this).attr('data-activates'));
    $activatedElement.slideDown(300);

    /* When the search form is opened, focus the input */
    $activatedElement.find('#s').focus();
  });

  /* When the close icon is clicked on the search field, slide up the search */
  $('#search-form .search-field_close-icon').on('click', function() {
    $(this).parents('#search-form').slideUp(300);
  });

/* Taxonomy Pages
   ========================================================================== */

  /* Debounced function to center buttons in the middle of a resource card */
  var sizeResourceButton = _.debounce(function() {

    /* Run only on medium and large screens */
    if (Modernizr.mq('(min-width: 40.0625rem)')) {

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
  }, 125);

  /* Run on load and window resize (only every 300ms) */
  sizeResourceButton();
  $(window).resize(sizeResourceButton);

})(jQuery);

