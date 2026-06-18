

(function ($, window, Drupal, once) {

  'use strict';

  Drupal.behaviors.ScaffoldSearch = {
    attach: function (context, settings) {
      $('button#oyster-search, .search-close, #search-block-form .close').on('click', function () {
        var bool;
        bool = jQuery(".search-header-wrapper .search-block-form").is(":hidden");
        jQuery(".search-header-wrapper .search-block-form").toggleClass('hidden');
        jQuery(".search-header-wrapper .search-block-form").attr('hidden', !bool);

        jQuery("#edit-keys--2").focus();
        //jQuery("span.search-icon", this).toggleClass('hidden');
        //jQuery("span.close-icon", this).toggleClass('hidden');

      });

      jQuery('.search-close').on('click', function (e) {
        e.preventDefault();
        //   jQuery("#block-scaffold-searchbutton span.search-icon").removeClass('hidden');
        //  jQuery("#block-scaffold-searchbutton span.close-icon").addClass('hidden');

      });


      jQuery(document).on('keyup', function (evt) {
        if (evt.keyCode == 27) {
          // jQuery("#block-scaffold-searchbutton span.search-icon").removeClass('hidden');
          // jQuery("#block-scaffold-searchbutton span.close-icon").addClass('hidden');
          jQuery(".search-header-wrapper .search-block-form").attr('hidden', true);
          jQuery(".search-header-wrapper .search-block-form").toggleClass('hidden');
        }
      });

    }
  };



})(jQuery, window, Drupal, once);
