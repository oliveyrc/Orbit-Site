(function ($, window, Drupal, once) {

  'use strict';

  Drupal.behaviors.ScaffoldQuoteSlider = {
    attach: function (context, settings) {
      var video = document.getElementById("banner-video");

      $('.pt--quote-slider .field--name-field-oyster-pt-quote-slider-ite').each(function () {
        const slider_wrapper = $(this).parent();
        if ($('.field__item', this).length > 1) {
          const slider = $(this, context);
          const slider_dots = slider_wrapper.data('slider-dots');
          const slider_arrows = slider_wrapper.data('slider-arrows');
          $(once('slider', slider)).slick({
            autoplay: true,
            dots: (slider_dots === 1),
            autoplaySpeed: 5000,
            fade: false,
            arrows: (slider_arrows === 1),
            slidesToShow: 1,
            slidesToScroll: 1,
          });
        }
      });
    }
  };

})(jQuery, window, Drupal, once);
