<?php

require '../../CRUD/clases/Generales.php';
require '../../CRUD/clases/CRUD.php';
require '../../CRUD/clases/Conexion.php';

$model = new Generales;
$model2 = new CRUD;


var_dump($_FILES["nombre_archivo_imagen_inmueble_nuevos"]);
echo $_POST['id_inmueble'];

$model->subir_varios_archivos('../../archiv/inmuebles/fotos/',$_FILES["nombre_archivo_imagen_inmueble_nuevos"]);


for($i=0;$i<count($_FILES["nombre_archivo_imagen_inmueble_nuevos"]["name"]);$i++){

  echo "- </br>".$_FILES["nombre_archivo_imagen_inmueble_nuevos"]["name"][$i];
  $nombre_archivo_imagen_inmueble_nuevos = time()."-".$_FILES["nombre_archivo_imagen_inmueble_nuevos"]["name"][$i];
  $descripcion_imagen_inmueble = $_FILES["nombre_archivo_imagen_inmueble_nuevos"]["name"][$i];
  $inmueble_id = $_POST['id_inmueble'];
  $model2->insertInto = 'inmuebles_fotos';
  $model2->insertColumns = 'nombre_archivo_imagen_inmueble,descripcion_imagen_inmueble,inmueble_id';
  $model2->insertValues = "'$nombre_archivo_imagen_inmueble_nuevos','$descripcion_imagen_inmueble',$inmueble_id";
  $model2->Create();
  $mensaje = $model2->mensaje;

}


//header ("Location: ../ver.editar.vehiculo.php?id=".$vehiculo_id."&mensaje=actualizado");


echo '<script type="text/javascript">

window.location.assign("../ver.editar.inmuebles.php?id='.$inmueble_id.'&mensaje=actualizado");
</script>';
?>