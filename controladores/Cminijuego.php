<?php
class Cminijuego {
    private $objminijuego;
    public $vista;
    public function __construct() {
        require_once("modelos/Mminijuego.php");
        require_once("modelos/Mambito.php");
        $this->objminijuego = new Mminijuego();
        $this->objambito = new Mambito();
    }
    public function cMostrarMinijuego() {
        $this->vista = 'mostrarMinijuegos';
        $resultado = $this->objminijuego->mMostrarMinijuego();
        if (is_array($resultado)) {
            return $resultado;
        }
    }
    public function cInsertarMinijuego() {
        $this->vista = 'listarMinijuegos';
        if (empty($_POST['nombre']) || !isset($_POST['ambitos']) || !isset($_POST['etapas']) || empty($_FILES['imagen']['name'])) {
            return "Faltan datos obligatorios";
        }
        $nombre = $_POST['nombre'];
        $idambito = $_POST['ambitos'];
        $etapas = $_POST['etapas'];
        $imagen = $_FILES['imagen'];
        $numetapas = count($etapas);

        $tipos = ['image/png', 'image/jpeg', 'image/gif','image/webp'];
        if (!in_array($imagen['type'], $tipos)) {
            return 'Formato de imagen no permitido. Solo se permiten PNG, JPG, GIF,y WebP.';
        }
        // Subir la imagen
        $target_dir = "assets/img/";
        $target_file = $target_dir . basename($imagen["name"]);
        if (!move_uploaded_file($imagen["tmp_name"], $target_file)) {
            return 'Error al subir la imagen';
        }
        $resultado = $this->objminijuego->mInsertarMinijuego($nombre, $idambito, $numetapas, $target_file);

        if ($resultado === "csu") {
            return 'Nombre Duplicado';
        }
        
        if ($resultado === true) {
            return 'Insercion correcta';
        }

        return 'Error al insertar el minijuego';
    }
    public function cMostrarMinijuegoModificar(){
        session_start();
        $this->vista = 'formModificarMinijuegos';
        if (!isset($_GET['id'])) {
            return "Faltan datos obligatorios";
        }

        $_SESSION['idjuego'] = $_GET['id'];
        $idjuego = $_GET['id'];
      
        $minijuego = $this->objminijuego->mObtenerMinijuegoModificar($idjuego);
        $ambitos = $this->objambito->mMostrarAmbitos();
        return [$minijuego, $ambitos];

    }
    public function cModificarMinijuego(){
        session_start();
        $this->vista = 'listarMinijuegos';
    
        if (empty($_POST['nombre']) || !isset($_POST['ambitos']) || !isset($_POST['etapas'])) {
            return "Faltan datos obligatorios";
        }
    
        $nombre = $_POST['nombre'];
        $idambito =$_POST['ambitos'];
        $imagen = $_FILES['imagen'];
        $etapas = $_POST['etapas'];
        $numetapas = count($etapas);
        $idjuego = $_SESSION['idjuego'];

       
        $minijuego = $this->objminijuego->mObtenerMinijuego($idjuego);
        if (!$minijuego) {
            return 'Minijuego no encontrado';
        }
        
        if(!empty($imagen['name'])){
            $tipos = ['image/png', 'image/jpeg', 'image/gif','image/webp'];
            if (!in_array($imagen['type'], $tipos)) {
                return 'Formato de imagen no permitido. Solo se permiten PNG, JPG, GIF,y WebP.';
            }
            
            $imagenRuta = $minijuego['imagen'];
            if (file_exists($imagenRuta)) {
                unlink($imagenRuta);
            }
            $target_dir = "assets/img/";
            $target_file = $target_dir . basename($imagen["name"]);
            if (!move_uploaded_file($imagen["tmp_name"], $target_file)) {
                return 'Error al subir la imagen';
            }
        }else{
            $target_file = $minijuego['imagen'];
        }

        $resultado = $this->objminijuego->mModificarMinijuego($nombre, $idambito, $numetapas, $target_file);
    
        if ($resultado === "csu") {
            return 'Nombre Duplicado';
        }
    
        if ($resultado === true) {
            return 'Modificación correcta';
        }
    
        return 'Error al modificar el minijuego';
    }
    
    
    public function cBorrarMinijuego(){
        $this->vista = 'listarMinijuegos';
        if (!isset($_GET['id'])) {
            return "Faltan datos obligatorios";
        }
        $idjuego = $_GET['id'];
        $minijuego = $this->objminijuego->mObtenerMinijuego($idjuego);
        if (!$minijuego) {
            return 'Minijuego no encontrado';
        }

        // Eliminar la imagen del sistema de archivos
        $imagen = $minijuego['imagen'];
        if (file_exists($imagen)) {
            unlink($imagen);
        }

        $resultado = $this->objminijuego->mBorrarMinijuego($idjuego);
        if ($resultado === true) {
            return 'Borrado correcto';
        }
        return 'Error al borrar el minijuego';
    }
}
?>