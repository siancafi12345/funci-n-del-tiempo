<?php

$ftp_server = "Distecvial.com";
$ftp_user_name = "distecvialftp";
$ftp_user_pass = "Soporte7Ftp";


// establecer una conexión básica
$conn_id = ftp_connect($ftp_server);

// iniciar una sesión con nombre de usuario y contraseña
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// Cambiamos a modo pasivo, esto es importante porque, de esta manera le decimos al 
//servidor que seremos nosotros quienes comenzaremos la transmisión de datos.
ftp_pasv($conn_id, true);

// verificar la conexión
if ((!$conn_id) || (!$login_result)) {
    echo "¡La conexión FTP ha fallado!";
    echo "Se intentó conectar al $ftp_server por el usuario $ftp_user_name";
    exit;
} else {
    echo "Conexión a $ftp_server realizada con éxito, por el usuario $ftp_user_name";
}

$source_file = "logs.txt";
$destination_file = "prueba/logs.txt";

// subir un archivo
$upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY);

// comprobar el estado de la subida
if (!$upload) {
    echo "¡La subida FTP ha fallado!";
} else {
    echo "Subida de $source_file a $ftp_server como $destination_file";
}

// cerrar la conexión ftp 
ftp_close($conn_id);
?>