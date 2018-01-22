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

$peticion1 = mysql_query("SELECT idtienda FROM `tiendas`");
	// Para cada tienda
	while($fila1 = mysql_fetch_array($peticion1))
		{
			$tienda = $fila1['idtienda'];
			echo "<br>";
			echo "-------------------------------------------";
			echo "<br>";
			echo "Productos en la tienda "."<b>'".$tienda."'</b>".":";
			echo "<br>";
			echo "-------------------------------------------";
			echo "<br>";
			$peticion2 = mysql_query("SELECT idproducto FROM `tiendaproducto` WHERE idtienda='$tienda'");
			
				// Para cada producto
				while($fila2 = mysql_fetch_array($peticion2)){
				$idproducto = $fila2['idproducto'];
				
				// Obtenemos el nombre del producto
				$peticion3 = mysql_query("SELECT nombre FROM `productos` WHERE idproducto='$idproducto'");
					while($fila3 = mysql_fetch_array($peticion3)){
					$nomproducto = $fila3['nombre'];
					echo "<br>";
					echo "&nbsp"."&nbsp"."&nbsp"."&nbsp"."&nbsp"."&nbsp"."- "."<b>".$nomproducto."</b>";
					}
					
				// Obtenemos la cantidad del producto en la tienda
				$peticion4 = mysql_query("SELECT cantidad FROM `tiendaproducto` WHERE idproducto='$idproducto' AND idtienda='$tienda'");
					while($fila4 = mysql_fetch_array($peticion4)){
					$canproducto = $fila4['cantidad'];
					echo "&nbsp"."con "."<b>".$canproducto."</b>"." unidades";
					echo "<br>";
					echo "<br>";
					}
				}
		}
		mysqli_close($link); // cerramos la conexion de la BBDD

?>