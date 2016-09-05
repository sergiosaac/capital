<?php

require '../CRUD/clases/Generales.php';
require '../CRUD/clases/CRUD.php';
require '../CRUD/clases/Conexion.php';

$id = (int)$_POST['id'];
$model = new CRUD;

//VEHICULO
//Elimina portada vehiculo
$model->select = '*';
$model->from = 'vehiculos';
$model->condition = "id=" . $id . "";
$model->Read();
$fila = $model->rows;
var_dump(json_encode(count($fila)));
unlink('../archiv/vehiculos/portadas/'.$fila[0]['foto_portada_vehiculo']);


//DEPENDIENTES

//Elimina dependientes archivos
$model = new CRUD;
$model->select = '*';
$model->from = 'vehiculos_fotos';
$model->condition = "vehiculo_id=" . $id . "";
$model->Read();
$filas = $model->rows;
foreach ($filas as $fila) {
  //echo $fila['nombre_archivo_imagen_vehiculo']." ------ ";  
  unlink('../archiv/vehiculos/fotos/'.$fila['nombre_archivo_imagen_vehiculo']);
}

//Elimina dependientes de la tabla
$model->deletefrom = "vehiculos_fotos";
$model->condition = 'vehiculo_id='.$id;
$model->Delete();
$mensaje = $model->mensaje;


//VEHICULO
//Elimina portada vehiculo
$model->select = '*';
$model->from = 'vehiculos';
$model->condition = "id=" . $id . "";
$model->Read();
$fila = $model->rows;
var_dump(json_encode(count($fila)));
//unlink('../archiv/vehiculos/portadas/'.$fila['foto_portada_vehiculo']);


$model->deletefrom = "vehiculos";
$model->condition = 'id='.$id;
$model->Delete();
$mensaje = $model->mensaje;

var_dump($mensaje." - ".$id);
