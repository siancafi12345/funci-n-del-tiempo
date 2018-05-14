<?php

function tiempo() {
    locales("./carpeta");
    sleep(300);
    tiempo();
}

function locales($ruta) {
    if (is_dir($ruta)) {
        $gestor = opendir($ruta);
        while ($archivo = readdir($gestor)) {
            $ruta_completa = $archivo;
            $listal[] = $ruta_completa;
        }
        conexion($listal);
        closedir($gestor);
    } else {
        echo "No es una ruta de directorio valida<br/>";
    }
}

function conexion($listalocal) {


    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "facturas";

// crear conexion
    $conn = new mysqli($servername, $username, $password, $dbname);
// estado de conexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT `nombre` FROM `archivos`";

    $result = $conn->query($sql);
    $listadodb[]= null;
    if ($result->num_rows > 0) {
        // output data of each row
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $listadodb[$i] = $row["nombre"];

            $i++;
        }
    } else {
        $listadodb = "nada";
    }
    
    if($listadodb != "nada"){
         compara($listalocal, $listadodb);
    }else{
        cargar($listalocal);
    }
    $conn->close();
}

function compara($locales, $alojados) {

    $resultado = array_diff($locales, $alojados);
    

    if (count($resultado) > 0) {
        cargar($resultado);
    }
}

function cargar($resultado) {
        
    $ftp_server = "Distecvial.com";
    $ftp_user_name = "distecvialftp";
    $ftp_user_pass = "Soporte7Ftp";
    
    


// establecer una conexión básica//
    $conn_id = ftp_connect($ftp_server);

    
// iniciar una sesión con nombre de usuario y contraseña
//
    $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// Cambiamos a modo pasivo, esto es importante porque, de esta manera le decimos al 
//servidor que seremos nosotros quienes comenzaremos la transmisión de datos.
//
    ftp_pasv($conn_id, true);
    
    

// verificar la conexión
//
    if ((!$conn_id) || (!$login_result)) {
        echo "¡La conexión FTP ha fallado!";
        //echo "Se intentó conectar al $ftp_server por el usuario $ftp_user_name";
        exit;
    } else {
        //echo "Conexión a $ftp_server realizada con éxito, por el usuario $ftp_user_name";
    }
   
    foreach ($resultado as $value) {
        $source_file = "carpeta/" . $value;
        $destination_file = "prueba/" . $value;

// subir un archivo
//
        
        @$upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY);

// comprobar el estado de la subida
//
        if (!$upload) {
            echo "¡La subida FTP ha fallado!";
        } else {
            guardar($value);
            //echo "Subida de $source_file a $ftp_server como $destination_file";
            //
        }
    }

    
// cerrar la conexión ftp 
//
    ftp_close($conn_id);
}

function guardar($value) {
   
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "facturas";
    
    // Create connection
    //
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    //
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
        $sql = "INSERT INTO archivos (nombre, fecha)
        VALUES ('".$value."', NOW())";

        if ($conn->query($sql) === TRUE) {
           echo "New record created successfully";
           
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
    $conn->close();
}
?>
<?php tiempo(); ?>

