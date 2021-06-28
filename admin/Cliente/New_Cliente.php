<?php
session_start();
?>
<?php
//Conexión a la base de datos
require "../../config/General/connexion.php";
// Class
include "../../config/Cliente/ClassCliente_sel.php";
$Cliente = new Cliente();
$per    = $Cliente->listarCliente();
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
  <title>Cliente</title>
</head>

<body>
  <div class="container">
    <?php include "../../plantillas/menu/menu_admin.php"; ?>
    <div class="row">
      <div class="col-md-12">
        <h3 class="page-header"><span class="glyphicons glyphicons-group"></span> Cliente </h3>
        <ol class="breadcrumb">
          <li><a href="">Inicio</a></li>
          <li><a href="index.php">Cliente</a></li>
          <li class="active">Nuevo Cliente</li>
        </ol>
      </div>
    </div>
    <!-- Formulario -->
    <form method="post" autocomplete="on" id="frm" action="../../config/Cliente/ClassCliente_Ins.php">
      <!-- nombre -->
      <div class="row">
        <div class="col-md-4">
          <label for="email">Nombre:</label>
        </div>
        <div class="col-md-8">
          <input type="text" class="form-control" name="Nombre" rows="5" id="Nombre" placeholder="Nombre">
          <span class="help-block" id="error"></span>
        </div>
      </div>
      <!-- Apellido -->
      <div class="row">
        <div class="col-md-4">
          <label for="email">Apellido:</label>
        </div>
        <div class="col-md-8">
          <input type="text" class="form-control" name="Apellido" id="Apellido" placeholder="Apellido">
          <span class="help-block" id="error"></span>
        </div>
      </div>
      <!-- Direccion -->
      <div class="row">
        <div class="col-md-4">
          <label for="email">Direccion:</label>
        </div>
        <div class="col-md-8">
          <input type="text" class="form-control" name="Direccion" id="Direccion" placeholder="Direccion">
          <span class="help-block" id="error"></span>
        </div>
      </div>
      <!-- Telefono -->
      <div class="row">
        <div class="col-md-4">
          <label for="email">Telefono:</label>
        </div>
        <div class="col-md-8">
          <input type="text" class="form-control" name="Telefono" id="Telefono" placeholder="Telefono">
          <span class="help-block" id="error"></span>
        </div>
      </div>
      <!-- Celular -->
      <div class="row">
        <div class="col-md-4">
          <label for="email">Celular:</label>
        </div>
        <div class="col-md-8">
          <input type="text" class="form-control" name="Celular" id="Celular" placeholder="Celular">
          <span class="help-block" id="error"></span>
        </div>
      </div>
      <div><br>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Guardar</button>
      </div>
    </form>
  </div>
  <!-- LIBRERIAS validadoras-->
  <script src="../../css/assets/js/plugins/jquery/jquery-3.2.1.min.js"></script>
  <script src="../../css/assets/bootstrap/js/bootstrap.min.js"></script>
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
</body>

</html>