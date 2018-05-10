<?php

function tiempo(){
	
		locales("./carpeta");

	sleep(2);
	tiempo();
}





	/**
	* Funcion que muestra la estructura de carpetas a partir de la ruta dada.
	*/
	function locales($ruta){
		
		// Se comprueba que realmente sea la ruta de un directorio
		if (is_dir($ruta)){
			// Abre un gestor de directorios para la ruta indicada
			$gestor = opendir($ruta);
			
			while ($archivo = readdir($gestor))  {
			
				$ruta_completa =  $archivo;
				$listal[] = $ruta_completa;
			}
		
			servidor("./carpeta1", $listal);
			// Cierra el gestor de directorios
			closedir($gestor);
			
		} else {
			echo "No es una ruta de directorio valida<br/>";
		}
		
	}


	function servidor($ruta , $listal){
		
		// Se comprueba que realmente sea la ruta de un directorio
		if (is_dir($ruta)){
			// Abre un gestor de directorios para la ruta indicada
			$gestor = opendir($ruta);
			
			while ($archivo = readdir($gestor))  {
			
				$ruta_completa =  $archivo;
				$listas[] = $ruta_completa;
			}
		
			compara($listal, $listas);
			// Cierra el gestor de directorios
			closedir($gestor);
			
		} else {
			echo "No es una ruta de directorio valida<br/>";
		}
		
	}

	function compara($locales , $alojados){
		//$locales = json_encode($locales);
		//$alojados = json_encode($alojados);
		
		//echo $locales;
		//echo $alojados;
		
	
		$resultado = array_diff($locales, $alojados);
		//$resultado = json_encode($resultado);
		//echo $resultado;
		aenviar($resultado);	
		
	}

	function aenviar($array){
		$resultado = json_encode($array);
		echo $resultado;

	}
	
?>






<html>
<head>
	<title>escanea que hay</title>
</head>
<body>
	<div>
		<h2>escanea que hay</h2>
		<?php tiempo(); ?>
		
		
	</div>

	
</body>
</html>
