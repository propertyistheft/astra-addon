function pafeAddressAutocompleteInitMap() {
    var inputs = document.querySelectorAll('[data-pafe-form-builder-address-autocomplete]');

    inputs.forEach(function(el, index, array){
        var autocomplete = new google.maps.places.Autocomplete(el);
        var country = el.getAttribute('data-pafe-form-builder-address-autocomplete-country');
        var map_lat = el.getAttribute('data-pafe-form-builder-google-maps-lat');
        var map_lng = el.getAttribute('data-pafe-form-builder-google-maps-lng');
        var zoom = el.getAttribute('data-pafe-form-builder-google-maps-zoom');

        if(country == 'All') {
          autocomplete.setComponentRestrictions({'country': []});
        } else {
          autocomplete.setComponentRestrictions({'country': country});
        }

        var $mapSelector = el.closest('.elementor-element').querySelectorAll('[data-pafe-form-builder-address-autocomplete-map]');
        if($mapSelector.length>0) {
            var myLatLng = { lat: parseFloat(map_lat), lng: parseFloat(map_lng) };
            var map_zoom = parseInt(zoom);
            var map = new google.maps.Map($mapSelector[0], {
                center: myLatLng,
                // center: {lat: -33.8688, lng: 151.2195},
                zoom: map_zoom
            });

            var infowindow = new google.maps.InfoWindow();
            var infowindowContent = el.closest('.elementor-element').querySelectorAll('.infowindow-content')[0];
            infowindow.setContent(infowindowContent);
            var marker = new google.maps.Marker({
              map: map,
              anchorPoint: new google.maps.Point(0, -29)
            });

            autocomplete.addListener('place_changed', function() {
              infowindow.close();
              marker.setVisible(false);
              var place = autocomplete.getPlace();
              if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
              }

              // If the place has a geometry, then present it on a map.
              if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
              } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);  // Why 17? Because it looks good.
              }
              marker.setPosition(place.geometry.location);
              marker.setVisible(true);

              var address = '';
              if (place.address_components) {
                address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
              }

              infowindowContent.children['place-icon'].src = place.icon;
              infowindowContent.children['place-name'].textContent = place.name;
              infowindowContent.children['place-address'].textContent = address;
              infowindow.open(map, marker);
            });
        }

        autocomplete.addListener('place_changed', function() {
          var place = autocomplete.getPlace();
          el.setAttribute('data-pafe-form-builder-google-maps-lat', place.geometry.location.lat());
          el.setAttribute('data-pafe-form-builder-google-maps-lng', place.geometry.location.lng());
          el.setAttribute('data-pafe-form-builder-google-maps-formatted-address', place.formatted_address);
          el.setAttribute('data-pafe-form-builder-google-maps-zoom', '17');

          var $distanceCalculation = document.querySelectorAll('[data-pafe-form-builder-calculated-fields-distance-calculation]');

          $distanceCalculation.forEach(function(el, index, array){

            if (el.getAttribute('data-pafe-form-builder-calculated-fields-distance-calculation-from') !== null) {
              var origin = el.getAttribute('data-pafe-form-builder-calculated-fields-distance-calculation-from');
            } else {
              var $origin = document.getElementById( el.getAttribute('data-pafe-form-builder-calculated-fields-distance-calculation-from-field-shortcode').replace('[field id="', 'form-field-').replace('"]','') );
              var origin = $origin.getAttribute('data-pafe-form-builder-google-maps-formatted-address');
            }

            if (el.getAttribute('data-pafe-form-builder-calculated-fields-distance-calculation-to') !== null) {
              var destination = el.getAttribute('data-pafe-form-builder-calculated-fields-distance-calculation-to');
            } else {
              $destination = document.getElementById( el.getAttribute('data-pafe-form-builder-calculated-fields-distance-calculation-to-field-shortcode').replace('[field id="', 'form-field-').replace('"]','') );
              var destination = $destination.getAttribute('data-pafe-form-builder-google-maps-formatted-address');
            }

            if (origin != '' && destination != '') {
              var distanceUnit = el.getAttribute('data-pafe-form-builder-calculated-fields-distance-calculation-unit');
              calculateDistance(origin, destination, el.closest('.pafe-field-container').querySelector('.pafe-calculated-fields-form__value'), distanceUnit, el);
            }

          });
                 
          if (jQuery(el).attr('data-pafe-form-builder-address-autocomplete') != undefined) {
            jQuery(el).change();
          }

        });
    });
}

// calculate distance
function calculateDistance(origin, destination, $el, distanceUnit, $input) {

    if (origin != '' && destination != '') {
      var service = new google.maps.DistanceMatrixService();
      service.getDistanceMatrix(
          {
              origins: [origin],
              destinations: [destination],
              travelMode: google.maps.TravelMode.DRIVING,
              unitSystem: google.maps.UnitSystem.IMPERIAL, // miles and feet.
              // unitSystem: google.maps.UnitSystem.metric, // kilometers and meters.
              avoidHighways: false,
              avoidTolls: false
          }, function (response, status) {
            if (status != google.maps.DistanceMatrixStatus.OK) {
                // console.log(err);
            } else {
                var origin = response.originAddresses[0];
                var destination = response.destinationAddresses[0];
                if (response.rows[0].elements[0].status === "ZERO_RESULTS") {
                    // console.log("Better get on a plane. There are no roads between "  + origin + " and " + destination);
                } else {
                    var distance = response.rows[0].elements[0].distance;
                    var duration = response.rows[0].elements[0].duration;
                    // console.log(response.rows[0].elements[0].distance);
                    var distance_in_kilo = distance.value / 1000; // the kilom
                    var distance_in_mile = distance.value / 1609.34; // the mile
                    var duration_text = duration.text;
                    var duration_value = duration.value;

                    var event = new Event("change"); 

                    if (distanceUnit == 'km') {
                      $el.innerHTML = distance_in_kilo.toFixed(2);
                      $input.value = distance_in_kilo.toFixed(2);
                      jQuery($input).change();
                    } else {
                      $el.innerHTML = distance_in_mile.toFixed(2);
                      $input.value = distance_in_mile.toFixed(2);
                      jQuery($input).change();
                    }                    
                }
            }
        });
    }
}

// get distance results
function callback(response, status) {
    if (status != google.maps.DistanceMatrixStatus.OK) {
        console.log(err);
    } else {
        var origin = response.originAddresses[0];
        var destination = response.destinationAddresses[0];
        if (response.rows[0].elements[0].status === "ZERO_RESULTS") {
            console.log("Better get on a plane. There are no roads between "  + origin + " and " + destination);
        } else {
            var distance = response.rows[0].elements[0].distance;
            var duration = response.rows[0].elements[0].duration;
            console.log(response.rows[0].elements[0].distance);
            var distance_in_kilo = distance.value / 1000; // the kilom
            var distance_in_mile = distance.value / 1609.34; // the mile
            var duration_text = duration.text;
            var duration_value = duration.value;

            console.log(distance_in_mile.toFixed(2) + 'miles');
            return distance_in_kilo.toFixed(2);
            // $('#duration_text').text(duration_text);
            // $('#duration_value').text(duration_value);
            // $('#from').text(origin);
            // $('#to').text(destination);
        }
    }
}

jQuery(document).ready(function( $ ) {
  $( document ).on( 'elementor/popup/show' , function () {
		pafeAddressAutocompleteInitMap();
  } );
} );

