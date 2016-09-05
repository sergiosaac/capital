<?php

require '../CRUD/clases/CRUD.php';
require '../CRUD/clases/Conexion.php';

$id = $_POST['id'];
$titulo_vehiculo = $_POST['titulo_vehiculo'];
$modelo_vehiculo = $_POST['modelo_vehiculo'];
$marca_vehiculo = $_POST['marca_vehiculo'];
$anho_vehiculo = $_POST['anho_vehiculo'];	
$color_vehiculo = $_POST['color_vehiculo'];	
$descripcion_corta_vehiculo = $_POST['descripcion_corta_vehiculo'];
$descripcion_larga_vehiculo = $_POST['descripcion_larga_vehiculo'];
$tipo_vehiculo_vehiculo = $_POST['tipo_vehiculo_vehiculo'];
$precio_contado_vehiculo = str_replace(".", "", $_POST['precio_contado_vehiculo']);
$precio_financiado_vehiculo = str_replace(".", "", $_POST['precio_financiado_vehiculo']);
$cantidad_cuotas_vehiculo = $_POST['cantidad_cuotas_vehiculo'];
$publicar_vehiculo = $_POST['publicar_vehiculo'];
/*
echo "<strong>".$id."</strong><br/>"; 
echo $titulo_vehiculo."<br/>";
echo $modelo_vehiculo."<br/>";
echo $marca_vehiculo."<br/>";
echo $anho_vehiculo."<br/>";
echo $color_vehiculo."<br/>";
echo $descripcion_corta_vehiculo."<br/>";
echo $descripcion_larga_vehiculo."<br/>";
echo $tipo_vehiculo_vehiculo."<br/>";
echo $precio_contado_vehiculo."<br/>";
echo $precio_financiado_vehiculo."<br/>";
echo $cantidad_cuotas_vehiculo."<br/>";
echo $publicar_vehiculo;*/


$model = new CRUD;
$model->update = "vehiculos";
$model->set = "titulo_vehiculo='$titulo_vehiculo', modelo_vehiculo='$modelo_vehiculo', marca_vehiculo='$marca_vehiculo', anho_vehiculo=$anho_vehiculo, color_vehiculo='$color_vehiculo', descripcion_corta_vehiculo='$descripcion_corta_vehiculo', descripcion_larga_vehiculo='$descripcion_larga_vehiculo', tipo_vehiculo_vehiculo='$tipo_vehiculo_vehiculo', precio_contado_vehiculo=$precio_contado_vehiculo, publicar_vehiculo=$publicar_vehiculo, precio_financiado_vehiculo=$precio_financiado_vehiculo, cantidad_cuotas_vehiculo=$cantidad_cuotas_vehiculo ";
$model->condition = "id = $id";
$model->Update();
$mensaje = $model->mensaje;
echo $mensaje;

header ("Location: ver.editar.vehiculo.php?id=".$id."&mensaje=actualizado");


echo '<script type="text/javascript">

window.location.assign("ver.editar.vehiculo.php?id='.$id.'&mensaje=actualizado");
</script>';

?>