<?php
require '../../CRUD/clases/Generales.php';
require '../../CRUD/clases/CRUD.php';
require '../../CRUD/clases/Conexion.php';

$id = (int)$_POST['id'];
$nombre = $_POST['nombre'];
$model = new CRUD;
//VEHICULO
//Elimina portada vehiculo
unlink('../../archiv/vehiculos/fotos/'.$nombre);
$model->deletefrom = "vehiculos_fotos";
$model->condition = 'id='.$id;
$model->Delete();
$mensaje = $model->mensaje;
var_dump($mensaje);


?>