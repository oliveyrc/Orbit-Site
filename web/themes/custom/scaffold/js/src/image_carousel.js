(function ($, window, Drupal, once) {

  'use strict';

  Drupal.behaviors.ScaffoldImageCarousel = {
    attach: function (context, settings) {
      if ($.isFunction($.fn.slick)) {
        $('.pt--image-carousel .field--name-field-oyster-pt-image-carousel-i').each(function () {
          if ($('.field__item', this).length > 1) {
            const slider = $(this, context);
            $(once('slider', slider)).slick({
              autoplay: true,
              dots: true,
              autoplaySpeed: 5000,
              fade: false,
              arrows: true,
              slidesToShow: 1,
              slidesToScroll: 1,
            });
          }
        });
      }
    }
  };

})(jQuery, window, Drupal, once);
