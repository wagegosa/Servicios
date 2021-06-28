<?php
session_start();
//Conexión a la base de datos
include "../../config/General/connexion.php";
// Class
// include "../../config/Cliente/ClassCliente_upd.php";

$Con = new DataBase();
$Conn = $Con->Conexion();
// $Cliente = new Cliente();
// $per    = $Cliente->listarCliente();

$_GET['id'] ? $_GET['id'] : '';

try {
  $query = "SELECT 
                    A.Idfactura,
                    A.Idcliente,
                    B.Nombre,
                    B.Apellido,
                    A.IdVehiculo,
                    C.Placa,
                    A.FechaRegistro,
                    A.Idestado
               FROM servicios.factura A
         INNER JOIN servicios.cliente B ON(A.Idcliente = B.IdCliente)
         INNER JOIN servicios.vehiculo C ON (A.IdVehiculo = C.IdVehiculo)
              WHERE A.Idfactura = " . $_GET['id'];
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
          <form method="post" autocomplete="on" id="frm" action="../../config/Factura/ClassFactura_upd.php">
            <!-- nombre -->
            <div class="row">
              <div class="col-md-4">
                <label for="email">Nombre:</label>
              </div>
              <div class="col-md-8">
                <input type="text" class="form-control" name="Cliente" rows="5" id="Cliente" value="<?= $R['Nombre']; ?>" readonly placeholder="Nombre">
                <span class="help-block" id="error"></span>
              </div>
            </div>
            <!-- Apellido -->
            <div class="row">
              <div class="col-md-4">
                <label for="email">Apellido:</label>
              </div>
              <div class="col-md-8">
                <input type="text" class="form-control" name="Apellido" id="Apellido" value="<?= $R['Apellido']; ?>" readonly placeholder="Apellido">
                <span class="help-block" id="error"></span>
              </div>
            </div>
            <!-- Placa -->
            <div class="row">
              <div class="col-md-4">
                <label for="email">Placa:</label>
              </div>
              <div class="col-md-8">
                <input type="text" class="form-control" name="Placa" id="Placa" value="<?= $R['Placa']; ?>" readonly placeholder="Placa">
                <span class="help-block" id="error"></span>
              </div>
            </div>
            <!-- FechaRegistro -->
            <div class="row">
              <div class="col-md-4">
                <label for="email">FechaRegistro:</label>
              </div>
              <div class="col-md-8">
                <input type="text" class="form-control" name="FechaRegistro" id="FechaRegistro" value="<?= $R['FechaRegistro']; ?>" readonly placeholder="FechaRegistro">
                <span class="help-block" id="error"></span>
              </div>
            </div>
            <!-- Idestado -->
            <div class="row">
              <div class="col-md-4">
                <label for="email">Idestado:</label>
              </div>
              <div class="col-md-8">
                <input type="radio" name="Idestado" id="Idestado" value="Pagado" checked="<?php if(!$R['Idestado']){ echo "checked";}; ?>"> Activo
                <input type="radio" name="Idestado" id="Idestado" value="Sin Pagar"> Incativo   
                <span class="help-block" id="error"></span>
              </div>
            </div><br>
            <input type="hidden" name="Idfactura" id="Idfactura" value="<?= $R['Idfactura'] ?>">
            <input type="hidden" name="Idcliente" id="Idcliente" value="<?= $R['Idcliente'] ?>">
            <input type="hidden" name="IdVehiculo" id="IdVehiculo" value="<?= $R['IdVehiculo'] ?>">
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