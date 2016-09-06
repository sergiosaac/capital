  <?php 
  
  require 'layouts/layout1.php';
  require '../app/CRUD/clases/CRUD.php';
  require '../app/CRUD/clases/Conexion.php';

  $model = new CRUD;
  $cantidad_vehiculos = 0;

  function paginar($num_total_registros){
      if ($num_total_registros > 0) {
          //numero de registros por página
          $rowsPerPage = 6;
          //por defecto mostramos la página 1
          $pageNum = 1;
          // si $_GET['page'] esta definido, usamos este número de página
          if(isset($_GET['page']))
              $pageNum = $_GET['page'];
          //contando el desplazamiento
         $offset = ($pageNum - 1) * $rowsPerPage;
         $total_paginas = ceil($num_total_registros / $rowsPerPage);
         $model = new CRUD;
         $model->consultaPersonalizada = 'SELECT * FROM vehiculos ORDER BY id DESC LIMIT '.$offset.','.$rowsPerPage.'';
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
    $model->from = 'vehiculos';
    $model->condition = "".$_GET['criterio']." LIKE '%" . $_GET['buscado'] . "%'";

  $model->Read();
    $vehiculos = $model->rows;
    $cantidad_vehiculos = count($vehiculos);  
    
 
  }else{

       $model->select = '*';
       $model->from = 'vehiculos';

       $model->Read();
       $cantidad_vehiculos = count($model->rows);
       $data_de_paginacion = paginar($cantidad_vehiculos);
       $cantidad_vehiculos = $data_de_paginacion['cantidad_de_vehiculos_paginados'];       
       $vehiculos = $data_de_paginacion['vehiculos_paginados'];
   }

  ?>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div class="wrapper row">
    
    <div id="breadcrumb" class="hoc clear"> 
      <!-- ################################################################################################ -->
      <ul>
        <li><a href="#">Inicio</a></li>
        <li><a href="#">Productos</a></li>
        <li><a href="#">Vehículos</a></li>
        
      </ul>

      <!-- ################################################################################################ -->
    </div>


  </div>
  <!-- ################################################################################################ -->
</div>
<!-- End Top Background Image Wrapper -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="content"> 
      
      
      <!-- ################################################################################################ -->
      
      <div class="group btmspace-50 demo">
        <div id="comments" class="col-md-8 col-md-offset-2">
          <form action="#" method="post">
        <div class="three_quarter first">
          
            
            <div class="three_third first">
              <input type="text" name="nombre" id="nombre" placeholder="Favor ingresar informacion para buscar.." value="" size="22" required>
            </div>
          
        </div>
      
      <div class="one_quarter">
        <div class="three_third first">
              <input type="text" name="nombre" id="nombre" placeholder="Marca, modelo, etc.." value="" size="22" required>
            </div>
      </div>
      </form>
      </div>
      </div>
      

      <div class="group btmspace-50 demo">
        <?php $first = 0; 
          foreach ($vehiculos as $vehiculo) {?>
          <?php if($first == 0){ echo '<div class="one_third first">'; }else{ echo '<div class="one_third">'; } ?>
            <img height="300" width="300" src="../../admin/template/archiv/vehiculos/portadas/<?=$vehiculos[3]['foto_portada_vehiculo']?>" alt=""></a>
            <p><a href="#"><?=$vehiculo['titulo_vehiculo']?></a> <br> <?=$vehiculo['descripcion_corta_vehiculo']?> </p>
          </div>
          <?php if($first == 2){ echo '<br><br><br><br><hr><br><br><br>'; }?>
        <?php 

      if ($first <= 1) {
        $first++;
      }else{
        $first = 0;
      }

      }?> 
      </div>
      
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->

    <?php 
      echo '<nav class="pagination">';
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

      echo "</nav>";
        ?>

    <div class="clear"></div>
  </main>

</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

<?php require 'layouts/layout2.php'; ?>