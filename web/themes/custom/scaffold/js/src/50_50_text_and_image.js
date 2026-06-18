(function ($, window, Drupal, once) {

  'use strict';

  Drupal.behaviors.ScaffoldVideo = {
    attach: function (context, settings) {
      if ($.isFunction($.fn.swipebox)) {
        const videoSwipebox = $('.swipe-video, .swipebox-video', context);
        $(once('videoSwipebox',videoSwipebox)).swipebox();
      }
    }
  };

})(jQuery, window, Drupal, once);
