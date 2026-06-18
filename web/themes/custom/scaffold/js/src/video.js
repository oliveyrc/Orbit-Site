(function ($, window, Drupal, once) {

  'use strict';

  Drupal.behaviors.ScaffoldPlyrVideo = {
    attach: function (context, settings) {
      const players = Plyr.setup('.field--name-field-media-video-file video', {
        controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'captions', 'fullscreen']
      });
    }
  };

})(jQuery, window, Drupal, once);
