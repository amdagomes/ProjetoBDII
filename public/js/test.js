function carregarPontos() {

       $.getJSON('eventos.json', function (pontos) {

           var latlngbounds = new google.maps.LatLngBounds();

           $.each(pontos, function (index, ponto) {

               var marker = new google.maps.Marker({
                    google.maps.LatLng(ponto.Latitude, ponto.Longitude),
                   title: ponto.Descricao,
                   icon: icon
               });

               var myOptions = {
                   content: "<p>" + ponto.Descricao + "</p>",
                   pixelOffset: new google.maps.Size(-150, 0)
               };

               infoBox[ponto.Id] = new InfoBox(myOptions);
               infoBox[ponto.Id].marker = marker;

               infoBox[ponto.Id].listener = google.maps.event.addListener(marker, 'click', function (e) {
                   abrirInfoBox(ponto.Id, marker);
               });

               markers.push(marker);

               latlngbounds.extend(marker.position);

           });

           var markerCluster = new MarkerClusterer(map, markers);

           map.fitBounds(latlngbounds);

       });

   }

   carregarPontos();
