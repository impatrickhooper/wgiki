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

  /* Initializes Favorites icon in navigation to open Favorites dropdown */
  $('.favorites_toggle').dropdown();

  /**
   * Favorites height
   *
   * 1. Checks if the height of the Favorites extends past the bottom of the window
   * 2. If yes, sets max height to space below header, automatically handles overflow
   */
  if($('#favorites').height() > ($(window).height() - $('#masthead').height())) {
    $('#favorites').css({
      'max-height': $(window).height() - $('#masthead').height(),
      'overflow-y': 'auto'
    });
  }

  /* Initializes side navigation and toggle button */
  $('.side-nav_collapse').sideNav({
    menuWidth: 280
  });

/* Search
   ========================================================================== */

  /* Add class to indicate when this field is in focus or not */
  $('.search-field #s').focusin(function() {
    $(this).parents('label').addClass('has-focus');
  }).focusout(function() {
    $(this).parents('label').removeClass('has-focus');
  });


  /* When the search toggle is clicked on mobile, slide down the search form */
  $('.search_toggle').on('click', function(e) {

    /* Prevent default link action */
    e.preventDefault();

    /* Get element to activate */
    $activatedElement = $('#' + $(this).attr('data-activates'));

    /* Slide activated element into view */
    $activatedElement.slideDown();

    /* When the search form is opened, focus the input */
    $activatedElement.find('#s').focus().focusout(function() {

      /* If this is a small device, hide search when it goes out of focus */
      if (Modernizr.mq('(max-width: 40rem)')) {
        $activatedElement.slideUp();
      }
    });
  });

  /* Function to show/hide search form depending on device size */
  var showSearch = _.debounce(function() {

    /* Get search form as jQuery element */
    $searchForm = $('#search-form');

    /* If not a small device, show the form, otherwise hide it */
    if (Modernizr.mq('(min-width: 40.0625rem)')) {
      $searchForm.show();
    }
  }, 125);

  /* Run on load and window resize (only every 125ms) */
  showSearch();
  $(window).resize(showSearch);

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

  /* Run on load and window resize (only every 125ms) */
  sizeResourceButton();
  $(window).resize(sizeResourceButton);

/* Typeform
   ========================================================================== */

  /* Code provided by Typeform to intialize a Typeform slide-in */
  (function(){var qs,js,q,s,d=document,gi=d.getElementById,ce=d.createElement,gt=d.getElementsByTagName,id='typef_orm',b='https://s3-eu-west-1.amazonaws.com/share.typeform.com/';if(!gi.call(d,id)){js=ce.call(d,'script');js.id=id;js.src=b+'share.js';q=gt.call(d,'script')[0];q.parentNode.insertBefore(js,q)}id=id+'_';if(!gi.call(d,id)){qs=ce.call(d,'link');qs.rel='stylesheet';qs.id=id;qs.href=b+'share-button.css';s=gt.call(d,'head')[0];s.appendChild(qs,s)}})()

})(jQuery);

