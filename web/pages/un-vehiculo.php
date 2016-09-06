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


  require 'layouts/layout1.php';
  require '../app/CRUD/clases/CRUD.php';
  require '../app/CRUD/clases/Conexion.php';

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
  <div class="wrapper row2">
  <div id="breadcrumb" class="hoc clear"> 
      <!-- ################################################################################################ -->
      <ul>
        <li><a href="../index.php">Inicio</a></li>
        <li><a href="../index.php">Productos</a></li>
        <li><a href="vehiculos.php">Vehículos</a></li>
        <li><a href="#!"><?=$fila[0]["titulo_vehiculo"]?></a></li>
        
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
    <div class="content three_quarter first"> 
      <!-- ################################################################################################ -->
      <h1><?=$fila[0]["titulo_vehiculo"]?></h1>
      <img class="imgr borderedbox inspace-5" src="../../admin/template/archiv/vehiculos/portadas/<?=$fila[0]["foto_portada_vehiculo"]?>" alt="">
      
      <p><?= $fila[0]["descripcion_corta_vehiculo"] ?> Tipo de vehiculo: <a href="#">  <?= $fila[0]["tipo_vehiculo_vehiculo"] ?></a>
      <p><?=$fila[0]["descripcion_larga_vehiculo"]?></p>
      <br><br>
      <div class="scrollable">
        <table>
          <thead>
            <tr>
              <th>Header 1</th>
              <th>Header 2</th>
              <th>Header 3</th>
              <th>Header 4</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><a href="#">Value 1</a></td>
              <td>Value 2</td>
              <td>Value 3</td>
              <td>Value 4</td>
            </tr>
            <tr>
              <td>Value 5</td>
              <td>Value 6</td>
              <td>Value 7</td>
              <td><a href="#">Value 8</a></td>
            </tr>
            <tr>
              <td>Value 9</td>
              <td>Value 10</td>
              <td>Value 11</td>
              <td>Value 12</td>
            </tr>
            <tr>
              <td>Value 13</td>
              <td><a href="#">Value 14</a></td>
              <td>Value 15</td>
              <td>Value 16</td>
            </tr>
          </tbody>
        </table>
      </div>

      <p>Haga clic en la miniatura para aumentar:</p>
      <ul class="nospace clear">
      <?php  $first = 0;  foreach ($fotos as $foto) {?>
          <?php if($first == 0){ echo '<li style="margin:10px;" class="one_quarter first">'; }else{ echo '<li class="one_quarter">'; } ?>
          
            <a href="#!">                     
            <img height="70" width="70" class="ver img-thumbnail" src="../../admin/template/archiv/vehiculos/fotos/<?=$foto["nombre_archivo_imagen_vehiculo"]?>" alt="">
          </a></li>

         <?php 

          if ($first <= 1) {
            $first++;
          }else{
            $first = 0;
          }
        }?>
      </ul>


    </div>
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <div class="sidebar one_quarter"> 
      <!-- ################################################################################################ -->
      <h6>Lorem ipsum dolor</h6>
      <nav class="sdb_holder">
        <ul>
          <li><a href="#">Navigation - Level 1</a></li>
          <li><a href="#">Navigation - Level 1</a>
            <ul>
              <li><a href="#">Navigation - Level 2</a></li>
              <li><a href="#">Navigation - Level 2</a></li>
            </ul>
          </li>
          <li><a href="#">Navigation - Level 1</a>
            <ul>
              <li><a href="#">Navigation - Level 2</a></li>
              <li><a href="#">Navigation - Level 2</a>
                <ul>
                  <li><a href="#">Navigation - Level 3</a></li>
                  <li><a href="#">Navigation - Level 3</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#">Navigation - Level 1</a></li>
        </ul>
      </nav>
      
      <!-- ################################################################################################ -->
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
<?php require 'layouts/layout2.php'; ?>