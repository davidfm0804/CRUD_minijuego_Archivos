<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Minijuegos</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
    <a href="./formulario_alta.php" class="alta">Añadir minijuego</a>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Numero de Etapas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($resultado as $minijuego){
                    echo '<tr>';
                    echo '<td>'.$minijuego['nombre'].'</td>';
                    echo '<td><img src="'.$minijuego['imagen'].'" alt="'.$minijuego['nombre'].'" style="max-width: 100px; height: auto;"></td>';
                    echo '<td>'.$minijuego['num_etapas'].'</td>';
                    echo '<td>';
                    echo '<a href="./formulario_modificar.php?id='.$minijuego['idjuego'].'" class="modificar">Modificar</a>';
                    echo '<a href="./borrar_minijuego.php?id='.$minijuego['idjuego'].'" class="borrar">Borrar</a>';
                    echo '</td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>
</body>
</html>