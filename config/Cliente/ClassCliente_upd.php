 <?php
  //llamamos a la connecion
  require('../General/connexion.php');
  //capturamos
  $IdCliente = $_POST['IdCliente'];
  $Nombre = $_POST['Nombre'];
  $Apellido = $_POST['Apellido'];
  $Direccion = $_POST['Direccion'];
  $Telefono = $_POST['Telefono'];
  $Celular = $_POST['Celular'];
  if ($_POST != "") {
    try {
      $Con = new DataBase();
      $Conexion = $Con->Conexion();
      $query = "UPDATE Servicios.Cliente 
                 SET Nombre = '$Nombre', Apellido = '$Apellido', Direccion = '$Direccion', Telefono = '$Telefono', Celular = '$Celular', fec_modifi =  now()
               WHERE IdCliente = '$IdCliente'";
      $Conexion->query($query);
      $Resul = $Conexion->prepare($query);
      $Resul->bindParam(':id', $id, PDO::PARAM_STR, 100);
      $Resul->execute();
      $Resul->setFetchMode(PDO::FETCH_ASSOC);
      $Resultado = $Resul->rowCount();
      echo "<script>alert('¡Se almaceno correctamente.!');</script>";
      if ($Resultado == 0) {
        header("Location: ../../admin/Cliente/index.php");
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