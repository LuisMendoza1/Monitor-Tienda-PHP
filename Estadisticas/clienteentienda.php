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

	// Para cada mensaje TC3 (la tienda admite al cliente)

			// Para cada tienda
			$peticion1 = mysql_query("SELECT DISTINCT idtienda FROM `clientesentienda`");
				while($fila1 = mysql_fetch_array($peticion1)){
					$tienda = $fila1['idtienda'];

					echo "<br>";
					echo "La tienda "."<b>'".$tienda."'</b>"." ha tenido los siguientes clientes:";
					// Para cada cliente en cada tienda
					$peticion3 = mysql_query("SELECT idcliente FROM `clientesentienda` WHERE idtienda='$tienda'");
						while($fila3 = mysql_fetch_array($peticion3)){
							$cliente = $fila3['idcliente'];
					echo "<br>";
					echo "<br>";
					echo "<b>'".$cliente."'</b>";
					
					}
					//Obtenemos el numero de clientes en cada tienda
				$sql="SELECT COUNT(*) FROM clientesentienda WHERE idtienda='$tienda'";
				$pr=mysqli_query($link,$sql);
				$rel=$pr->fetch_array(MYSQLI_NUM);
				$cli=(int) $rel[0];
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "Nº total de clientes en la tienda: "."<b>".$cli."</b>";
				echo "<br>";
				echo "------------------------------------------------------------------";
				echo "<br>";
				}
				


?>