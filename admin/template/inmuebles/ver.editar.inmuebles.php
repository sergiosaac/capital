<?php 

//DATOS DEL ARCHIVO
$cuotas = array(4,6,12,24);

$id = @$_GET['id'];
  
  //DATOS DEL ARCHIVO
  require '../layout1.php';
  require '../CRUD/clases/Generales.php';

  $obj_general = new Generales;

  $model = new CRUD;
  $model->select = '*';
  $model->from = 'inmuebles';
  $model->condition = "id=" . @$_GET['id'] . "";
  $model->Read();
  $fila = $model->rows;

  //imagenes
  $model2 = new CRUD;
  $model2->select = '*';
  $model2->from = 'inmuebles_fotos';
  $model2->condition = "inmueble_id=" . @$_GET['id'] . "";
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
        <h4 class="modal-title">Inmueble</h4>
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
            Detalles de inmueble:
        </h3>
        <ol class="breadcrumb">
            <li>
              <i class="glyphicon glyphicon-th-large"></i>  <a href="/admin/template/inicio">Inicio</a>
            </li>
            <li>
              <i class="glyphicon glyphicon-arrow-right"></i> <a href="inmuebles.php">Inmuebles</a> 
            </li>
          <li class="active">
              <i class="glyphicon glyphicon-arrow-right"></i> <?=$fila[0]["nombre_inmueble"]?>
          </li>
                                   
        </ol>   
    </div>
</div>
   <?php
    if(isset($_GET['mensaje'])){
      $obj_general->mensaje_de_operacion($_GET['mensaje'],$fila[0]["nombre_inmueble"]." actualizado corretamente","En horabuena!");
    }    
  ?>
  
     <hr>
<div style="display:none;" class="detalles-un-vehiculo row">         
      
        <div class="col-lg-6"> 
          
           <div class="bs-callout bs-callout-info" id="callout-alerts-no-default"> <h4><?=$fila[0]["nombre_inmueble"]?></h4> 
            <p><?=$fila[0]["descripcion_larga_inmueble"]?></p> 
          </div>
            <br>
           <img class="ver img-thumbnail"  src="../archiv/inmuebles/portadas/<?=$fila[0]["foto_portada_inmueble"]?>" alt="">
           <br>
           <br>
            <form enctype="multipart/form-data" action="admin.imagenes.inmuebles/cambiar.portada.inmueble.php" method="POST">              
               <input name="foto_portada_inmueble_nuevo" type="file">
              <input type="hidden" name="id_foto" value="<?=$fila[0]["id"]?>">
               <br>
               <button type="submit" class="btn btn-sm btn-primary">Cambiar portada</button>
              <br><br>
            </form>

            <div class="row">
                <?php if(isset($fotos)){ ?>
                  <?php  foreach ($fotos as $foto) {?>
                    <div class="col-sm-2">                      
                      <img height="70" width="70" class="ver img-thumbnail" src="../archiv/inmuebles/fotos/<?=$foto["nombre_archivo_imagen_inmueble"]?>" alt="">
                      <span data="<?=$foto["id"]?>" data2="<?=$foto["nombre_archivo_imagen_inmueble"]?>" class="glyphicon eliminar_imagen_inmueble glyphicon-remove-circle" aria-hidden="true"></span>  
                    </div>  
                 <?php }?>
              <?php }else{ ?>
                <div style="margin:5px;" class="alert alert-warning">
                    El inmueble no tiene foto cargadas. 
                </div>
              <?php } ?>
             </div>
          
          <div class="row">
            
            <div class="col-lg-6">
              <br>              
              <form enctype="multipart/form-data" action="admin.imagenes.inmuebles/subir.mas.imagenes.inmueble.php" method="POST" class="nuevas_imagenes"> 
               <input type="file" name="nombre_archivo_imagen_inmueble_nuevos[]" multiple="true">
                <input type="hidden" name="id_inmueble" value="<?=$fila[0]["id"]?>">
               <br>                             
               
               <button type="submit" class="btn mas_imagenes btn-sm btn-primary">Agregar más fotos</button>
              </form>
            </div>
          </div>
                
          
          <hr>
          
          <form action="actualizar.inmuebles.php" method="POST" >
          <div class="panel panel-default">
            <div class="panel-heading">Costos y publicación:</div>
              <div class="panel-body">
                <div class="form-group">
              <label>Precio contado ($):</label>
              <input name="precio_contado_inmueble" onkeyup="format(this)" onchange="format(this)" class="form-control" value="<?=number_format($fila[0]['precio_contado_inmueble'], 0, ",", ".");?>">
           </div>  
                
           <div class="form-group">
              <label>Precio financiado ($):</label>
              <input name="precio_financiado_inmueble" onkeyup="format(this)" onchange="format(this)" class="form-control" value="<?=number_format($fila[0]["precio_financiado_inmueble"], 0, ",", ".");?>">
           </div>
                
           <div class="form-group">
              <label>Cantidad cuotas:</label>
             <select name="cantidad_cuotas_inmueble" class="form-control">
               <?php $obj_general->obtener_valor_de_db_select($cuotas,$fila[0]["cantidad_cuotas_inmueble"]); ?>  
             </select>
       
          </div>
                
        <div class="form-group">
          <label>Publicar:</label>
          
          <?php if($fila[0]["publicar_inmueble"] == 1){ ?>
           
            <div class="radio">
                <label>
                    <input type="radio" name="publicar_inmueble" id="optionsRadios1" value="1" checked >Si
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="publicar_inmueble" id="optionsRadios2" value="0" >No
                </label>
            </div> 

          <?php }else{ ?>
          
          <div class="radio">
                <label>
                    <input type="radio" name="publicar_inmueble" id="optionsRadios1" value="1" >Si
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="publicar_inmueble" id="optionsRadios2" value="0" checked >No
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
                
                <div class="form-group">
                    <label>Nombre inmueble:</label>
                    <input class="form-control" name="nombre_inmueble" value="<?=$fila[0]["nombre_inmueble"]?>">                                
                </div>
               <div class="form-group">
                    <label>Dirección inmueble:</label>
                    <input class="form-control" name="direccion_inmueble" value="<?=$fila[0]["direccion_inmueble"]?>">
                </div>
               <div class="form-group">
                    <label>Ciudad inmueble:</label>                    
                      <input class="form-control" name="ciudad_inmueble" value="<?=$fila[0]["ciudad_inmueble"]?>">
                    </select>
                </div>
               <div class="form-group">
                    <label>Área (m2):</label>                     
                      <input class="form-control" name="area_mentros2_inmueble" value="<?=$fila[0]["area_mentros2_inmueble"]?>">
                    </select>
                </div>               
               <div class="form-group">
                    <label>Descripición corta:</label>
                    <textarea class="form-control" name="descripcion_corta_inmueble" rows="3"><?=$fila[0]["descripcion_corta_inmueble"]?></textarea>
                </div>
                 <div class="form-group">
                    <label>Descripición larga:</label>
                    <textarea class="form-control" name="descripcion_larga_inmueble" rows="6"><?=$fila[0]["descripcion_larga_inmueble"]?></textarea>
                </div>                               
              <input name="id" type="hidden" value="<?=$id?>">
            <button type="submit" class="btn btn-warning">Actualizar</button>           
            </form>
          <a href="inmuebles.php"><button class="btn btn-warning">Atras</button></a> 
        </div>
       </div>
      
    </div>
  </div>
    
</div>
<?php require '../layout2.php'?>