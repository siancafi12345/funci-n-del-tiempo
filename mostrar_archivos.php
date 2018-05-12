<?php

function tiempo(){
	locales("./carpeta");
	sleep(5);
	tiempo();
}


	function locales($ruta){
		if (is_dir($ruta)){
			$gestor = opendir($ruta);
			while ($archivo = readdir($gestor))  {
				$ruta_completa =  $archivo;
				$listal[] = $ruta_completa;
			}
			servidor("./carpeta1", $listal);
			closedir($gestor);
		} else {
			echo "No es una ruta de directorio valida<br/>";
		}
		
	}


	function servidor($ruta , $listal){
		if (is_dir($ruta)){
			$gestor = opendir($ruta);
			while ($archivo = readdir($gestor))  {
				$ruta_completa =  $archivo;
				$listas[] = $ruta_completa;
			}
			compara($listal, $listas);
			closedir($gestor);
			
		} else {
			echo "No es una ruta de directorio valida<br/>";
		}
		
	}

	function compara($locales , $alojados){
		$resultado = array_diff($locales, $alojados);
		aenviar($resultado);	
	}

	function aenviar($array){
		foreach ($array as $value){
			$donde_esta='./carpeta/'.$value;
			$donde_estara='./carpeta1/'.$value;
			if(!copy($donde_esta, $donde_estara)){

				$guardados[]=$value;
			}
		}

		$nombre_archivo = 'logs.txt'; 
		$contenido = $nombre; 
		fopen($nombre_archivo, 'a+'); 

		// Asegurarse primero de que el archivo existe y puede escribirse sobre el. 
		if (is_writable("./logs".$nombre_archivo)) { 
			echo "si esta";
			die;
   // En nuestro ejemplo estamos abriendo $nombre_archivo en modo de adicion. 
   // El apuntador de archivo se encuentra al final del archivo, asi que 
   // alli es donde ira $contenido cuando llamemos fwrite(). 
   if (!$gestor = fopen($nombre_archivo, 'a')) { 
         echo "No se puede abrir el archivo ($nombre_archivo)"; 
         exit; 
   } 

   // Escribir $contenido a nuestro arcivo abierto. 
   if (fwrite($gestor, $contenido) === FALSE) { 
       echo "No se puede escribir al archivo ($nombre_archivo)"; 
       exit; 
   } 
    
   echo "&Eacute;xito, se escribi&oacute; ($contenido) al archivo ($nombre_archivo)"; 
    
   fclose($gestor); 

} else { 
   echo "No se puede escribir sobre el archivo $nombre_archivo"; 
} 
	}
?>
		<?php tiempo(); ?>

