<?php 
  
  require '../layout1.php';
  require '../CRUD/clases/Generales.php';
  $obj_general = new Generales;

  $model = new CRUD;
  $cantidad_vehiculos = 0;

  function paginar($num_total_registros){
      if ($num_total_registros > 0) {
          //numero de registros por página
          $rowsPerPage = 12;
          //por defecto mostramos la página 1
          $pageNum = 1;
          // si $_GET['page'] esta definido, usamos este número de página
          if(isset($_GET['page']))
              $pageNum = $_GET['page'];
          //contando el desplazamiento
         $offset = ($pageNum - 1) * $rowsPerPage;
         $total_paginas = ceil($num_total_registros / $rowsPerPage);
         $model = new CRUD;
         $model->consultaPersonalizada = 'SELECT * FROM inmuebles ORDER BY id DESC LIMIT '.$offset.','.$rowsPerPage.'';
         $model->ConsultaPersonalizada();
         $vehiculos_paginados = $model->rows;                  
      }
       $data = [
         'vehiculos_paginados' => $vehiculos_paginados,
         'cantidad_de_vehiculos_paginados' => count($vehiculos_paginados),
         'datos_de_paginacion'=> [
           'total_paginas' => $total_paginas,
           'pageNum' => $pageNum           
         ]        
         
       ];
      return $data;
     }

if(isset($_GET['buscado'])){

  $model->select = '*';
    $model->from = 'inmuebles';
    $model->condition = "".$_GET['criterio']." LIKE '%" . $_GET['buscado'] . "%'";

  $model->Read();
    $vehiculos = $model->rows;
    $cantidad_vehiculos = count($vehiculos);  
    
 
  }else{
   


//       $model->orderBy = 'ORDER BY id ASC';

       $model->select = '*';
       $model->from = 'inmuebles';

       $model->Read();
       $cantidad_vehiculos = count($model->rows);
       $data_de_paginacion = paginar($cantidad_vehiculos);
       $cantidad_vehiculos = $data_de_paginacion['cantidad_de_vehiculos_paginados'];       
       $vehiculos = $data_de_paginacion['vehiculos_paginados'];
	
		
   }
?>

<div class="container-fluid">   
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            Listado de inmuebles         
        </h3>
        <ol class="breadcrumb">
            <li>
                <i class="glyphicon glyphicon-th-large"></i>  <a href="/admin/template/inicio">Inicio</a>
            </li>
            <li class="active">
                <i class="glyphicon glyphicon-arrow-right"></i> Inmuebles
            </li>
           <ul class="nav navbar-right top-nav">
            <button onclick="mostrar_formulario('.form-nuevo-vehiculo','.listado-principar-vechiculos')" type="button" class="btn btn-xs btn-success">Agregar vehículo</button>                             
          </ul>                          
        </ol>   
    </div>
</div>
<!-- /.row -->
 <?php
    if(isset($_GET['mensaje'])){
      $obj_general->mensaje_de_operacion($_GET['mensaje']," Agregado nuevo inmueble.","En horabuena!");
    }    
  ?>
  
  <div style="display:none;" class="row listado-principar-vechiculos">
      <div class="col-lg-3">    
        <h4>Buscar inmueble por:</h4>
      </div>
      <div class="col-lg-9">
        <form role="form" action="" method="GET">
        <div class="col-lg-6">
          <div class="form-group">                
                <select name="criterio" class="form-control">
                    <option value="nombre_inmueble">Nombre inmueble</option>
                    <option value="direccion_inmueble">Ubicación</option>
                    <option value="ciudad_inmueble">Ciudad</option>
                    <option value="area_mentros2_inmueble">Área</option>
                    <option value="descripcion_corta_inmueble">Descripición</option>
                    <option value="precio_contado_inmueble">Precio contado</option>
                    <option value="precio_financiado_inmueble">Precio financiado</option>                    
                </select>
            </div>
        </div>
        <div class="col-lg-6">
           <div class="form-group input-group">
                <input name="buscado" type="text" placeholder="Buscar vehiculo.." class="buscador form-control">
                <span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button></span>
            </div>
        </div>
         </form>
      </div>    
      <div class="col-lg-12">
        <?php if($cantidad_vehiculos == 0){?>
          <div class="alert alert-info" role="alert">No se encontraron inmuebles, vuelve a buscar o <a href="inmuebles.php">Ver listado completo</a> </div>        
      <?php }else{?>
       
         <?php 
             echo '<ul class="pagination pagination-sm">';
             $url = "";

            if (@$data_de_paginacion['datos_de_paginacion']['total_paginas'] > 1) {
                if ($data_de_paginacion['datos_de_paginacion']['pageNum']!= 1)
                    echo '<li><a href="'.$url.'?page='.($data_de_paginacion['datos_de_paginacion']['pageNum']-1).'">&laquo;</a></li>';
                for ($i=1;$i<=$data_de_paginacion['datos_de_paginacion']['total_paginas'];$i++) {
                    if ($data_de_paginacion['datos_de_paginacion']['pageNum'] == $i)
                        //si muestro el índice de la página actual, no coloco enlace
                        echo "";
                    else
                        //si el índice no corresponde con la página mostrada actualmente,
                        //coloco el enlace para ir a esa página
                        echo '  <li><a href="'.$url.'?page='.$i.'">'.$i.'</a></li>  ';
                }
                if ($data_de_paginacion['datos_de_paginacion']['pageNum'] != $data_de_paginacion['datos_de_paginacion']['total_paginas'])
                    echo '<li><a href="'.$url.'?page='.($data_de_paginacion['datos_de_paginacion']['pageNum']+1).'">&raquo;</a></li>';
            }
            echo '</ul>';


        ?>
       
      <div class="table-responsive">
          <table class="table table-hover table-striped">
              <thead>
                  <tr>
                    <th>#</th>
                     <th>Portada</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Ciudad</th>
                    <th>Área (m2)</th>                                    
                    <th>Precio Contado ($) </th>
                    <th>Precio Financiado ($)</th>                                        
                    <th>Publicado</th>
                    <th colspan="2" style="text-align:center;">Editar</th>
                  </tr>
              </thead>
              <tbody>               
                  <?php  foreach ($vehiculos as $vehiculo) {?>
                  <tr>
                    <td><?=$vehiculo['id']?></td>
                    <td> <img class="img-thumbnail" height="90" width="90" src="../archiv/inmuebles/portadas/<?=$vehiculo['foto_portada_inmueble']?>" alt=""></td>                   
                    <td><a href="ver.editar.inmuebles.php?id=<?=$vehiculo['id']?>"><?=$vehiculo['nombre_inmueble']?></a></td>
                    <td><?=$vehiculo['direccion_inmueble']?></td>
                    <td><?=$vehiculo['ciudad_inmueble']?></td>
                    <td><?=$vehiculo['area_mentros2_inmueble']?></td>                    
                    <td><?=number_format($vehiculo['precio_contado_inmueble'], 0, ",", "."); ?></td>
                    <td><?=number_format($vehiculo['precio_financiado_inmueble'], 0, ",", "."); ?></td>                    
									<?php if($vehiculo['publicar_inmueble'] == 1){?>
										<td><span class="label label-success">Publicado</span></td>
									<?php }else{?>
										<td><span class="label label-default">No publicado</span></td>
									<?php }?>
                                  
                    <td style="text-align:center;" > <a href="ver.editar.inmuebles.php?id=<?=$vehiculo['id']?>"><button type="button" class="btn btn-xs btn-warning">Ver / Editar</button></a></td>
                    <td style="text-align:center;" > <a href="#!"><button data="<?=$vehiculo['id']?>" type="button" class="eliminar-inmueble btn btn-xs btn-danger">Eliminar</button></a></td>
                  </tr> 
                <?php }?>            
              </tbody>
          </table>
      </div>    
    <?php }?>   
    </div>
