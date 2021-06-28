<?php
session_start();

//Conexión a la base de datos
require "../../config/General/connexion.php";
//Llamado a la clase
include "../../config\Cliente/ClassCliente_sel.php";

$Cliente   = new Cliente();
$Lista = $Cliente->listarCliente();


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
  <title>Clientes</title>
</head>

<body>
  <div class="container">
    <?php include "../../plantillas/menu/menu_admin.php"; ?>
    <div class="row">
      <div class="col-md-12">
        <h3 class="page-header"><span class="glyphicons glyphicons-group"></span> Cliente</h3>
        <ol class="breadcrumb">
          <li><a href="">Inicio</a></li>
          <li><a href="index.php">Clientes</a></li>
          <li class="active">Consultar Clientes</li>
        </ol>
        <div class="pull-right">
          <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <a href="New_Cliente.php" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Nuevo Cliente </a>
          </form>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-md-12">
        <form id="Con_Area" name="Con_Area" method="post">
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
                    <!-- <a href="Edi_Cliente.php?id=" class="btn"></a> -->
                    <a href="Edi_Cliente.php?id=<?= $libro->IdCliente; ?>" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>

  <script src="../../css/assets/bootstrap/js/jquery.min.js"></script>
  <script src="../../css/assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="../../css/assets/bootstrap/js/popper.min.js"></script>
  <script src="../../css/assets/bootstrap/js/custom.js"></script>
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
  </script>

</body>

</html>