<?php
    require_once("controladores/Cminijuego.php");
    $objminijuego = new Cminijuego();
    $resultado = $objminijuego->cInsertarMinijuego();
    header("Location: ".$objminijuego->vista.".php");
?>
