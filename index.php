<?php
date_default_timezone_set('America/Bogota');
session_start();

//Conexión a la base de datos
require "./config/General/connexion.php";

$Con = new DataBase();
$Conn = $Con->Conexion();
//Llamado a la clase
include "./config/Usuarios/ClassUsuario_sel.php";

$Usuario   = new Usuario();
$Lista = $Usuario->listarUsuario();


?>
<!DOCTYPE html>
<html lang="es" ng-app>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--Bootstrap núcleo CSS-->
  <link rel="stylesheet" media="screen" href="./css/assets/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" media="screen" href="./css/assets/bootstrap/css/bootstrap.min.css">
  <!--Biblioteca de iconos monocromáticos y símbolos-->
  <link rel="stylesheet" href="./css/assets/bootstrap/fonts/glyphicons-pro/css/glyphicons-pro.css">
  <link rel="stylesheet" href="./css/assets/bootstrap/fonts/font-awesome/css/font-awesome.min.css">
  <!--Paginación, filtrado de registros-->
  <link rel="stylesheet" href="./css/assets/footable/css/footable.bootstrap.min.css">
  <link rel="stylesheet" href="./css/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="./css/plugins/select2/select2-bootstrap.css">
  <title>Actividades</title>
</head>

<body>
  <div class="container">
    <?php include "./plantillas/menu/menu_admin.php"; ?>
    <div class="row">
      <div class="col-md-12">
        <h3 class="page-header"><span class="glyphicons glyphicons-group"></span> Actividad</h3>
        <ol class="breadcrumb">
          <li><a href="">Inicio</a></li>
          <li><a href="index.php">Actividades</a></li>
          <li class="active">Consultar Actividades</li>
        </ol>
      </div>
    </div>


    <div class="row">
      <div class="col-md-12">

        <form id="Usuario" name="Usuario" method="post" action="./">
          <div class="input-gruop">
            <div class="col-md-4">
              <select class="form-control select2" name="usuarios" id="usuarios">
                <option value="00"> -- Seleccione --</option>
                <?php
                foreach ($Lista as $list) :
                  ?>
                  <option value="<?=$list->Idusuario;?>"><?= $list->nombre; ?></option>
                  <?php
                endforeach;
                ?>
              </select>
            </div>
            <div class="col-md-4">
              <input type="submit" value="Consultar">
            </div>
            <div class="col-md-4"></div>
          </div>
        </form>
        <?php
          if($_POST != 0){
            try {
              $query = "SELECT * FROM todosistemas.actividadview WHERE usuarioAsignado = " . $_POST['usuarios'];
              $Resul = $Conn->prepare($query);
              $Resul->bindParam(':usuarios', $usuarios);
              $Resul->execute();
              $Resul->setFetchMode(PDO::FETCH_ASSOC);
              // $Resul->setFetchMode(PDO::FETCH_ASSOC);
              $Resultado = $Resul->rowCount();
              // Muestra si la consulta es diferente a cero
              if ($Resultado != 0) {
                ?>
                <br><br>
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
                      <th data-breakpoints="xs sm">Actividad</th>
                      <th data-breakpoints="xs sm">Fecha Asignado</th>
                      <th data-breakpoints="xs sm">Hora Asignado</th>
                      <th data-breakpoints="xs sm">Fecha Realización</th>
                      <th data-breakpoints="xs sm">Hora Realización</th>
                      <th data-breakpoints="xs sm">Días Restraso</th>
                      <th data-breakpoints="xs sm">estado</th>
                      <th data-breakpoints="xs sm">Asignado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Contado para no mostrar el Id
                    $c = 1;
                    // Imprime los datos de la consulta con un ciclo
                    while ($R = $Resul->fetch()) :
                      ?>
                      <tr>
                        <td><?= $c++; ?></td>
                        <td><?= $R["actividad"]; ?></td>
                        <td><?= $R["fechaAsignado"]; ?></td>
                        <td><?= $R["HoraAsignado"]; ?></td>
                        <td><?= $R["fechaRealizacion"]; ?></td>
                        <td><?= $R["horaRealizacion"];?></td>
                        <td><?= $R["diasRetraso"]; ?></td>
                        <td><?= $R["estado"];?></td>
                        <td><?= $R["asignado"];?></td>

                      </tr>
                      <?php 
                    endwhile;
                    ?>
                  </tbody>
                </table>
                <?php
              } else {
                echo "No se encontraron registros de ese usuario ";
              }
            } catch (PDOException $e) {
              die("Error occurred:" . $e->getMessage());
            }
          }else{
            ?>
            <h1>Por favor seleccione un campo valido</h1>
            <?php
          }
        ?>
          
      </div>
    </div>
  </div>

  <script src="./css/assets/bootstrap/js/jquery.min.js"></script>
  <script src="./css/assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="./css/assets/bootstrap/js/popper.min.js"></script>
  <script src="./css/assets/bootstrap/js/custom.js"></script>
  <script src="./css/assets/footable/js/footable.min.js"></script>
  <script src="./css/assets/footable/js/configTable.js"></script>
  <script src="./js/plugins/select2/select2.full.js"></script>
  <script src="./js/plugins/select2/es.js"></script>
  <script>
    // script para el select2
    $(document).ready(function() {
      $(".select2").select2({
        language: "es"
      });
   });
    //  función para buscar datos
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