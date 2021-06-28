 <?php

  class Vehiculo extends DataBase
  {
    public $IdVehiculo;
    public $Placa;
    public $Marca;
    public $Modelo;
    public $Color;

    public function listarVehiculo()
    {
      try {
        parent::Conexion();
        $sql = "SELECT * FROM Servicios.Vehiculo";
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
