<?php
Class Mminijuego{
    private $conexion;

    public function __construct()
    {
        require_once("config/config.php");
        $this->conexion = new mysqli(SERVIDOR,USUARIO,PASSWORD,BBDD);
    }
    public function mMostrarMinijuego(){
        $SQL="SELECT minijuegos.idjuego, minijuegos.nombre,minijuegos.idambito,minijuegos.num_etapas,minijuegos.imagen,ambito.nombre as Anombre
        FROM minijuegos inner join ambito on minijuegos.idambito=ambito.idambito";
        $stmt = $this->conexion->prepare($SQL);
        $stmt->execute();
        $datos = $stmt->get_result();

        $resultado = [];
        while ($fila = $datos->fetch_assoc()) {
            $resultado[] = [
                "idjuego" => $fila['idjuego'],
                "nombre" => $fila['nombre'],
                "idambito" => $fila['idambito'],
                "num_etapas" => $fila['num_etapas'],
                "imagen" => $fila['imagen'],
                "Anombre" => $fila['Anombre']
            ];
         }
        return $resultado;
    }
    public function mInsertarMinijuego($nombre, $idambito, $numetapas, $imagen){
        $SQL="INSERT INTO minijuegos (nombre, idambito, num_etapas, imagen) VALUES(?, ?, ?, ?)";
        $stmt= $this->conexion->prepare($SQL);
        $stmt->bind_param("siis", $nombre, $idambito, $numetapas, $imagen);
        try{
            $stmt->execute();
            return true;
        }catch(mysqli_sql_exception $e){
            if($e->getCode()=="1062"){
                return "csu";
            }
           return false;
        }
        return false;
    }
    public function mModificarMinijuego($nombre, $idambito, $numetapas, $imagen){
        $SQL="UPDATE minijuegos SET nombre=?, idambito=?, num_etapas=?, imagen=? WHERE idjuego=?";
        $stmt= $this->conexion->prepare($SQL);
        $stmt->bind_param("siisi", $nombre, $idambito, $numetapas, $imagen,$_SESSION['idjuego']);
        try{
            $stmt->execute();
            return true;
        }catch(mysqli_sql_exception $e){
            if($e->getCode()=="1062"){
                return "csu";
            }
           return false;
        }
        return false;
    }
    public function mObtenerMinijuego($id) {
        $SQL="SELECT * FROM minijuegos WHERE idjuego=?";
        $stmt= $this->conexion->prepare($SQL);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
        return $resultado;
    }
    public function mBorrarMinijuego($id) {
        $SQL="DELETE FROM minijuegos WHERE idjuego=?";
        $stmt= $this->conexion->prepare($SQL);
        $stmt->bind_param("i", $id);
        try{
            $stmt->execute();
            return true;
        }catch(mysqli_sql_exception $e){
            return false;
        }
    }
    public function mObtenerMinijuegoModificar($id){
        $SQL="SELECT minijuegos.idjuego,minijuegos.idambito, minijuegos.num_etapas,minijuegos.imagen, minijuegos.nombre as mNombre,ambito.nombre as aNombre
            FROM minijuegos INNER JOIN ambito ON minijuegos.idambito=ambito.idambito
            WHERE minijuegos.idjuego=?";
        $stmt= $this->conexion->prepare($SQL);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
        return $resultado;
    }
}
?>