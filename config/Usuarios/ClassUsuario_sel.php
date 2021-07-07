 <?php

  class Usuario extends DataBase
  {
    public $Idusuario;
    public $Nombre;
    public $estado;

    public function listarUsuario()
    {
      try {
        parent::Conexion();
        $sql = "SELECT * FROM todosistemas.usuario";
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
