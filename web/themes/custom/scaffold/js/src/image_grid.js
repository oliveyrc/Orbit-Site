(function ($, window, Drupal, once) {

  'use strict';

  Drupal.behaviors.ScaffoldImagegrid = {
    attach: function (context, settings) {
      const lightbox = GLightbox({ selector: '.glightbox'});
    }
  };

})(jQuery, window, Drupal, once);
