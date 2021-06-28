 <?php

  class Factura extends DataBase
  {
    public $FactIdfacturaura;
    public $Nombre;
    public $Apellido;
    public $Placa;
    public $FechaRegistro;
    public $Idestado;

    public function listarFactura()
    {
      try {
        parent::Conexion();
        $sql = "SELECT 
                      A.Idfactura,
                      B.Nombre,
                      B.Apellido,
                      C.Placa,
                      A.FechaRegistro,
                      A.Idestado
                FROM servicios.factura A
                INNER JOIN servicios.cliente B ON(A.Idcliente = B.IdCliente)
                INNER JOIN servicios.vehiculo C ON (A.IdVehiculo = C.IdVehiculo)";
        $qry = $this->dbCon->prepare($sql);
        $qry->execute();
        $row = $qry->fetchAll(PDO::FETCH_OBJ);
        $qry->closeCursor();
        return $row;
        $this->dbCon = null;
      } catch (PDOException $e) {
        die("Ha ocurrido un error inesperado en la base de datos.<br>" . $e->getMessage());
      }
    }
  }

  ?>
