<?php

$servidor ="localhost";
$usuario ="root";
$senha = "";
$db_name ="projetobdii";

$conn= mysqli_connect($servidor,$usuario,$senha);
$banco = mysqli_select_db($conn,$db_name);
mysqli_set_charset($conn,'utf8');

$resultado = mysqli_query($conn,"select * from events where periodo > NOW()") or die("Erro");

$eventos = array();
while($evento = mysqli_fetch_assoc($resultado))
{
  array_push($eventos,$evento);
}

echo "<script async defer src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAvUhehS52WPxo9Auyw_7dO7HHyLlqzmcU&libraries=places&callback=initMap'>
</script>
<script>
var valores = '";echo json_encode($eventos); echo"';
// transforma o json em objeto
var results = JSON.parse(valores);
// percorre o objeto evento

var map;
var infowindow;
var circle;
        function initMap() {
            var pyrmont = {lat: -6.888761, lng: -38.559558};
            map = new google.maps.Map(document.getElementById('map'), {
            center: pyrmont,
            zoom: 10
            });
            infowindow = new google.maps.InfoWindow();
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                  lat: position.coords.latitude,
                  lng: position.coords.longitude
                };
                infowindow.setPosition(pos);
                circle = new google.maps.Circle({
                  strokeColor: '#FF0000',
                  strokeOpacity: 0.8,
                  strokeWeight: 2,
                  fillColor: '#FF0000',
                  fillOpacity: 0.35,
                  map: map,
                  center: pos,
                  radius: 50000
                });

                service = new google.maps.places.PlacesService(map);

                service.nearbySearch({
                location: pos,
                radius: '5000'
                }, callback);
                callback(results, status);

                infowindow.setContent('Estou aqui.');
                infowindow.open(map);
                map.setCenter(pos);
              }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
              });
            } else {
              // Browser doesn't support Geolocation
              handleLocationError(false, infoWindow, map.getCenter());
            }


        }

        function callback(results, status) {

            for (var i = 0; i < results.length; i++) {
                createMarker(results[i]);
            }

        }

        function createMarker(place) {

            var marker = new google.maps.Marker({
            map: map,
            position: {lat: Number(place.lat), lng: Number(place.lng)}
            });

            google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent('<h4>' + place.titulo + '</h4><p>Tema: ' + place.tema + '<br>Data: ' + place.periodo + '<br>Local: ' + place.local + '</p>');
            infowindow.open(map, this);
            });
        }



</script>
";


/*$con = new mysqli($servidor,$usuario,$senha, $db_name);
if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());

    //Consultando banco de dados
    $qryLista = mysqli_query($con, "SELECT * FROM events");

    $array_da_consulta = mysqli_fetch_array($qryLista);

    while($resultado = mysqli_fetch_assoc($qryLista)){
        $vetor[] = array_map('utf8_decode', $resultado);
    }

    $json = json_encode($vetor);
    echo $json;
//Passando vetor em forma de json

$fp = fopen("eventos.json", "w");
fwrite($fp, json_encode($vetor));
fclose($fp);
*/
?>
