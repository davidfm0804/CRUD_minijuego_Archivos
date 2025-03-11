<?php
Class Cambito {
    private $objambito;
    public $vista;

    public function __construct() {
        require_once("modelos/Mambito.php");
        $this->objambito = new Mambito();
    }

    public function cMostrarAmbitosAlta() {
        $this->vista = 'formAltaMinijuego';
        $resultado = $this->objambito->mMostrarAmbitos();
        if (is_array($resultado)) {
            return $resultado;
        }
    }
}
?>