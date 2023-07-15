<?php
    function consumeApi(){
        $url = 'https://api.ipbase.com/v1/json/';
        $response= file_get_contents($url);
        $data=json_decode($response, true);
        $ip=$data['ip'];
        $ciudad=$data['city'];
        $longitud=$data['longitude'];
        $latitud=$data['latitude'];

        $resultados = array(
            'ip' => $ip,
            'ciudad' => $ciudad,
            'longitud' => $longitud,
            'latitud' => $latitud
        );

        return $resultados;
    }


    function conectar($ip, $ciudad, $longitud, $latitud){
        $user="root";
        $passwd="A190600.s";
        $server="localhost";
        $db="consumoApi";
        $con=mysqli_connect($server,$user,$passwd, $db);
        if(!$con){
            die("Error al conectar: " .mysqli_connect_error());
        }
        // Consulta SQL
        $sql = "INSERT INTO logins (longitud, latitud, ciudad, ip) VALUES (?,?,?,?)";
        $sentence=mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($sentence, "ssss", $longitud, $latitud, $ciudad, $ip);
        mysqli_stmt_execute($sentence);

        if (mysqli_stmt_affected_rows($sentence) > 0) {
        } else {
            echo "Error al insertar el registro";
        }
        

        mysqli_stmt_close($sentence);
        mysqli_close($con);
    
}
function mostrarDatos(){
    $user="root";
    $passwd="A190600.s";
    $server="localhost";
    $db="consumoApi";
    $con=mysqli_connect($server,$user,$passwd, $db);
    if (mysqli_connect_errno()) {
        echo "Error en la conexión a MySQL: " . mysqli_connect_error();
        exit;
    }

    $consulta="SELECT * FROM logins";
    $resultado = mysqli_query($con, $consulta);
    if (!$resultado) {
        echo "Error en la consulta: " . mysqli_error($con);
        exit;
    }
    $datos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    mysqli_free_result($resultado);
    mysqli_close($con);
    return $datos;
}

//PAGINA PRINCIPAL

?>