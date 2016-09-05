<?php

//Si el array no tiene 14 datos no pasa nada
$validaddor = array($titulo_vehiculo,$foto_portada_vehiculo,$modelo_vehiculo,$marca_vehiculo,$anho_vehiculo,$color_vehiculo,$descripcion_corta_vehiculo,$descripcion_larga_vehiculo
                   ,$tipo_vehiculo_vehiculo,$precio_contado_vehiculo,$precio_financiado_vehiculo,$cantidad_cuotas_vehiculo,$publicar_vehiculo);



require '../CRUD/clases/Generales.php';
require '../CRUD/clases/CRUD.php';
require '../CRUD/clases/Conexion.php';

$model = new Generales;

$model->subir_archivo('../archiv/vehiculos/portadas/',$_FILES["foto_portada_vehiculo"]);
$model->subir_varios_archivos('../archiv/vehiculos/fotos/',$_FILES["nombre_archivo_imagen_vehiculo"]);

$titulo_vehiculo = $_POST['titulo_vehiculo'];
$foto_portada_vehiculo = time()."-".$_FILES["foto_portada_vehiculo"]["name"];
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
//$slug_vehiculo = Str::slug($_POST['slug_vehiculo']);
//$stock_vehiculo = (int)$_POST['$stock_vehiculo'];
$publicar_vehiculo = (int)$_POST['publicar_vehiculo'];




$model = new CRUD;
$model->insertInto = 'vehiculos';
$model->insertColumns = 'titulo_vehiculo,foto_portada_vehiculo,modelo_vehiculo,marca_vehiculo,anho_vehiculo,color_vehiculo,descripcion_corta_vehiculo,descripcion_larga_vehiculo,tipo_vehiculo_vehiculo,precio_contado_vehiculo,precio_financiado_vehiculo,cantidad_cuotas_vehiculo,stock_vehiculo,publicar_vehiculo';
$model->insertValues = "'$titulo_vehiculo','$foto_portada_vehiculo','$modelo_vehiculo','$marca_vehiculo',$anho_vehiculo,'$color_vehiculo','$descripcion_corta_vehiculo','$descripcion_larga_vehiculo','$tipo_vehiculo_vehiculo',$precio_contado_vehiculo,$precio_financiado_vehiculo,$cantidad_cuotas_vehiculo,$publicar_vehiculo,$publicar_vehiculo";
$model->Create();

$mensaje = $model->mensaje;
$vehiculo_id = $model->ultimoId; 

$model2 = new CRUD;
for($i=0;$i<count($_FILES["nombre_archivo_imagen_vehiculo"]["name"]);$i++){

  echo "- </br>".$_FILES["nombre_archivo_imagen_vehiculo"]["name"][$i];
  $nombre_archivo_imagen_vehiculo = time()."-".$_FILES["nombre_archivo_imagen_vehiculo"]["name"][$i];
  $descripcion_imagen_vehiculo = $_FILES["nombre_archivo_imagen_vehiculo"]["name"][$i];
  $model2->insertInto = 'vehiculos_fotos';
  $model2->insertColumns = 'nombre_archivo_imagen_vehiculo,descripcion_imagen_vehiculo,vehiculo_id';
  $model2->insertValues = "'$nombre_archivo_imagen_vehiculo','$descripcion_imagen_vehiculo',$vehiculo_id";
  $model2->Create();
  $mensaje = $model2->mensaje;

}

//header ("Location: vehiculos.php?mensaje=creado");

echo '<script type="text/javascript">

window.location.assign("vehiculos.php?mensaje=creado");
</script>';

/*
  if (isset($_POST['titulo_vehiculo'])) {

    if (!is_numeric($precioL)) {
        $mensaje = "El campo precio debe ser numerico";
    } else {
        $model = new CRUD;
        $model->insertInto = 'productos';
        $model->insertColumns = 'titulo_vehiculo,foto_portada_vehiculo,modelo_vehiculo,marca_vehiculo,
        anho_vehiculo,color_vehiculo,descripcion_corta_vehiculo,descripcion_larga_vehiculo,tipo_vehiculo_vehiculo,precio_contado_vehiculo
        ,precio_financiado_vehiculo,cantidad_cuotas_vehiculo,publicar_vehiculo';
   
        $model->insertValues = "'$_POST['titulo_vehiculo']','$_POST['foto_portada_vehiculo']','$_POST['modelo_vehiculo']',
        '$_POST['marca_vehiculo']','$_POST['anho_vehiculo']','$_POST['color_vehiculo']'
        ,$_POST['descripcion_corta_vehiculo'],$_POST['descripcion_larga_vehiculo']
        ,$_POST['tipo_vehiculo_vehiculo'],$_POST['precio_contado_vehiculo']
        ,$_POST['precio_financiado_vehiculo'],$_POST['cantidad_cuotas_vehiculo'],$_POST['publicar_vehiculo']";
     
        $model->Create();
        $mensaje = $model->mensaje;
    }
  }
*/

?>





















