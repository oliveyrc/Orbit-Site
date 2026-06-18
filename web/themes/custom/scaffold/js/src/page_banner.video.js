(function ($, window, Drupal, once) {

  'use strict';

  Drupal.behaviors.ScaffoldBannerVideo = {
    attach: function (context, settings) {
      var video = document.getElementById("banner-video");

      $('.block-page-banner .controls button').on('click', function (e) {
        if (video.paused) {
          video.play();
          $(this).attr("aria-pressed","false");
        }
        else {
          video.pause();
          $(this).attr("aria-pressed","true");
        }
      });
    }
  };

})(jQuery, window, Drupal, once);
