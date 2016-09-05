<?php



require '../CRUD/clases/CRUD.php';
require '../CRUD/clases/Conexion.php';

$id = $_POST['id'];
$precio_contado_inmueble = str_replace(".", "", $_POST['precio_contado_inmueble']);
$precio_financiado_inmueble = str_replace(".", "", $_POST['precio_financiado_inmueble']);
$cantidad_cuotas_inmueble = str_replace(".", "", $_POST['cantidad_cuotas_inmueble']);
$publicar_inmueble = str_replace(".", "", $_POST['publicar_inmueble']);
$direccion_inmueble = $_POST['direccion_inmueble'];
$ciudad_inmueble = $_POST['ciudad_inmueble'];
$area_mentros2_inmueble = str_replace(".", "", $_POST['area_mentros2_inmueble']);
$descripcion_corta_inmueble = $_POST['descripcion_corta_inmueble'];
$descripcion_larga_inmueble = $_POST['descripcion_larga_inmueble'];
$nombre_inmueble = $_POST['nombre_inmueble'];


$model = new CRUD;
$model->update = "inmuebles";
$model->set = "nombre_inmueble='$nombre_inmueble', direccion_inmueble='$direccion_inmueble',ciudad_inmueble='$ciudad_inmueble', area_mentros2_inmueble=$area_mentros2_inmueble, descripcion_corta_inmueble='$descripcion_corta_inmueble', descripcion_larga_inmueble='$descripcion_larga_inmueble',precio_contado_inmueble=$precio_contado_inmueble,publicar_inmueble=$publicar_inmueble,precio_financiado_inmueble=$precio_financiado_inmueble,cantidad_cuotas_inmueble=$cantidad_cuotas_inmueble";
$model->condition = "id = $id";
$model->Update();
$mensaje = $model->mensaje;
echo $mensaje;

//header ("Location: ver.editar.vehiculo.php?id=".$id."&mensaje=actualizado");


echo '<script type="text/javascript">

window.location.assign("ver.editar.inmuebles.php?id='.$id.'&mensaje=actualizado");
</script>';

?>