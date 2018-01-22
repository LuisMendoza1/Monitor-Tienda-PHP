<?php

// Cabeceras para deshabilitar el CORs en php
header("Access-Control-Allow-Origin: *");
header('Content-type: application/xml');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization, X-Requested-With');
http_response_code(200);

// A la escucha...
$url = "php://input";
   
// Obtenemos el contenido del xml
$xml = file_get_contents("$url");

// Dejamos en un fichero respuesta el xml para parsearlo con el Dom
$flujo = fopen('respuesta.xml', 'w');
fputs($flujo, $xml);
fclose($flujo);

// Creamos y cargamos el documento con Dom
$xmlDoc = new DOMDocument();
$xmlDoc->load("respuesta.xml");

// Obtenemos la raiz del xml de respuesta
$raiz = $xmlDoc->documentElement;

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
		
// Obtenemos el tipo de mensaje
$tipomsn = $raiz->nodeName;
		
// Comprobamos cual es el tipo de mensaje
switch ($tipomsn)
{
	// MENSAJES TIENDA - CLIENTE
	case "CT1":
	$emisor = $xmlDoc->getElementsByTagName("emisor");
	$emi = $emisor->item(0)->nodeValue;
	$receptor = $xmlDoc->getElementsByTagName("receptor");
	$rec = $receptor->item(0)->nodeValue;
	$timestamp = $xmlDoc->getElementsByTagName("timestamp");
	$time = $timestamp->item(0)->nodeValue;

	$sql="INSERT INTO mensajes (idEmisor,idReceptor,timestamp,tipo) VALUES ('$emi','$rec','$time','$tipomsn')"; 
    $datos=mysqli_query($link,$sql);
	echo "ok";
	break;
	
	case "TC2":
	$emisor = $xmlDoc->getElementsByTagName("emisor");
	$emi = $emisor->item(0)->nodeValue;
	$receptor = $xmlDoc->getElementsByTagName("receptor");
	$rec = $receptor->item(0)->nodeValue;
	$timestamp = $xmlDoc->getElementsByTagName("timestamp");
	$time = $timestamp->item(0)->nodeValue;
	
	$sql="INSERT INTO mensajes (idEmisor,idReceptor,timestamp,tipo) VALUES ('$emi','$rec','$time','$tipomsn')"; 
    $datos=mysqli_query($link,$sql);
	
	$sql1="INSERT INTO clientesentienda (idtienda,idcliente) VALUES ('$emi','$rec')"; 
    $datos=mysqli_query($link,$sql1);
	
	echo "ok";
	break;
	
	case "TC3":
	$emisor = $xmlDoc->getElementsByTagName("emisor");
	$emi = $emisor->item(0)->nodeValue;
	$receptor = $xmlDoc->getElementsByTagName("receptor");
	$rec = $receptor->item(0)->nodeValue;
	$timestamp = $xmlDoc->getElementsByTagName("timestamp");
	$time = $timestamp->item(0)->nodeValue;
	
	$sql="INSERT INTO mensajes (idEmisor,idReceptor,timestamp,tipo) VALUES ('$emi','$rec','$time','$tipomsn')"; 
    $datos=mysqli_query($link,$sql);


	
	echo "ok";
	break;
	
	case "CT4":
	$emisor = $xmlDoc->getElementsByTagName("emisor");
	$emi = $emisor->item(0)->nodeValue;
	$receptor = $xmlDoc->getElementsByTagName("receptor");
	$rec = $receptor->item(0)->nodeValue;
	$timestamp = $xmlDoc->getElementsByTagName("timestamp");
	$time = $timestamp->item(0)->nodeValue;
	
	$sql="INSERT INTO mensajes (idEmisor,idReceptor,timestamp,tipo) VALUES ('$emi','$rec','$time','$tipomsn')"; 
    $datos=mysqli_query($link,$sql);
	echo "ok";
	break;
	
	case "TC5":
	$emisor = $xmlDoc->getElementsByTagName("emisor");
	$emi = $emisor->item(0)->nodeValue;
	$receptor = $xmlDoc->getElementsByTagName("receptor");
	$rec = $receptor->item(0)->nodeValue;
	$timestamp = $xmlDoc->getElementsByTagName("timestamp");
	$time = $timestamp->item(0)->nodeValue;
	
	$sql="INSERT INTO mensajes (idEmisor,idReceptor,timestamp,tipo) VALUES ('$emi','$rec','$time','$tipomsn')"; 
    $datos=mysqli_query($link,$sql);
	echo "ok";
	break;
	
	case "CT6":
	$emisor = $xmlDoc->getElementsByTagName("emisor");
	$emi = $emisor->item(0)->nodeValue;
	$receptor = $xmlDoc->getElementsByTagName("receptor");
	$rec = $receptor->item(0)->nodeValue;
	$timestamp = $xmlDoc->getElementsByTagName("timestamp");
	$time = $timestamp->item(0)->nodeValue;
	
	$sql="INSERT INTO mensajes (idEmisor,idReceptor,timestamp,tipo) VALUES ('$emi','$rec','$time','$tipomsn')"; 
    $datos=mysqli_query($link,$sql);
	echo "ok";
	break;
	
	case "TC7":
	$emisor = $xmlDoc->getElementsByTagName("emisor");
	$emi = $emisor->item(0)->nodeValue;
	$receptor = $xmlDoc->getElementsByTagName("receptor");
	$rec = $receptor->item(0)->nodeValue;
	$timestamp = $xmlDoc->getElementsByTagName("timestamp");
	$time = $timestamp->item(0)->nodeValue;
	
	$sql="INSERT INTO mensajes (idEmisor,idReceptor,timestamp,tipo) VALUES ('$emi','$rec','$time','$tipomsn')"; 
    $datos=mysqli_query($link,$sql);
	echo "ok";
	break;
	
	// MENSAJES MONITOR - TIENDA
	case "TM2":
	$emisor = $xmlDoc->getElementsByTagName("emisor");
	$emi = $emisor->item(0)->nodeValue;
	$receptor = $xmlDoc->getElementsByTagName("receptor");
	$rec = $receptor->item(0)->nodeValue;
	$timestamp = $xmlDoc->getElementsByTagName("timestamp");
	$time = $timestamp->item(0)->nodeValue;
	
	$sql="INSERT INTO mensajes (idEmisor,idReceptor,timestamp,tipo) VALUES ('$emi','$rec','$time','$tipomsn')"; 
    $datos=mysqli_query($link,$sql);
	//echo "ok";
	break;
	
	case "TM4":
	$emisor = $xmlDoc->getElementsByTagName("emisor");
	$emi = $emisor->item(0)->nodeValue;
	$receptor = $xmlDoc->getElementsByTagName("receptor");
	$rec = $receptor->item(0)->nodeValue;
	$timestamp = $xmlDoc->getElementsByTagName("timestamp");
	$time = $timestamp->item(0)->nodeValue;
	echo $emi;
	
	$sql="INSERT INTO mensajes (idEmisor,idReceptor,timestamp,tipo) VALUES ('$emi','$rec','$time','$tipomsn')"; 
    $datos=mysqli_query($link,$sql);
	//echo "ok";
	
	// En $tienda tengo el id de la tienda
	$tien = $xmlDoc->getElementsByTagName("emisor");
	$tienda = $emisor->item(0)->nodeValue;
	echo "<br>";
	echo "La tienda: "."<b>'".$tienda."</b>'"." tiene";
	echo "<br>";
	echo "----------------------------------------";
	echo "<br>";
	
	$lista = $xmlDoc->getElementsByTagName("listaP")->item(0);
	
	$hijos = array();
	$lProdu = array();
	
	// Para cada producto vemos que cosas hay en cada uno
	foreach($lista ->childNodes as $producto){
		array_push($hijos, $producto);
		if($producto->hasChildNodes()){
			//echo "el producto tiene ";
			foreach($producto ->childNodes as $hijo){ // meto los hijos de cada producto en lProdu
				array_push($lProdu, $hijo);
				//echo "<br>";
				
				if($hijo->nodeName == "nombre"){ // si el nodo hijo es el nombre
					$nom = $hijo->nodeValue;
					echo "<b>".$nom."</b>";
				}
				
				if($hijo->nodeName == "cantidad"){ // si el nodo hijo es la cantidad
					$can = $hijo->nodeValue;
					echo " con cantidad: "."<b>".$can."</b>";
					
				//Actualizamos los valores de la tabla tiendaproducto con las cantidades correspondientes
				$sql = "UPDATE tiendaproducto SET cantidad='$can' WHERE idtienda='$tienda' AND idproducto IN (SELECT idproducto FROM productos WHERE nombre='$nom')";
				$datos=mysqli_query($link,$sql);
				}
				//echo "<br>";

			}
			//echo count($lProdu)." cosas";
			echo "<br>";
			$lProdu = array();
			
		}
		else{
			
			echo "<br>";
		}
	}
	echo "<br>";
	//echo count($hijos);
	break;
	
	case "MT5": // por si me lo vuelven a enviar como respuesta
	$emisor = $xmlDoc->getElementsByTagName("emisor");
	$emi = $emisor->item(0)->nodeValue;
	$receptor = $xmlDoc->getElementsByTagName("receptor");
	$rec = $receptor->item(0)->nodeValue;
	$timestamp = $xmlDoc->getElementsByTagName("timestamp");
	$time = $timestamp->item(0)->nodeValue;
	
	$sql="INSERT INTO mensajes (idEmisor,idReceptor,timestamp,tipo) VALUES ('$emi','$rec','$time','$tipomsn')"; 
    $datos=mysqli_query($link,$sql);
	echo "ok";
	break;
	
	
	// MENSAJES MONITOR - CLIENTE
	case "CM1":
	$emisor = $xmlDoc->getElementsByTagName("emisor");
	$emi = $emisor->item(0)->nodeValue;
	
	$receptor = $xmlDoc->getElementsByTagName("receptor");
	$rec = $receptor->item(0)->nodeValue;
	
	$fecha = new DateTime();
	$timestamp = $xmlDoc->getElementsByTagName("timestamp");
	$time = $timestamp->item(0)->nodeValue;
	// Obtengo el id del cliente
	$tim = (int) rand(1,9999) + (int) rand(1,9999);
	$idcliente = "cliente".$tim;
	
	$sql="INSERT INTO mensajes (idEmisor,idReceptor,timestamp,tipo) VALUES ('$emi','$rec','$time','$tipomsn')"; 
    $datos=mysqli_query($link,$sql);
	
	// Mandamos la respuesta MC2 al cliente con el id, la lista de la compra y el numero de tiendas 
	$MC2 = new DOMDocument();
	$MC2->load("plantillaMC2.xml");

	// Obtengo el nodo <emisor>
	$emisor = $MC2->getElementsByTagName("emisor");
	// Modifico el valor del nodo <emisor>
	$emisor->item(0)->nodeValue = "monitor";
 
	// Obtengo el nodo <time>
	$time = $MC2->getElementsByTagName("time");

	// Obtenemos la ip local y la insertamos en el nodo <creador>
	$localIP = getHostByName(php_uname('n'));
	// Obtenemos el nodo <creador> hijo del nodo <time>
	$creador = $MC2->getElementsByTagName("creador");
	$creador->item(0)->nodeValue = $localIP;

	// Obtenemos el timestamp y lo insertamos en el nodo <timestamp>
	$fecha = new DateTime();
	$timestamp = $MC2->getElementsByTagName("timestamp");
	$timestamp->item(0)->nodeValue = $fecha->getTimestamp();

	// Obtengo el nodo <receptor>
	$timest = $fecha->getTimestamp();
	$receptor = $MC2->getElementsByTagName("receptor");
	// Modifico el valor del nodo <receptor>
	$receptor->item(0)->nodeValue = $idcliente;
	
	// Insertamos el cliente en la BBDD
	$sql="INSERT INTO clientes (idcliente) VALUES ('$idcliente')";
    $datos=mysqli_query($link,$sql);
	
	// Obtenemos el nodo <listaP>
	$listaproductos = $MC2->getElementsByTagName("listaP")->item(0);
	
	// Obtenemos el nodo <listaT>
	$listatiendas = $MC2->getElementsByTagName("listaT")->item(0);
	
	//Obtenemos el numero de productos aleatorio para la lista de la compra
	$sql="SELECT COUNT(*) FROM productos";
	$pr=mysqli_query($link,$sql);
	$rel=$pr->fetch_array(MYSQLI_NUM);
	$prod=(int) $rel[0];
	mysqli_free_result($pr);
	
	
	$listaP = array(); // array con la lista de productos
	for ($i = 1; $i <= $prod; $i++) {
		if (rand(0,1)) {
			array_push($listaP, $i);
		}
	}
	
	// Obtenemos cada uno de los productos
	$prods = implode(", ", $listaP);

	$sql = "SELECT * FROM `productos` WHERE idproducto IN ($prods)";
	if ($peticion = mysql_query($sql)) {
		while($fila = mysql_fetch_assoc($peticion)) {
			$var = $fila['nombre']; // En $var tengo el nombre del producto
			// Creo el nodo <producto>
			$pro = $MC2->createElement('producto');
			// Inserto el nodo <producto> como hijo de <listaP>
			$listaproductos->appendChild($pro);
			// Creo el nodo <nombre>
			$nompro = $MC2->createElement('nombre', $var);
			// Inserto el nodo <nombre> como hijo de <producto>
			$pro->appendChild($nompro);
			// Obtenemos una cantidad de productos aleatoria
			$can = (int) rand(1,20);
			// Creo el nodo <cantidad>
			$cant = $MC2->createElement('cantidad',$can);
			// Inserto el nodo <cantidad> como hijo de <producto>
			$pro->appendChild($cant);
			
			// Obtenemos el id del producto dado el nombre
			$sql="SELECT idproducto FROM productos WHERE productos.nombre='$var'";
			$pr=mysqli_query($link,$sql);
			$rel=$pr->fetch_array(MYSQLI_NUM);
			$idprod=(int) $rel[0];
			mysqli_free_result($pr);
			
			$sql="INSERT INTO clienteproducto (idcliente,idproducto,cantidad) VALUES ('$idcliente','$idprod','$can')"; 
			$datos=mysqli_query($link,$sql);
		}
		mysql_free_result($peticion);
	}
	
		$tiendas = array(); //Lista de tiendas que suminstran los productos
		
		// Numero aleatorio de tiendas
		$aleat = (int) rand(2,5);
		//Hacemos la consulta a las tiendas abiertas y las metemos en el array
		$peticion4 = mysql_query("SELECT idtienda FROM tiendas WHERE tiendas.cerrada='N' ORDER BY RAND() LIMIT $aleat ");
		while($fila1 = mysql_fetch_array($peticion4))
			{
				$var = $fila1['idtienda'];
				array_push($tiendas, $var); // Añadimos en tiendas las tiendas
			}	
		
		// Recorremos el array de tiendas para insertarlo en el xml
		foreach($tiendas as $tienda)
					{
			// Obtenemos la url de la tienda
			$sql="SELECT ip FROM `tiendas` WHERE idtienda='$tienda'";
			$pr=mysqli_query($link,$sql);
			$rel=$pr->fetch_array(MYSQLI_NUM);
			$iptienda= $rel[0];
			
			// Obtenemos el tipo de tecnologia de la tienda
			$sql1="SELECT tipo FROM servtienda WHERE servtienda.ip IN (SELECT ip FROM tiendas WHERE tiendas.idtienda = '$tienda')";
			$pr=mysqli_query($link,$sql1);
			$rel=$pr->fetch_array(MYSQLI_NUM);
			$tipo= $rel[0];
			
			
			// Creo el nodo <tienda>
			$tie = $MC2->createElement('tienda');
			// Inserto el nodo <tienda> como hijo de <listaT>
			$listatiendas->appendChild($tie);
			// Creo el nodo <idTienda>
			$idtie = $MC2->createElement('idTienda', $tienda);
			// Inserto el nodo <idTienda> como hijo de <tienda>
			$tie->appendChild($idtie);
			// Obtenemos una cantidad de productos aleatoria
			$can = (int) rand(1,20);
			// Creo el nodo <direccion>
			$direc = $MC2->createElement('direccion',$iptienda);
			// Inserto el nodo <direccion> como hijo de <tienda>
			$tie->appendChild($direc);
			// Creo el nodo <tipo>
			$tipo = $MC2->createElement('tipo',$tipo);
			// Inserto el nodo <tipo> como hijo de <tienda>
			$tie->appendChild($tipo);
			
			//Insertamos en la BBDD clientetienda para saber que tiendas tiene cada cliente
			$sql="INSERT INTO clientetienda (idcliente,idtienda) VALUES ('$idcliente','$tienda')"; 
			$datos=mysqli_query($link,$sql);
					}
	
	$timestamp->item(0)->nodeValue = $fecha->getTimestamp();
	$time = $timestamp->item(0)->nodeValue;
	
	$sql="INSERT INTO mensajes (idEmisor,idReceptor,timestamp,tipo) VALUES ('monitor','$emi','$time','MC2')"; 
    $datos=mysqli_query($link,$sql);
	
	echo $MC2->saveXML();
	break;
	
	case "CM3":
	$emisor = $xmlDoc->getElementsByTagName("emisor");
	$emi = $emisor->item(0)->nodeValue;
	$receptor = $xmlDoc->getElementsByTagName("receptor");
	$rec = $receptor->item(0)->nodeValue;
	$timestamp = $xmlDoc->getElementsByTagName("timestamp");
	$time = $timestamp->item(0)->nodeValue;
	
	$sql="INSERT INTO mensajes (idEmisor,idReceptor,timestamp,tipo) VALUES ('$emi','$rec','$time','$tipomsn')"; 
    $datos=mysqli_query($link,$sql);
	
	// Mandamos la respuesta MC4 al cliente
	$MC4 = new DOMDocument();
	$MC4->load("plantillaMC2.xml");

	// Obtengo el nodo <emisor>
	$emisor2 = $MC4->getElementsByTagName("emisor");
	// Modifico el valor del nodo <emisor>
	$emisor2->item(0)->nodeValue = "monitor";
	$emi2 = $emisor2->item(0)->nodeValue;
 
	// Obtengo el nodo <time>
	$time = $MC4->getElementsByTagName("time");

	// Obtenemos la ip local y la insertamos en el nodo <creador>
	$localIP = getHostByName(php_uname('n'));
	// Obtenemos el nodo <creador> hijo del nodo <time>
	$creador = $MC4->getElementsByTagName("creador");
	$creador->item(0)->nodeValue = $localIP;

	// Obtenemos el timestamp y lo insertamos en el nodo <timestamp>
	$fecha = new DateTime();
	$timestamp = $MC4->getElementsByTagName("timestamp");
	$timestamp->item(0)->nodeValue = $fecha->getTimestamp();
	$time = $timestamp->item(0)->nodeValue;

	// Obtengo el nodo <receptor>
	$timest = $fecha->getTimestamp();
	$receptor2 = $MC4->getElementsByTagName("receptor");
	// Modifico el valor del nodo <receptor>
	$receptor2->item(0)->nodeValue = "$emi";
	$rec2 = $receptor2->item(0)->nodeValue;
	
	$sql="INSERT INTO mensajes (idEmisor,idReceptor,timestamp,tipo) VALUES ('$emi2','$rec2','$time','MC4')"; 
    $datos=mysqli_query($link,$sql);
	
	// Eliminamos de la BBDD el cliente
	$sql1="DELETE FROM clientes WHERE idcliente='$emi'"; 
    $datos=mysqli_query($link,$sql1);
	$sql2="DELETE FROM clienteproducto WHERE idcliente='$emi'"; 
    $datos=mysqli_query($link,$sql2);
	$sql3="DELETE FROM clientetienda WHERE idcliente='$emi'"; 
    $datos=mysqli_query($link,$sql3);
	
	echo $MC4->saveXML();
	
	break;
}
 

?>