<?php

function tiempo() {
    locales("./carpeta");
    sleep(5);
    tiempo();
}

function locales($ruta) {
    if (is_dir($ruta)) {
        $gestor = opendir($ruta);
        while ($archivo = readdir($gestor)) {
            $ruta_completa = $archivo;
            $listal[] = $ruta_completa;
        }
        servidor("./carpeta1", $listal);
        closedir($gestor);
    } else {
        echo "No es una ruta de directorio valida<br/>";
    }
}

function compara($locales, $alojados) {
    $resultado = array_diff($locales, $alojados);
    aenviar($resultado);
}
?>
<?php tiempo(); ?>

