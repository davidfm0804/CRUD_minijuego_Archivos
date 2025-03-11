<?php
    require_once("controladores/Cminijuego.php");
    $objminijuego = new Cminijuego();
    $resultado = $objminijuego->cModificarMinijuego();
    header("Location: ".$objminijuego->vista.".php");
?>
