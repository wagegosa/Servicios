 <?php

  class Cliente extends DataBase
  {
    public $IdCliente;
    public $nombNombrere;
    public $Apellido;
    public $Direccion;
    public $Telefono;
    public $Celular;

    public function listarCliente()
    {
      try {
        parent::Conexion();
        $sql = "SELECT * FROM Servicios.Cliente";
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
