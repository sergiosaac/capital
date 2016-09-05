<?php 



//DATOS DEL ARCHIVO
$marcas_de_autos = array("Alfa Romeo","Aston Martin","Audi","Autovaz","Bentley","Bmw","Cadillac","Caterham","Chevrolet","Chrysler","Chrysler"
                        ,"Citroen","Daihatsu","Dodge","Ferrari","Fiat","Audi","Ford","Honda","Hummer","Hyundai","Isuzu","Jaguar","Jeep"
                        ,"Kia","Lamborghini","Lancia","Land Rover","Lexus","Lotus","Maserati","Mazda","Mercedes Benz","MG","Mini","Mitsubishi","Morgan"
                        ,"Nissan","Opel","Peugeot","Porsche","Renault","Rolls Royce","Rover","Saab","Seat","Skoda","Smart","Ssangyong","Subaru","Suzuki"
                        ,"Tata","Toyota","Volkswagen","Volvo");

$cuotas = array(4,6,12,24);

$anhos = array(1960); 

for ($i = 1961; $i <= 2016; $i++) {
  array_push($anhos,$i);   
}

$tipos_de_moviles = array('Autos','Camioneta','Motos','Lancha','Camion','Deportivos','Cabrios','Aviación');

$id = @$_GET['id'];
//DATOS DEL ARCHIVO


  require '../layout1.php';

  require '../CRUD/clases/Generales.php';

  $obj_general = new Generales;


  $model = new CRUD;
  $model->select = '*';
  $model->from = 'vehiculos';
  $model->condition = "id=" . @$_GET['id'] . "";
  $model->Read();
  $fila = $model->rows;

  //imagenes
  $model2 = new CRUD;
  $model2->select = '*';
  $model2->from = 'vehiculos_fotos';
  $model2->condition = "vehiculo_id=" . @$_GET['id'] . "";
  $model2->Read();
  $fotos = $model2->rows;

?>

<!-- Modal -->
<div id="visor-fotos-vehiculos" class="modal fade" role="dialog">
  <div style=" width: 80% !important;" class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Vehículo</h4>
      </div>
      <div class="modal-body">
        <img style="margin:auto;" class="visor-grande img-responsive" alt="Cinque Terre">                
      </div>     
    </div>
  </div>
</div>

<!-- FIN Modal -->
<div class="container-fluid">   
   
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            Detalles de vehículos
        </h3>
        <ol class="breadcrumb">
            <li>
              <i class="glyphicon glyphicon-th-large"></i>  <a href="/admin/template/inicio/">Inicio</a>
            </li>
            <li>
              <i class="glyphicon glyphicon-arrow-right"></i> <a href="vehiculos.php">Vehículos</a> 
            </li>
          <li class="active">
              <i class="glyphicon glyphicon-arrow-right"></i> <?=$fila[0]["titulo_vehiculo"]?>
          </li>
                                   
        </ol>   
    </div>
</div>
   <?php
    if(isset($_GET['mensaje'])){
      $obj_general->mensaje_de_operacion($_GET['mensaje'],$fila[0]["titulo_vehiculo"]." actualizado corretamente","En horabuena!");
    }    
  ?>
  
     <hr>
