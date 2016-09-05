<?php

require '../CRUD/clases/Generales.php';
require '../CRUD/clases/CRUD.php';
require '../CRUD/clases/Conexion.php';

$id = (int)$_POST['id'];
$model = new CRUD;

//VEHICULO
//Elimina portada vehiculo
$model->select = '*';
$model->from = 'inmuebles';
$model->condition = "id=" . $id . "";
$model->Read();
$fila = $model->rows;
var_dump(json_encode(count($fila)));
unlink('../archiv/inmuebles/portadas/'.$fila[0]['foto_portada_inmueble']);


//DEPENDIENTES

//Elimina dependientes archivos
$model = new CRUD;
$model->select = '*';
$model->from = 'inmuebles_fotos';
$model->condition = "inmueble_id=" . $id . "";
$model->Read();
$filas = $model->rows;
foreach ($filas as $fila) {
  //echo $fila['nombre_archivo_imagen_vehiculo']." ------ ";  
  unlink('../archiv/inmuebles/fotos/'.$fila['nombre_archivo_imagen_inmueble']);
}

//Elimina dependientes de la tabla
$model->deletefrom = "inmuebles_fotos";
$model->condition = 'inmueble_id='.$id;
$model->Delete();
$mensaje = $model->mensaje;


//VEHICULO
//Elimina portada vehiculo
$model->select = '*';
$model->from = 'inmuebles';
$model->condition = "id=" . $id . "";
$model->Read();
$fila = $model->rows;
var_dump(json_encode(count($fila)));
//unlink('../archiv/vehiculos/portadas/'.$fila['foto_portada_vehiculo']);


$model->deletefrom = "inmuebles";
$model->condition = 'id='.$id;
$model->Delete();
$mensaje = $model->mensaje;

var_dump($mensaje." - ".$id);