</div>
  
<div style="display:none;" class="panel panel-success form-nuevo-vehiculo">
<div class="panel-heading">
      <h3 class="panel-title">Formulario para agregar nuevo inmueble.</h3>
  </div>
 <div class="panel-body">
  <div class="row"> 
    <form role="form" action="crear.inmuebles.php" method="POST" id="crear_vehiculo" enctype="multipart/form-data">
    <div class="col-lg-6">      
      <h4>Informacion general:</h4>
        <br>        
            <div class="form-group">
                <label>Nombre inmueble:</label>
                <input required name="nombre_inmueble" placeholder="Nombre inmueble" class="form-control">                                
            </div>
            <div class="form-group">
                <label>Foto portada:</label>
                <input required name="foto_portada_inmueble" type="file" class="form-control">                                
            </div>
           <div class="form-group">
                <label>Dirección inmueble:</label>
                <input required name="direccion_inmueble" placeholder="Dirección inmueble" class="form-control">
            </div>
						 <div class="form-group">
                <label>Ciudad inmueble:</label>
                <input required name="ciudad_inmueble" placeholder="Ciudad inmueble:" class="form-control">
            </div>
			
				 <div class="form-group">
                <label>Área (m2):</label>
                <input required name="area_mentros2_inmueble" placeholder="Área (m2)" onkeyup="format(this)" class="form-control">
            </div>
		  
           <div class="form-group">
                <label>Descripición corta:</label>
                <textarea required name="descripcion_corta_inmueble" class="form-control" rows="3"></textarea>
            </div>

             <div class="form-group">
                <label>Descripición larga:</label>
                <textarea required name="descripcion_larga_inmueble" class="form-control" rows="6"></textarea>
            </div>

       

            <div class="form-group">
                <label>Selecciona imágenes:</label>
                <input required type="file" multiple="multiple" name="nombre_archivo_imagen_inmueble[]" />
            </div>                       
        
    </div>
    <div class="col-lg-6">

        <h4>Costos y publicación:</h4>   
      <br>
       <div class="form-group">
          <label>Precio contado ($) :</label>
          <input required name="precio_contado_inmueble" placeholder="0" onkeyup="format(this)" onchange="format(this)" class="form-control">
       </div>                      
       <div class="form-group">
          <label>Precio financiado ($):</label>
          <input required name="precio_financiado_inmueble" placeholder="0" onkeyup="format(this)" onchange="format(this)" class="form-control">
       </div>
       <div class="form-group">
         <label>Cantidad de cuotas:</label>
           <select required name="cantidad_cuotas_inmueble" class="form-control">
              <option value="4">4</option>
             <option value="6">6</option>
              <option value="12">12</option>
              <option value="24">24</option>           
          </select>
       </div>

      <div class="form-group">
        <label>Publicar:</label>
        <div class="radio">
            <label>
                <input required type="radio" name="publicar_inmueble" id="optionsRadios1" value="1" >Si
            </label>
        </div>
        <div class="radio">
            <label>
                <input required type="radio" name="publicar_inmueble" id="optionsRadios2" value="0" checked>No
            </label>
        </div>                          
     </div>
     <button type="submit" class="btn boton_crear btn-success">Guardar nuevo inmueble</button>
</div>
      
      </form>
</div>
</div>
</div>

</div>

<?php require '../layout2.php'?>