<div style="display:none;" class="detalles-un-vehiculo row">         
      
        <div class="col-lg-6"> 
          
           <div class="bs-callout bs-callout-info" id="callout-alerts-no-default"> <h4><?=$fila[0]["titulo_vehiculo"]?></h4> 
            <p><?=$fila[0]["descripcion_larga_vehiculo"]?></p> 
          </div>
            <br>
           <img class="ver img-thumbnail"  src="../archiv/vehiculos/portadas/<?=$fila[0]["foto_portada_vehiculo"]?>" alt="">
           <br>
           <br>
            <form enctype="multipart/form-data" action="admin.imagenes/cambiar.portada.vehiculos.php" method="POST">              
               <input name="foto_portada_vehiculo_nuevo" type="file">
              <input type="hidden" name="id_foto" value="<?=$fila[0]["id"]?>">
               <br>
               <button type="submit" class="btn btn-sm btn-primary">Cambiar portada</button>
              <br><br>
            </form>

            <div class="row">
                <?php if(isset($fotos)){ ?>
                  <?php  foreach ($fotos as $foto) {?>
                    <div class="col-sm-2">                      
                      <img height="70" width="70" class="ver img-thumbnail" src="../archiv/vehiculos/fotos/<?=$foto["nombre_archivo_imagen_vehiculo"]?>" alt="">
                      <span data="<?=$foto["id"]?>" data2="<?=$foto["nombre_archivo_imagen_vehiculo"]?>" class="glyphicon eliminar_imagen glyphicon-remove-circle" aria-hidden="true"></span>  
                    </div>  
                 <?php }?>
              <?php }else{ ?>
                <div style="margin:5px;" class="alert alert-warning">
                    El vechiculo no tiene foto cargadas. 
                </div>
              <?php } ?>
             </div>
          
          <div class="row">
            
            <div class="col-lg-6">
              <br>              
              <form enctype="multipart/form-data" action="admin.imagenes/subir.mas.imagenes.vehiculos.php" method="POST" class="nuevas_imagenes"> 
               <input type="file" name="nombre_archivo_imagen_vehiculo_nuevos[]" multiple="true">
                <input type="hidden" name="id_vehiculo" value="<?=$fila[0]["id"]?>">
               <br>                             
               
               <button type="submit" class="btn mas_imagenes btn-sm btn-primary">Agregar más fotos</button>
              </form>
            </div>
          </div>
                
          
          <hr>
          
          <form action="actualizar.vehiculos.php" method="POST" >
          <div class="panel panel-default">
            <div class="panel-heading">Costos y publicación:</div>
              <div class="panel-body">
                <div class="form-group">
              <label>Precio contado:</label>
              <input name="precio_contado_vehiculo" onkeyup="format(this)" onchange="format(this)" class="form-control" value="<?=number_format($fila[0]['precio_contado_vehiculo'], 0, ",", ".");?>">
           </div>  
                
           <div class="form-group">
              <label>Precio financiado:</label>
              <input name="precio_financiado_vehiculo" onkeyup="format(this)" onchange="format(this)" class="form-control" value="<?=number_format($fila[0]["precio_financiado_vehiculo"], 0, ",", ".");?>">
           </div>
                
           <div class="form-group">
              <label>Cantidad cuotas:</label>
             <select name="cantidad_cuotas_vehiculo" class="form-control">
               <?php $obj_general->obtener_valor_de_db_select($cuotas,$fila[0]["cantidad_cuotas_vehiculo"]); ?>  
             </select>
       
          </div>
                
        <div class="form-group">
          <label>Publicar:</label>
          
          <?php if($fila[0]["publicar_vehiculo"] == 1){ ?>
           
            <div class="radio">
                <label>
                    <input type="radio" name="publicar_vehiculo" id="optionsRadios1" value="1" checked >Si
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="publicar_vehiculo" id="optionsRadios2" value="0" >No
                </label>
            </div> 

          <?php }else{ ?>
          
          <div class="radio">
                <label>
                    <input type="radio" name="publicar_vehiculo" id="optionsRadios1" value="1" >Si
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="publicar_vehiculo" id="optionsRadios2" value="0" checked >No
                </label>
            </div> 
          
          <?php } ?>
                                            
       </div>
                
         </div>
          </div>
        </div>
        
        
        <div class="col-lg-6">
          
          <div class="panel panel-default">
            <div class="panel-heading">Información general:</div>
              <div class="panel-body">
                 <form role="form">
                <div class="form-group">
                    <label>Título vehículo:</label>
                    <input class="form-control" name="titulo_vehiculo" value="<?=$fila[0]["titulo_vehiculo"]?>">                                
                </div>
               <div class="form-group">
                    <label>Modelo vehículo:</label>
                    <input class="form-control" name="modelo_vehiculo" value="<?=$fila[0]["modelo_vehiculo"]?>">
                </div>
               <div class="form-group">
                    <label>Marca vehículo:</label>
                    <select name="marca_vehiculo" class="form-control">
                      <?php $obj_general->obtener_valor_de_db_select($marcas_de_autos,$fila[0]["marca_vehiculo"]);  ?>                                                              
                    </select>
                </div>
               <div class="form-group">
                    <label>Año vehículo:</label>
                     <select name="anho_vehiculo" class="form-control">
                 <?php $obj_general->obtener_valor_de_db_select($anhos,$fila[0]["anho_vehiculo"]); ?>  
                    </select>
                </div>
                
                 <div class="form-group">
                    <label>Tipo de vehículos: </label>
                    <select name="tipo_vehiculo_vehiculo" class="form-control">
                    <?php $obj_general->obtener_valor_de_db_select($tipos_de_moviles,$fila[0]["tipo_vehiculo_vehiculo"]); ?>  
                    </select>
                </div> 
                   
                   
               <div class="form-group">
                    <label>Color vehículo:</label>
                    <input class="form-control" name="color_vehiculo" value="<?=$fila[0]["color_vehiculo"]?>">
                </div>

               <div class="form-group">
                    <label>Descripición corta:</label>
                    <textarea class="form-control" name="descripcion_corta_vehiculo" rows="3"><?=$fila[0]["descripcion_corta_vehiculo"]?></textarea>
                </div>

                 <div class="form-group">
                    <label>Descripición larga:</label>
                    <textarea class="form-control" name="descripcion_larga_vehiculo" rows="6"><?=$fila[0]["descripcion_larga_vehiculo"]?></textarea>
                </div>                               
              <input name="id" type="hidden" value="<?=$id?>">
          <button type="submit" class="btn btn-warning">Actualizar</button>
                    </form>
        <a href="vehiculos.php"><button class="btn btn-warning">Atras</button></a> 
        </div>
       </div>
          

    </div>
  </div>
    
</div>
<?php require '../layout2.php'?>