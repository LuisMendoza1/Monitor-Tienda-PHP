<?php

$url = $_POST["txtDir"]; // url del servidor de tiendas
$tienda = $_POST["txtTiendaa"]; // id de la tienda
//echo $url;

//Iniciamos la conexión con la bbdd
    $server="localhost";
	$db_username="root";
	$db_password='';
	$database="multi";
        $link = mysqli_connect("$server","$db_username","$db_password") or die ("Imposible conectar a mySQL database");
        $a= mysqli_select_db($link,"$database") or die("No se pudo conectar a la base de datos");
		
$conexion = mysql_connect("localhost","root","");
if(!$conexion)
{
	die ("No se ha podido encontrar porque: ".mysql_error());
}
mysql_select_db("multi",$conexion);

// Creamos un nuevo documento xml
$xmlDoc = new DOMDocument();
// Cargamos la plantilla del mensaje MT3
$xmlDoc->load("plantillaMT5.xml");

// Obtengo el nodo <emisor>
$emisor = $xmlDoc->getElementsByTagName("emisor");
// Modifico el valor del nodo <emisor>
$emisor->item(0)->nodeValue = "monitor";


// Obtengo el nodo <receptor>
$receptor = $xmlDoc->getElementsByTagName("receptor");
// Modifico el valor del nodo <emisor>
$receptor->item(0)->nodeValue = $tienda;


// Obtengo el nodo <time>
$time = $xmlDoc->getElementsByTagName("time");

// Obtenemos la ip local y la insertamos en el nodo <creador>
$localIP = getHostByName(php_uname('n'));
// Obtenemos el nodo <creador> hijo del nodo <time>
$creador = $xmlDoc->getElementsByTagName("creador");
$creador->item(0)->nodeValue = $localIP;

// Obtenemos el timestamp y lo insertamos en el nodo <timestamp>
$fecha = new DateTime();
$timestamp = $xmlDoc->getElementsByTagName("timestamp");
$timestamp->item(0)->nodeValue = $fecha->getTimestamp();
$time = $timestamp->item(0)->nodeValue;


    //Enviamos por POST
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml', 'Access-Control-Allow-Origin: *'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlDoc->saveXML());

	// Si hay errores manda mensaje de error
    if (curl_errno($ch)) 
    {
          echo curl_errno($ch) ;
          echo curl_error($ch);
    }
	// Si no hay errores, obtenemos la respuesta
    else 
    {
		// En response obtengo la respuesta a lo que me mandan
        $response = curl_exec($ch);
		//$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		//echo $code; //mirar code, si es 200 va bien, si es 4xx mal
		echo "Fin tiendas";
		echo "<br>";
        print_r($response);
        curl_close($ch);
    }
	
	// Obtenemos la raiz del xml de respuesta
	$raiz = $xmlDoc->documentElement;
	$tipomsn = $raiz->nodeName; // obtenemos el tipo de mensaje
	
	// Borramos la tienda de la base de datos
	$sql="INSERT INTO mensajes (idEmisor,idReceptor,timestamp,tipo) VALUES ('monitor','$tienda','$time','$tipomsn')"; 
    $datos=mysqli_query($link,$sql);
	
	
	$sql2 = "UPDATE tiendas SET cerrada='S' WHERE idtienda='$tienda'";
	$datos=mysqli_query($link,$sql2);
	
	
	mysqli_close($link); // cerramos la conexion de la BBDD

?>