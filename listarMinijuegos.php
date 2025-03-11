<?php
    require_once("controladores/Cminijuego.php");
    $objminijuego = new Cminijuego();
    $resultado = $objminijuego->cMostrarMinijuego();
    require_once("vistas/" . $objminijuego->vista . ".php");
?>