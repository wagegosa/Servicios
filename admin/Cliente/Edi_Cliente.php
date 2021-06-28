<?php
session_start();
//Conexión a la base de datos
require "../../config/General/connexion.php";

$Con = new DataBase();
$Conn = $Con->Conexion();

$_GET['id'] ? $_GET['id'] : '';

try {
  $query = "SELECT * FROM Servicios.Cliente WHERE IdCliente = " . $_GET['id'];
  $Resul = $Conn->prepare($query);
  $Resul->bindParam(':id', $id);
  $Resul->execute();
  $Resul->setFetchMode(PDO::FETCH_ASSOC);
  // $Resul->setFetchMode(PDO::FETCH_ASSOC);
  $Resultado = $Resul->rowCount();

  if ($Resultado != 0) {
    while ($R = $Resul->fetch()) :
?>
      <!DOCTYPE html>
      <html lang="es" ng-app>

      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Bootstrap núcleo CSS-->
        <link rel="stylesheet" media="screen" href="../../css/assets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" media="screen" href="../../css/assets/bootstrap/css/bootstrap.min.css">
        <!--Biblioteca de iconos monocromáticos y símbolos-->
        <link rel="stylesheet" href="../../css/assets/bootstrap/fonts/glyphicons-pro/css/glyphicons-pro.css">
        <link rel="stylesheet" href="../../css/assets/bootstrap/fonts/font-awesome/css/font-awesome.min.css">
        <!--Paginación, filtrado de registros-->
        <link rel="stylesheet" href="../../css/assets/footable/css/footable.bootstrap.min.css">
        <title>Usuarios</title>
      </head>

      <body>
        <div class="container">
          <?php include "../../plantillas/menu/menu_admin.php"; ?>
          <div class="row">
            <div class="col-md-12">
              <h3 class="page-header"><span class="glyphicons glyphicons-group"></span> Clientes </h3>
              <ol class="breadcrumb">
                <li><a href="">Inicio</a></li>
                <li><a href="index.php">Clientes</a></li>
                <li class="active">Editar Cliente</li>
              </ol>
            </div>
          </div>
          <!-- Formulario -->
          <form method="post" autocomplete="on" id="frm" action="../../config/Cliente/ClassCliente_upd.php">
            <!-- nombre -->
            <div class="row">
              <div class="col-md-4">
                <label for="email">Nombre:</label>
              </div>
              <div class="col-md-8">
                <input type="text" class="form-control" name="Cliente" rows="5" id="Cliente" value="<?= $R['Nombre']; ?>" placeholder="Nombre">
                <span class="help-block" id="error"></span>
              </div>
            </div>
            <!-- Apellido -->
            <div class="row">
              <div class="col-md-4">
                <label for="email">Apellido:</label>
              </div>
              <div class="col-md-8">
                <input type="text" class="form-control" name="Apellido" id="Apellido" value="<?= $R['Apellido']; ?>" placeholder="Usaurio">
                <span class="help-block" id="error"></span>
              </div>
            </div>
            <!-- Direccion -->
            <div class="row">
              <div class="col-md-4">
                <label for="email">Direccion:</label>
              </div>
              <div class="col-md-8">
                <input type="text" class="form-control" name="Direccion" id="Direccion" value="<?= $R['Direccion']; ?>" placeholder="Direccion">
                <span class="help-block" id="error"></span>
              </div>
            </div>
            <!-- Telefono -->
            <div class="row">
              <div class="col-md-4">
                <label for="email">Telefono:</label>
              </div>
              <div class="col-md-8">
                <input type="text" class="form-control" name="Telefono" id="Telefono" value="<?= $R['Telefono']; ?>" placeholder="Telefono">
                <span class="help-block" id="error"></span>
              </div>
            </div>
            <!-- Celular -->
            <div class="row">
              <div class="col-md-4">
                <label for="email">Celular:</label>
              </div>
              <div class="col-md-8">
                <input type="text" class="form-control" name="Celular" id="Celular" value="<?= $R['Celular']; ?>" placeholder="Celular">
                <span class="help-block" id="error"></span>
              </div>
            </div><br>
            <input type="hidden" name="Cliente" id="Cliente" value="<?= $R['Cliente'] ?>">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Guardar</button>
        </div>
        </form>
        </div>
      </body>
      <!-- LIBRERIAS validadoras-->
      <script src="../../css/assets/bootstrap/js/jquery.min.js"></script>
      <script src="../../css/assets/bootstrap/js/bootstrap.min.js"></script>
      <script src="../../css/assets/bootstrap/js/popper.min.js"></script>
      <script src="../../css/assets/bootstrap/js/custom.js"></script>
      <!-- Plugin para la validación de formularios -->
      <script src="../../css/assets/jquery_validation/dist/jquery.validate.min.js"></script>
      <script src="../../css/assets/jquery_validation/dist/localization/messages_es.js"></script>
      <!-- Plugin para listado, navegación y filtrado en tablas -->
      <script src="../../css/assets/footable/js/footable.min.js"></script>
      <script src="../../css/assets/footable/js/configTable.js"></script>
      <script>
        $(document).ready(function() {
          $("#frm").validate({
            rules: {
              Nombre: {
                required: true,
              },
              Apellido: {
                required: true,
              },
              Direccion: {
                required: true,
              },
              Telefono: {
                required: true,
                minlength: 7,
                maxlength: 10
              },
              Celular: {
                required: true,
                minlength: 7,
                maxlength: 10
              },
            }
          })
        });
      </script>

      </html>
<?php
    endwhile;
  } else {
    echo "No se encontraron registros con el ID " . $id;
  }
} catch (PDOException $e) {
  die("Error occurred:" . $e->getMessage());
}
?>