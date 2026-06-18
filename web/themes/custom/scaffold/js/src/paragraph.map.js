(function ($, window, Drupal) {
  'use strict';

  var map, loc, iconBase, marker;
  var markers = [];
  var infobox;
  $(window).on('load', function () {
    load_paragraph_map();
  });

  function load_paragraph_map() {
    if ($('#map').length > 0) {
      var map, loc, loc1, iconBase, marker;
      var markers = {};
      var infobox;
      var search_areas = [];
      var bounds = new google.maps.LatLngBounds();


      var details;
      details = drupalSettings.paragraph_google_map[0];

      loc = new google.maps.LatLng(details['lat'], details['lng']);
      iconBase = '/themes/custom/scaffold/images/';
      map = new google.maps.Map(document.getElementById("map"), {
        zoom: 16,
        center: loc,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false,
        zoomControl: true,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        rotateControl: false,
        fullscreenControl: false,
        styles: [
          {
            "featureType": "poi.attraction",
            "elementType": "labels",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi.business",
            "elementType": "labels",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi.government",
            "elementType": "labels",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi.medical",
            "elementType": "labels",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi.park",
            "elementType": "labels",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi.place_of_worship",
            "elementType": "labels",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi.school",
            "elementType": "labels",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi.sports_complex",
            "elementType": "labels",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          }
        ]
      });

      //infobox
      infobox = new InfoBox({
        content: '<div id="infobox"></div>',
        disableAutoPan: false,
        maxWidth: 420,
        pixelOffset: new google.maps.Size(-45, -93),
        zIndex: null,
        enableEventPropagation: true,
        alignBottom: true,
        boxStyle: {
          opacity: 1,
          width: "300px"
        },
        closeBoxMargin: "0 0 0 0 ",
        closeBoxURL: "/themes/custom/scaffold/images/map-close.png",
        infoBoxClearance: new google.maps.Size(1, 1)
      });

      //loop through all the distributor markers
      var bounds3 = new google.maps.LatLngBounds();
      loc1 = new google.maps.LatLng(details['lat'], details['lng']);

      marker = new google.maps.Marker({
        map: map,
        position: loc1,
        visible: true,
        icon: iconBase + 'pin.png'
      });

      var content = '';

      // Left
      if (details.image !== null) {
        content += '<div class="image">' + details.image + '</div>';
      }

      // Right

      content += '<div class="text">'+details.text[0].value+'</div>';

      google.maps.event.addListener(marker, 'click', function () {
        var thecontent = '<div id="infobox"><div class="inner">'+content+'</div></div>';
        infobox.setContent(thecontent);
        infobox.open(map, this);
        map.panTo(loc1);
        map.panBy(0, -150);
      });

      // markers.push(marker);
      bounds3.extend(marker.getPosition());

      //fit map to markers
      map.setCenter(bounds3.getCenter());
      map.setZoom(map.getZoom() - 1);
    }
  }


})(jQuery, window, Drupal);
