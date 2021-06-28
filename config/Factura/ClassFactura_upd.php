 <?php
 
  //llamamos a la connecion
  require('../General/connexion.php');
  //capturamos
  $Idfactura = $_POST['Idfactura'];
  $Idcliente = $_POST['Idcliente'];
  $IdVehiculo = $_POST['IdVehiculo'];
  $FechaRegistro = $_POST['FechaRegistro'];
  $Idestado = $_POST['Idestado'];
  if ($_POST != "") {
    try {
      $Con = new DataBase();
      $Conexion = $Con->Conexion();
      $query = "UPDATE Servicios.Cliente 
                 SET Idcliente = '$Idcliente', IdVehiculo = '$IdVehiculo', FechaRegistro = '$FechaRegistro', Idestado = '$Idestado'
               WHERE Idfactura = '$Idfactura'";
              //  echo "<pre>";
              //  print_r($query);
              //  echo "</pre>";
              //  die;
      $Conexion->query($query);
      $Resul = $Conexion->prepare($query);
      $Resul->bindParam(':id', $id, PDO::PARAM_STR, 100);
      $Resul->execute();
      $Resul->setFetchMode(PDO::FETCH_ASSOC);
      $Resultado = $Resul->rowCount();
      echo "<script>alert('¡Se almaceno correctamente.!');</script>";
      if ($Resultado == 0) {
        header("Location: ../../admin/Factura/index.php");
        die;
      } else {
        echo "Fallo la redirección";
        exit();
      }
    } catch (PDOException $e) {
      echo "<script>alert('¡Por favor revisar los datos ingresados, estos no pueden estar vacíos! ');</script>";
      die('<h1>Por favor regrese a la pagina anterior y termine de ingresar datos.</h1>');
      // die("Ha ocurrido un error inesperado en la base de datos.<br>".$e->getMessage());
    }
  } else {
    die("<script>alert('¡Por favor revisar los datos ingresados, estos no pueden estar vacíos! ');</script>");
  }

  ?>