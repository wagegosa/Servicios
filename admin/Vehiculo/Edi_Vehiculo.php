<?php
// echo "<pre>";
// print_r($_GET);
// echo "</pre>";
// die;
session_start();
//Conexión a la base de datos
require "../../config/General/connexion.php";

$Con = new DataBase();
$Conn = $Con->Conexion();

$_GET['id'] ? $_GET['id'] : '';

try {
  $query = "SELECT * FROM Servicios.Vehiculo WHERE IdVehiculo = " . $_GET['id'];
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
        <!-- Plugin para cuadro de selección personalizable con soporte para búsqueda. -->
        <link rel="stylesheet" href="../../css/plugins/select2/select2.min.css">
        <link rel="stylesheet" href="../../css/plugins/select2/select2-bootstrap.css">
        <title>Vehiculo</title>
      </head>

      <body>
        <div class="container">
          <?php include "../../plantillas/menu/menu_admin.php"; ?>
          <?php if ($_GET != null) { ?>
            <div class="alert alert-success"><?php echo isset($alert) ? $alert : ''; ?></div>
          <?php } ?>
          <div class="row">
            <div class="col-md-12">
              <h3 class="page-header"><span class="glyphicons glyphicons-group"></span> Vehiculo</h3>
              <ol class="breadcrumb">
                <li><a href="">Inicio</a></li>
                <li><a href="">Vehiculo</a></li>
                <li class="active">Nuevo Vehiculo</li>
              </ol>
            </div>
          </div>
          <!-- Formulario -->
          <form method="post" autocomplete="on" id="frm" action="../../config/Vehiculo/ClassVehiculo_upd.php">
            <!-- Placa -->
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                <label for="Nombre">Placa:</label>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                <input type="text" class="form-control" name="Placa" rows="5" id="Placa" minlength="1" maxlength="6" value="<?= $R['Placa']; ?>" placeholder="Placa">
                <span class="help-block" id="error"></span>
              </div>
            </div>
            <!-- Marca -->
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                <label for="Hora">Marca</label>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                <input type="text" class="form-control" name="Marca" id="Marca" value="<?= $R['Marca']; ?>" placeholder="Marca">
                <span class="help-block" id="error"></span>
              </div>
            </div>
            <!-- Modelo -->
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                <label for="email">Modelo:</label>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                <input type="text" class="form-control" name="Modelo" id="Modelo" value="<?= $R['Modelo']; ?>" placeholder="Modelo">
                <span class="help-block" id="error"></span>
              </div>
            </div>
            <!-- Color -->
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                <label for="email">Color:</label>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                <input type="text" class="form-control" name="Color" id="Color" value="<?= $R['Color']; ?>" placeholder="Color">
                <span class="help-block" id="error"></span>
              </div>
            </div>
            <div><br>
              <button type="submit" class="btn btn-primary btn-lg btn-block">Guardar</button>
            </div>
          </form>
          <!-- LIBRERIAS validadoras-->
          <script src="../../css/assets/js/plugins/jquery/jquery-3.2.1.min.js"></script>
          <script src="../../css/assets/bootstrap/js/bootstrap.min.js"></script>
          <!-- Plugin para la validación de formularios -->
          <script src="../../css/assets/jquery_validation/dist/jquery.validate.min.js"></script>
          <script src="../../css/assets/jquery_validation/dist/localization/messages_es.js"></script>
          <!-- Plugin para listado, navegación y filtrado en tablas -->
          <script src="../../css/assets/footable/js/footable.min.js"></script>
          <script src="../../css/assets/footable/js/configTable.js"></script>
          <!-- Plugin para cuadro de selección personalizable con soporte para búsqueda. -->
          <script src="../../js/plugins/select2/select2.full.js"></script>
          <script src="../../js/plugins/select2/es.js"></script>
          <script>
            $(document).ready(function() {
              $("#frm").validate({
                rules: {
                  Placa: {
                    required: true,
                  },
                  Marca: {
                    required: true,
                  },
                  Modelo: {
                    required: true,
                  },
                  Color: {
                    required: true,
                  },
                }
              })
            });
          </script>
      </body>

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