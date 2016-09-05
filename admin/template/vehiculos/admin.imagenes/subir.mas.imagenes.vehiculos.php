<?php

require '../../CRUD/clases/Generales.php';
require '../../CRUD/clases/CRUD.php';
require '../../CRUD/clases/Conexion.php';

$model = new Generales;
$model2 = new CRUD;


var_dump($_FILES["nombre_archivo_imagen_vehiculo_nuevos"]);
echo $_POST['id_vehiculo'];

$model->subir_varios_archivos('../../archiv/vehiculos/fotos/',$_FILES["nombre_archivo_imagen_vehiculo_nuevos"]);


for($i=0;$i<count($_FILES["nombre_archivo_imagen_vehiculo_nuevos"]["name"]);$i++){

  echo "- </br>".$_FILES["nombre_archivo_imagen_vehiculo_nuevos"]["name"][$i];
  $nombre_archivo_imagen_vehiculo_nuevos = time()."-".$_FILES["nombre_archivo_imagen_vehiculo_nuevos"]["name"][$i];
  $descripcion_imagen_vehiculo = $_FILES["nombre_archivo_imagen_vehiculo_nuevos"]["name"][$i];
  $vehiculo_id = $_POST['id_vehiculo'];
  $model2->insertInto = 'vehiculos_fotos';
  $model2->insertColumns = 'nombre_archivo_imagen_vehiculo,descripcion_imagen_vehiculo,vehiculo_id';
  $model2->insertValues = "'$nombre_archivo_imagen_vehiculo_nuevos','$descripcion_imagen_vehiculo',$vehiculo_id";
  $model2->Create();
  $mensaje = $model2->mensaje;

}


//header ("Location: ../ver.editar.vehiculo.php?id=".$vehiculo_id."&mensaje=actualizado");


echo '<script type="text/javascript">

window.location.assign("../ver.editar.vehiculo.php?id='.$vehiculo_id.'&mensaje=actualizado");
</script>';
?>