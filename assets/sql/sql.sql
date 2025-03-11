SELECT minijuegos.idjuego,minijuegos.idambito, minijuegos.num_etapas, minijuegos.nombre,ambito.nombre
FROM minijuegos INNER JOIN ambito ON minijuegos.idambito=ambito.idambito
WHERE minijuegos.idjuego=52