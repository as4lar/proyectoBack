<?php
include("api.php");
// $con=conectar();
$resultados=consumeApi();
$ip=$resultados['ip'];
$ciudad=$resultados['ciudad'];
$longitud=$resultados['longitud'];
$latitud=$resultados['latitud'];
conectar($ip, $ciudad, $longitud, $latitud);
$datos=mostrarDatos();
include("mostrar.html")


?>