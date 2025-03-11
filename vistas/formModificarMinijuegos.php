<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formModificarMinijuego</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
    <h1>Datos del Minijuego</h1>
    <?php
    list($minijuego, $ambitos) = $resultado;// Extraer valores del array retornado
    // echo $_SESSION['idjuego'];
    ?>
    <form action="./modificar_minijuego.php" method="POST" enctype="multipart/form-data" >
        <input type="text" name="nombre" value="<?php echo $minijuego['mNombre']?>"><br>
        <select name="ambitos">
            <?php
            echo '<option value="'.$minijuego['idambito'].'">'.$minijuego['aNombre'].'</option>';
            foreach ($ambitos as $ambito) {
                echo '<option value="'.$ambito['idambito'].'">'.$ambito['nombre'].'</option>';
            }
            ?>
        </select><br>
        <input type="checkbox" value="1" name="etapas[]">
        <label for="Eso">ESO</label><br>
        <input type="checkbox" value="2" name="etapas[]">
        <label for="Bachillerato">Bachillerato</label><br>
        <input type="checkbox" value="3" name="etapas[]">
        <label for="Ciclos">Ciclos</label>
        <input type="file" name="imagen"><br>
        <input type="submit" value="Enviar">
        <a href="./listarMinijuegos.php">Volver</a>
    </form>
</body>
</html>