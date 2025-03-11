<?php
    require_once("controladores/Cminijuego.php");
    $objminijuego = new Cminijuego();
    $resultado = $objminijuego->cMostrarMinijuegoModificar();
    require_once("vistas/" . $objminijuego->vista . ".php");
?>

<?php
    // require_once("controladores/Cambito.php");
    // $objambito = new Cambito();
    // $resultado = $objambito->cMostrarAmbitoModificar();
    // require_once("vistas/" . $objambito->vista . ".php");
?>