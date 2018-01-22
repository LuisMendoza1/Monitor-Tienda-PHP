<?php

	// Obtenemos las especificaciones del servidor a partir del html
	$ip = $_POST["txtServer"]; // ip del servidor de tiendas
	$nTiendas = $_POST["txtNTiendas"]; // numero maximo de tiendas en el servidor
	$tipo = $_POST["txtNtipo"]; // tipo de tienda
	
	// Establecemos conexion con la BBDD
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
		
	// Insertamos los datos del servidor de tiendas
	$sql1="INSERT INTO servtienda (ip,maxTiendas,tipo) VALUES ('$ip','$nTiendas','$tipo')"; 
	$datos=mysqli_query($link,$sql1);

// Hacemos un bucle para enviar las tiendas que especifiquemos en html
for($i=1;$i<=$nTiendas;$i++)
{	

// Creamos un nuevo documento xml
$xmlDoc = new DOMDocument();
// Cargamos la plantilla del mensaje MT1
$xmlDoc->load("plantillaMT1.xml");

// Obtengo el nodo <emisor>
$emisor = $xmlDoc->getElementsByTagName("emisor");
// Modifico el valor del nodo <emisor>
$emisor->item(0)->nodeValue = "monitor";
 
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
$ti = $timestamp->item(0)->nodeValue;

// Obtengo el id de la tienda con un numero aleatorio
$tim = (int) rand(1,9999) + (int) rand(1,9999);
$idtienda = "tienda".$tim;

// Obtenemos el nodo <listaP>
$listaproductos = $xmlDoc->getElementsByTagName("listaP")->item(0);

// Obtengo el nodo <receptor>
$timest = $fecha->getTimestamp();
$receptor = $xmlDoc->getElementsByTagName("receptor");
// Modifico el valor del nodo <receptor>
$receptor->item(0)->nodeValue = $idtienda;

	// Insertamos la tienda en la BBDD
	$sql="INSERT INTO tiendas (idtienda,ip,cerrada) VALUES ('$idtienda','$ip','N')";
    $datos=mysqli_query($link,$sql);


	//Obtenemos el numero de productos y lo almacenamos en la variable $prod
	$sql="SELECT COUNT(*) FROM productos";
	$pr=mysqli_query($link,$sql);
	$rel=$pr->fetch_array(MYSQLI_NUM);
	$prod=(int) $rel[0];


	$aleat = (int) rand(4,$prod);
	$listaP = array(); // array con la lista de productos de un cliente
	while(count($listaP) < $aleat)
	{
		$aleat2 = (int) rand(1,$prod); //Un producto entre 1 y el numero de productos que tengamos
		
		//Hay que meterlo en la lista siempre y cuando no esté dentro el producto para no repetirlo
		if ((in_array($aleat2,$listaP)) == FALSE) //Si no esta en la lista lo metemos para no repetir
		{
			array_push($listaP, $aleat2);
		}
	}

	// Obtenemos cada uno de los productos
	$prods = implode(", ", $listaP);

	$sql = "SELECT * FROM `productos` WHERE idproducto IN ($prods)";
	if ($peticion = mysql_query($sql)) {
		while($fila = mysql_fetch_assoc($peticion)) {
			$var = $fila['nombre']; // En $var tengo el nombre del producto
			//echo $var;
			//echo "<br>";
			// Creo el nodo <producto>
			$pro = $xmlDoc->createElement('producto');
			// Inserto el nodo <producto> como hijo de <listaP>
			$listaproductos->appendChild($pro);
			// Creo el nodo <nombre>
			$nompro = $xmlDoc->createElement('nombre', $var);
			// Inserto el nodo <nombre> como hijo de <producto>
			$pro->appendChild($nompro);
			// Obtenemos una cantidad de productos aleatoria
			$can = (int) rand(100,300);
			// Creo el nodo <cantidad>
			$cant = $xmlDoc->createElement('cantidad',$can);
			// Inserto el nodo <cantidad> como hijo de <producto>
			$pro->appendChild($cant);
			
			$peticion1 = "SELECT idproducto from productos where productos.nombre='$var'";
			$pr=mysqli_query($link,$peticion1);
			$rel=$pr->fetch_array(MYSQLI_NUM);
			$prod=(int) $rel[0];
			
			// Insertamos en la tabla tiendaproducto
			$sql1="INSERT INTO tiendaproducto (idproducto,idtienda,cantidad) VALUES ('$prod','$idtienda','$can')"; 
			$datos=mysqli_query($link,$sql1);
		}
			// Obtenemos la raiz del xml de respuesta
			$raiz = $xmlDoc->documentElement;
			$tipomsn = $raiz->nodeName; // obtenemos el tipo de mensaje
			
			// Insertamos en la tabla mensajes
			$sql="INSERT INTO mensajes (idEmisor,idReceptor,timestamp,tipo) VALUES ('monitor','$ip','$ti','$tipomsn')"; 
			$datos=mysqli_query($link,$sql);
	}
		mysql_free_result($peticion);

$URL = "$ip";

    //Enviamos por POST
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,$URL);
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
        print_r($response);
        curl_close($ch);
    }
}
	mysqli_close($link); // cerramos la conexion de la BBDD
	
	echo "Levantadas ".$nTiendas." tiendas en el servidor ".$ip;


?>