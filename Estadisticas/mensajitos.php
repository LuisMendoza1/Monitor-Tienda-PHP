<?php

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

	//Obtenemos el numero de mensajes
	$sql="SELECT COUNT(*) FROM mensajes";
	$pr=mysqli_query($link,$sql);
	$rel=$pr->fetch_array(MYSQLI_NUM);
	$mens=(int) $rel[0];
	
	echo "<br>";
	echo "<br>";
	echo "---------------------------------------------------------------------------------------------------------";
	echo "<br>";
	echo "<br>";
	echo "Total mensajes: "."<b>".$mens."</b>";

// Obtenemos los timestamp
$peticion1 = mysql_query("SELECT timestamp FROM `mensajes`");
	while($fila1 = mysql_fetch_array($peticion1)){
		$timestamp = $fila1['timestamp'];
	// Para cada emisor dado el timestamp
	$peticion2 = mysql_query("SELECT idEmisor FROM `mensajes` WHERE timestamp='$timestamp'");
		while($fila2 = mysql_fetch_array($peticion2)){
			$emisor = $fila2['idEmisor'];
			// Para cada tipo de mensaje dado el timestamp y el emisor
				$peticion3 = mysql_query("SELECT tipo FROM `mensajes` WHERE timestamp='$timestamp' and idEmisor='$emisor'");
					while($fila3 = mysql_fetch_array($peticion3)){
						$tipo = $fila3['tipo'];
					// Para cada receptor dado el emisor, el timestamp y el tipo mensaje
					$peticion4 = mysql_query("SELECT idReceptor FROM `mensajes` WHERE tipo='$tipo' AND idEmisor='$emisor' AND timestamp='$timestamp'");
						while($fila4 = mysql_fetch_array($peticion4)){
							$receptor = $fila4['idReceptor'];
					echo "<br>";
					echo "---------------------------------------------------------------------------------------------------------";
					echo "<br>";
					echo "TIPO MENSAJE: "."<b>'".$tipo."'</b>"." EMISOR: "."<b>'".$emisor."'</b>"." RECEPTOR "."<b>'".$receptor."'</b>";
					echo "<br>";
					echo "---------------------------------------------------------------------------------------------------------";
					echo "<br>";
					echo "<br>";
						}
					}
				}
		}
		

	mysqli_close($link); // cerramos la conexion de la BBDD
	


?>