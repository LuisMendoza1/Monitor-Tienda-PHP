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

$peticion1 = mysql_query("SELECT ip FROM `servtienda`");
	// Para cada servidor
	while($fila1 = mysql_fetch_array($peticion1))
		{
			$servidor = $fila1['ip'];
			echo "<br>";	
			echo "Tiendas en el servidor "."<b>'".$servidor."'</b>".":";
			echo "<br>";	
			echo "---------------------------------------------------------------------";
			echo "<br>";
			
			$peticion2 = mysql_query("SELECT idtienda FROM `tiendas` WHERE ip = '$servidor' AND cerrada='N'");
				// Para cada tienda
				while($fila2 = mysql_fetch_array($peticion2)){
					$tienda = $fila2['idtienda'];
					echo "<br>";
					echo "&nbsp"."&nbsp"."&nbsp"."&nbsp"."&nbsp"."&nbsp"."<b>".$tienda."</b>";
					echo "<br>";
				}
	//Obtenemos el numero de tiendas disponibles en el servidor
	$peticion = "SELECT COUNT(*) FROM `tiendas` WHERE ip='$servidor' AND cerrada='N'";
	$pr=mysqli_query($link,$peticion);
	$rel=$pr->fetch_array(MYSQLI_NUM);
	$tiendas=(int) $rel[0];
	echo "<br>";
	echo "<br>";
	echo "&nbsp"."&nbsp"."&nbsp"."&nbsp"."&nbsp"."&nbsp"."<b>".$tiendas."</b>"." tiendas abiertas en este servidor";
	echo "<br>";
		}
		
	//Obtenemos el numero de tiendas disponibles en la BBDD
	$peticion = "SELECT COUNT(*) FROM `tiendas`";
	$pr=mysqli_query($link,$peticion);
	$rel=$pr->fetch_array(MYSQLI_NUM);
	$tien=(int) $rel[0];
	
echo "<br>";	
echo "---------------------------------------------------------------------";
echo "<br>";
echo "<br>";
echo "<br>";	
echo "SE HAN GENERADO "."<b>".$tien."</b>"." TIENDAS EN TOTAL";

mysqli_close($link); // cerramos la conexion de la BBDD

?>