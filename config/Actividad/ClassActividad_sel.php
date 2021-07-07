 <?php

  class Actividad extends DataBase
  {
    public $IdActividad;
    public $actividad;
    public $fechaAsignado;
    public $HoraAsignado;
    public $fechaRealizacion;
    public $horaRealizacion;
    public $diasRestraso;
    public $estado;
    public $asignado;

    public function listarActividad()
    {
      try {
        parent::Conexion();
        $sql = "SELECT * FROM todosistemas.actividadview";
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
