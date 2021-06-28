<?php
session_start();
//Conexión a la base de datos
require "../../config/General/connexion.php";
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
  <title>Factura</title>
</head>

<body>
  <div class="container">
    <?php include "../../plantillas/menu/menu_admin.php"; ?>
    <div class="row">
      <div class="col-md-12">
        <h3 class="page-header"><span class="glyphicons glyphicons-group"></span> Factura </h3>
        <ol class="breadcrumb">
          <li><a href="">Inicio</a></li>
          <li><a href="index.php">Factura</a></li>
          <li class="active">Nuevo Factura</li>
        </ol>
      </div>
    </div>
      <form action="../../config/Factura/ClassFactura_Ins.php" method="post">
        <!-- Vehiculo -->
        <?php
          include "../../config/Vehiculo/ClassVehiculo_sel.php";

          $usuario   = new Vehiculo();
          $Lista = $usuario->listarVehiculo();
        ?>
        <div class="row">
          <div class="col-md-12">
            <h3>Vehichulos</h3>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-search"></i>
              </span>
              <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
            </div>
            <table class="table table-bordered  table-hover table-striped" id="myTable" width="100%" name="myTable">
              <thead>
                <tr>
                  <th data-filterable="false">Nro</th>
                  <th data-breakpoints="xs sm">PlacaPlaca</th>
                  <th data-breakpoints="xs sm">AsitenteMarca</th>
                  <th data-breakpoints="xs sm">UsuarioModelo</th>
                  <th data-breakpoints="xs sm">Color</th>
                  <th data-breakpoints="xs sm" data-filterable="false">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $c = 1;
                foreach ($Lista as $book) :
                ?>
                  <tr>
                    <td><?= $c++; ?></td>
                    <td><?= $book->Placa; ?></td>
                    <td><?= $book->Marca; ?></td>
                    <td><?= $book->Modelo; ?></td>
                    <td><?= $book->Color; ?></td>
                    <td>
                      <input name="IdVehiculo" id="IdVehiculo" type="checkbox" value="<?= $book->IdVehiculo; ?>">
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- Cliente -->
        <?php
          include "../../config\Cliente/ClassCliente_sel.php";

          $Cliente   = new Cliente();
          $Lista = $Cliente->listarCliente();
        ?>
        <div class="row">
          <div class="col-md-12">
            <h3>Clientes</h3>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-search"></i>
              </span>
              <input type="text" class="form-control" id="myInput" onkeyup="myFunction2()" placeholder="Search for names.." title="Type in a name">
            </div>
            <table class="table table-bordered  table-hover table-striped" id="myTable" width="100%" name="myTable">
              <thead>
                <tr>
                  <th data-filterable="false">Nro</th>
                  <th data-breakpoints="xs sm">Nombre</th>
                  <th data-breakpoints="xs sm">Apellido</th>
                  <th data-breakpoints="xs sm">Direccion</th>
                  <th data-breakpoints="xs sm">Telefono</th>
                  <th data-breakpoints="xs sm">Celular</th>
                  <th data-breakpoints="xs sm" data-filterable="false">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $c = 1;
                foreach ($Lista as $libro) :
                ?>
                  <tr>
                    <td><?= $c++; ?></td>
                    <td><?= $libro->Nombre; ?></td>
                    <td><?= $libro->Apellido; ?></td>
                    <td><?= $libro->Direccion; ?></td>
                    <td><?= $libro->Telefono; ?></td>
                    <td><?php $libro->Celular;
                        ?></td>

                    <td>
                      <input type="checkbox" name="Idcliente" id="Idcliente" value="<?= $libro->IdCliente; ?>">
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
        <div><br>
          <button type="submit" class="btn btn-primary btn-lg btn-block">Facturar</button>
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
    function myFunction() {
      // Declare variables 
      var input, filter, table, tr, td, i, j, visible;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        visible = false;
        /* Obtenemos todas las celdas de la fila, no sólo la primera */
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
          if (td[j] && td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
            visible = true;
          }
        }
        if (visible === true) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
    function myFunction2() {
      // Declare variables 
      var input, filter, table, tr, td, i, j, visible;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        visible = false;
        /* Obtenemos todas las celdas de la fila, no sólo la primera */
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
          if (td[j] && td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
            visible = true;
          }
        }
        if (visible === true) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  </script>
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