<?php
require '../../CRUD/clases/Generales.php';
require '../../CRUD/clases/CRUD.php';
require '../../CRUD/clases/Conexion.php';

$model = new Generales;
$consultas = new CRUD;

$id = $_POST['id_foto'];
$archivo_nuevo_nombre = time()."-".$_FILES["foto_portada_vehiculo_nuevo"]["name"];

//Borrar archivo anterior
$consultas = new CRUD;
$consultas->select = '*';
$consultas->from = 'vehiculos';
$consultas->condition = "id=" . $id . "";
$consultas->Read();
$fila = $consultas->rows;
var_dump($fila[0]['foto_portada_vehiculo']);
unlink('../../archiv/vehiculos/portadas/'.$fila[0]['foto_portada_vehiculo']);


$model->subir_archivo('../../archiv/vehiculos/portadas/',$_FILES["foto_portada_vehiculo_nuevo"]);

$consultas->update = "vehiculos";
$consultas->condition = "id = $id";
$consultas->set = "foto_portada_vehiculo='$archivo_nuevo_nombre'";
$consultas->Update();
$mensaje = $consultas->mensaje;

//header ("Location: ../ver.editar.vehiculo.php?id=".$id."&mensaje=actualizado");

echo '<script type="text/javascript">

window.location.assign("../ver.editar.vehiculo.php?id='.$id.'&mensaje=actualizado");
</script>';