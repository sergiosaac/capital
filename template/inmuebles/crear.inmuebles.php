<?php

//Si el array no tiene 14 datos no pasa nada
/*
$validaddor = array($titulo_vehiculo,$foto_portada_vehiculo,$modelo_vehiculo,$marca_vehiculo,$anho_vehiculo,$color_vehiculo,$descripcion_corta_vehiculo,$descripcion_larga_vehiculo
                   ,$tipo_vehiculo_vehiculo,$precio_contado_vehiculo,$precio_financiado_vehiculo,$cantidad_cuotas_vehiculo,$publicar_vehiculo);

*/


/*


nombre_inmueble
foto_portada_inmueble
direccion_inmueble
ciudad_inmueble
area_mentros2_inmueble
descripcion_corta_inmueble
descripcion_larga_inmueble
nombre_archivo_imagen_inmueble
precio_contado_inmueble
precio_financiado_inmueble
cantidad_cuotas_inmueble
publicar_inmueble
*/

require '../CRUD/clases/Generales.php';
require '../CRUD/clases/CRUD.php';
require '../CRUD/clases/Conexion.php';

$model = new Generales;

$model->subir_archivo('../archiv/inmuebles/portadas/',$_FILES["foto_portada_inmueble"]);
$model->subir_varios_archivos('../archiv/inmuebles/fotos/',$_FILES["nombre_archivo_imagen_inmueble"]);


$nombre_inmueble = $_POST['nombre_inmueble'];
$foto_portada_inmueble = time()."-".$_FILES["foto_portada_inmueble"]["name"];
$direccion_inmueble = $_POST['direccion_inmueble'];
$ciudad_inmueble = $_POST['ciudad_inmueble'];
$area_mentros2_inmueble = (int)$_POST['area_mentros2_inmueble'];	
$descripcion_corta_inmueble = $_POST['descripcion_corta_inmueble'];	
$descripcion_larga_inmueble = $_POST['descripcion_larga_inmueble'];
$precio_contado_inmueble = (int)str_replace(".", "", $_POST['precio_contado_inmueble']);
$precio_financiado_inmueble = (int)str_replace(".", "", $_POST['precio_financiado_inmueble']);
$cantidad_cuotas_inmueble = (int)$_POST['cantidad_cuotas_inmueble'];
//$slug_vehiculo = Str::slug($_POST['slug_vehiculo']);
//$stock_vehiculo = (int)$_POST['$stock_vehiculo'];
$publicar_inmueble = (int)$_POST['publicar_inmueble'];

echo $nombre_inmueble."<br>" ;
echo $foto_portada_inmueble."<br>" ;
echo $direccion_inmueble."<br>" ;
echo $ciudad_inmueble."<br>" ;
echo $area_mentros2_inmueble."<br>" ;
echo $descripcion_corta_inmueble."<br>" ;
echo $descripcion_larga_inmueble."<br>" ;
echo $precio_contado_inmueble."<br>" ;
echo $precio_financiado_inmueble."<br>" ;
echo $cantidad_cuotas_inmueble."<br>" ;
echo $publicar_inmueble."<br>" ;

$model = new CRUD;
$model->insertInto = 'inmuebles';
$model->insertColumns = 'nombre_inmueble,foto_portada_inmueble,direccion_inmueble,ciudad_inmueble,area_mentros2_inmueble,descripcion_corta_inmueble,descripcion_larga_inmueble,precio_contado_inmueble,precio_financiado_inmueble,cantidad_cuotas_inmueble,stock_inmueble,publicar_inmueble';
$model->insertValues = "'$nombre_inmueble','$foto_portada_inmueble','$direccion_inmueble','$ciudad_inmueble',$area_mentros2_inmueble,'$descripcion_corta_inmueble','$descripcion_larga_inmueble',$precio_contado_inmueble,$precio_financiado_inmueble,$cantidad_cuotas_inmueble,$publicar_inmueble,$publicar_inmueble";
$model->Create();
$mensaje = $model->mensaje;
$inmueble_id = $model->ultimoId; 

$model2 = new CRUD;
for($i=0;$i<count($_FILES["nombre_archivo_imagen_inmueble"]["name"]);$i++){

  echo "- </br>".$_FILES["nombre_archivo_imagen_inmueble"]["name"][$i];
  $nombre_archivo_imagen_inmueble = time()."-".$_FILES["nombre_archivo_imagen_inmueble"]["name"][$i];
  $descripcion_imagen_inmueble = $_FILES["nombre_archivo_imagen_inmueble"]["name"][$i];
   $model2->insertInto = 'inmuebles_fotos';
  $model2->insertColumns = 'nombre_archivo_imagen_inmueble,descripcion_imagen_inmueble,inmueble_id';
  $model2->insertValues = "'$nombre_archivo_imagen_inmueble','$descripcion_imagen_inmueble',$inmueble_id";
  $model2->Create(); 
  
  $mensaje = $model->mensaje;

}



//header ("Location: inmuebles.php?mensaje=creado");

echo '<script type="text/javascript">

window.location.assign("inmuebles.php?mensaje=creado");
</script>';


?>





















