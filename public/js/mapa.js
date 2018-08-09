var marker;
var markers = [];
function initAutocomplete() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -6.889582, lng: -38.544935},
    zoom: 18
  });
  var infoWindow = new google.maps.InfoWindow({map: map});

  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      infoWindow.setPosition(pos);
      infoWindow.setContent('Estou aqui!');
      map.setCenter(pos);
    }, function() {
      handleLocationError(true, infoWindow, map.getCenter());
    });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }

  // Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });

    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      //Obter lat long do marcador
      marker = new google.maps.Marker({
          map: map,
          title: place.name,
          draggable: true,
          position: place.geometry.location
      });
      lat = marker.getPosition().lat();
      long = marker.getPosition().lng();
      
      document.getElementById('lat').value = lat;
      document.getElementById('long').value = long;
      markers.push(marker);


      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });

    map.fitBounds(bounds);
  });

  //adiciona marcador ao clicar no mapa
  map.addListener('click', function(e){

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });

    markers = [];

      //Obter lat long do marcador
      marker = new google.maps.Marker({
          map: map,
          title: document.getElementById('pac-input').value,
          draggable: true,
          position: e.latLng
      });
      lat = marker.getPosition().lat();
      long = marker.getPosition().lng();

      document.getElementById('lat').value = lat;
      document.getElementById('long').value = long;
      markers.push(marker);
      console.log("marcador: antes " + marker.getPosition());

      marker.addListener('dragend', function(e) {

        var position =  marker.getPosition();
        marker.setPosition(position);

      });
    });


}
