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

	// Borramos de la BBDD
	$sql="TRUNCATE TABLE `tiendas`";
	$pr=mysqli_query($link,$sql);
	$sql="TRUNCATE TABLE `clientes`";
	$pr=mysqli_query($link,$sql);
	$sql="TRUNCATE TABLE `tiendaproducto`";
	$pr=mysqli_query($link,$sql);
	$sql="TRUNCATE TABLE `mensajes`";
	$pr=mysqli_query($link,$sql);
	$sql="TRUNCATE TABLE `clientetienda`";
	$pr=mysqli_query($link,$sql);
	$sql="TRUNCATE TABLE `servtienda`";
	$pr=mysqli_query($link,$sql);
	$sql="TRUNCATE TABLE `clienteproducto`";
	$pr=mysqli_query($link,$sql);
	$sql="TRUNCATE TABLE `clientesentienda`";
	$pr=mysqli_query($link,$sql);
	
	echo "¡Reploid relizado con éxito!";

?>

