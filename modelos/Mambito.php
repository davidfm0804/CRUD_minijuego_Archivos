<?php
Class Mambito {
    private $conexion;

    public function __construct() {
        require_once("config/config.php");
        $this->conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);

        // Verifica la conexión
        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
    }

    public function mMostrarAmbitos() {
        $SQL = "SELECT * FROM ambito";
        $stmt = $this->conexion->prepare($SQL);
        $stmt->execute();
        $datos = $stmt->get_result();

        $resultado = [];
        while ($fila = $datos->fetch_assoc()) {
            $resultado[] = [
                "idambito" => $fila['idambito'],
                "nombre" => $fila['nombre']
            ];
        }
        return $resultado;
    }
}
?>