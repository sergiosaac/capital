<?php

require 'Generales.php';

$objeto = new CRUD;  
switch ($opcion) {
    case "vehiculo":
        $objeto->subir_archivo($ubicacion,$archivo);
        break;
    case "inmueble":
        echo "Your favorite color is blue!";
        break;
    default:
        echo "Salir";
}