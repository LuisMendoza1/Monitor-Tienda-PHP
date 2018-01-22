<?php
	
	$URL = "http://localhost:8080/monitor/Mensajes/recibir.php";
	$xml = new DOMDocument();
	$xml->load("TC3.xml");

    //Enviamos por POST
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,$URL);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml', 'Access-Control-Allow-Origin: *'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml->saveXML());

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
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		echo $code; //mirar code, si es 200 va bien, si es 4xx mal
        print_r($response);
        curl_close($ch);
    }


?>

