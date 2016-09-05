<?php
require '../../CRUD/clases/Generales.php';
require '../../CRUD/clases/CRUD.php';
require '../../CRUD/clases/Conexion.php';
echo "Entre aca";

exit();
$id = (int)$_POST['id'];
$nombre = $_POST['nombre'];



$model = new CRUD;
//VEHICULO
//Elimina portada vehiculo
unlink('../../archiv/inmuebles/fotos/'.$nombre);
$model->deletefrom = "inmuebles_fotos";
$model->condition = 'id='.$id;
$model->Delete();




?>