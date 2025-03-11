<?php
    require_once("controladores/Cminijuego.php");
    $objminijuego = new Cminijuego();
    $resultado = $objminijuego->cBorrarMinijuego();
    header("Location: ".$objminijuego->vista.".php");
?>
