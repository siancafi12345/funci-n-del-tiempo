

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
   
   
   
    echo "<table style='width:100%; margin-top: 10%;' >";
    echo "<tr>
    <th></th>
    <th style='font-size: 35px;'>Informe</th> 
    <th></th>
  </tr>";


    echo "<tr><th></th><th></th><th></th></tr>";
    echo "<tr><th></th><th></th><th></th></tr>";

    echo "<tr>
            <th>Tipo de Consulta</th>
            <form name='selec' method='post' action='informe.php'>
                <th>
                    <input type='radio' name='todo' value='male'>Todos los registros<br>
                </th> 
                <th>
                    <input type='radio' name='fecha' value='male'>De fecha inicio a fecha inicio<br>
                </th> 
                <th>
                    <input type='submit' value='Enviar'>
                </th>          
             </form>
         </tr>";


         echo "<tr><th></th><th></th><th></th></tr>";
         echo "<tr><th></th><th></th><th></th></tr>";

         if(isset($_POST['fecha'])) {
            
            echo "<tr >
            <th></th>
            <form name='fechas' method='post' action='informe.php'>
                <th>
                Fecha Inicion: <input  type='date' name='inicio' required step='1' min='2017-01-01' max='2040-12-31' value='Fecha inicio'>
                </th> 
                <th>
                Fecha Fin: <input type='date' name='fin' required step='1' min='2017-01-01' max='2040-12-31' value='Fecha fin'>
                </th> 
                <th>
                    <input type='submit' value='Enviar'>
                </th>           
             </form>
         </tr>";
            
            }

      
   
         
    
    echo "<tr><th></th><th></th><th></th></tr>";
    echo "<tr><th></th><th></th><th></th></tr>";
    
    if(isset($_POST['inicio'])) { 

        $inicio =  $_POST['inicio']." 00:00:00";
        $fin =  $_POST['fin']." 00:00:00";  
       


        $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "facturas";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM archivos WHERE fecha BETWEEN '".$inicio."'  AND '".$fin."'";

   
     $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $listadodbf[$i]['id'] = $row["id"];
            $listadodbf[$i]['nombre'] = $row["nombre"];
            $listadodbf[$i]['fecha'] = $row["fecha"];
                        
            $i++;
        }
    } else {
        $listadodbf = "nada";
    }
        
        
       

 
      
    echo "<tr>    
    <th style='font-size: 24px; border:solid black 1px;   background: cadetblue;'>id</th>
    <th style='font-size: 24px; border: solid black 1px;  background: cadetblue;'>Nombre</th> 
    <th style='font-size: 24px; border: solid black 1px;  background: cadetblue;'>Fecha</th>
  </tr>";
  $i= 0 ;
    foreach($listadodbf as $recorrer){
        if ($i%2==0){
            $color = "background: white";
        }else{
            $color = "background: darkgray";
        }

        echo "<tr>
                <th style='".$color."'>".$recorrer['id']."</th>
                <th style='".$color."'>".$recorrer['nombre']."</th> 
                <th style='".$color."'>".$recorrer['fecha']."</th>
            </tr>";
        $i++;
    }
    echo "</table>";
    }



    
    if(isset($_POST['todo'])) { 

        
 
    echo "<tr>    
    <th style='font-size: 24px; border:solid black 1px;   background: cadetblue;'>id</th>
    <th style='font-size: 24px; border: solid black 1px;  background: cadetblue;'>Nombre</th> 
    <th style='font-size: 24px; border: solid black 1px;  background: cadetblue;'>Fecha</th>
  </tr>";
  $i= 0 ;
    foreach($listadodb as $recorrer){
        if ($i%2==0){
            $color = "background: white";
        }else{
            $color = "background: darkgray";
        }

        echo "<tr>
                <th style='".$color."'>".$recorrer['id']."</th>
                <th style='".$color."'>".$recorrer['nombre']."</th> 
                <th style='".$color."'>".$recorrer['fecha']."</th>
            </tr>";
        $i++;
    }
    echo "</table>";
}
    $conn->close();
}
?>

