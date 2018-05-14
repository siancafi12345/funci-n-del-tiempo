

<?php
    conexion();
function conexion($desde= null, $hasta = null ) {

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "facturas";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM `archivos`";
    $result = $conn->query($sql);
    $listadodb[]= null;
    if ($result->num_rows > 0) {
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $listadodb[$i]['id'] = $row["id"];
            $listadodb[$i]['nombre'] = $row["nombre"];
            $listadodb[$i]['fecha'] = $row["fecha"];
                        
            $i++;
        }
    } else {
        $listadodb = "nada";
    }
   
   
   
    echo "<table style='width:100%' id='exportar'>";
    echo "<tr>
    <th></th>
    <th><h2>Informe</h2></th> 
    <th></th>
  </tr>";

  echo "<table style='width:100%' id='exportar'>";
  echo "<tr>
  <th></th>
  <th><h2></h2></th> 
  <th></th>
</tr>";
echo "<table style='width:100%' id='exportar'>";
echo "<tr>
<th></th>
<th><h2></h2></th> 
<th></th>
</tr>";
    echo "<tr>    
    <th style='font-size: 24px'>id</th>
    <th style='font-size: 24px'>Nombre</th> 
    <th style='font-size: 24px'>Fecha</th>
  </tr>";
    foreach($listadodb as $recorrer){
        echo "<tr>
                <th>".$recorrer['id']."</th>
                <th>".$recorrer['nombre']."</th> 
                <th>".$recorrer['fecha']."</th>
            </tr>";

    }
    echo "</table>";
   
    $conn->close();
}
?>