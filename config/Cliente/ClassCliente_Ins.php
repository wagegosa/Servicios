 <?php

  //llamamos a la connecion
  require('../General/connexion.php');
  //capturamos
  $Nombre = $_POST['Nombre'];
  $Apellido = $_POST['Apellido'];
  $Direccion = $_POST['Direccion'];
  $Telefono = $_POST['Telefono'];
  $Celular = $_POST['Celular'];
  //Validamos que el metodo POST este enviando datos.
  if ($_POST != "") {
    try {
      $Con = new DataBase();
      $Conexion = $Con->Conexion();
      $query = "INSERT INTO Servicios.Cliente 
                         (Nombre, Apellido, Direccion, Telefono, Celular) 
                  VALUES ('$Nombre', '$Apellido', '$Direccion', '$Telefono', '$Celular')";
      $Conexion->query($query);
      echo "<script>alert('¡Se almaceno correctamente.!');</script>";
      header("Location: ../../admin/Cliente/index.php");
    } catch (PDOException $e) {
      die("Ha ocurrido un error inesperado en la base de datos.<br>" . $e->getMessage());
      echo "Por favor revisar los datos que se estan insertando.";
    }
  }
  //si no esta enviando datos, nos notifica por un scritp y nos muestra que nos trae.
  else {
    echo "<script>alert('¡Por favor revisar los datos ingresados, estos no pueden estar vacíos! ');</script>";
    die('<h1>Por favor regrese a la pagina anterior y termine de ingresar datos.</h1>');
    // echo '<input type="hidden" id="error" name="error">'
    header("Location:../../admin/preguntas/Con_preguntas.php");
  }
  ?>