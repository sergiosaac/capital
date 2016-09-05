<?php


$marcas_de_autos = array("Alfa Romeo","Aston Martin","Audi","Autovaz","Bentley","Bmw","Cadillac","Caterham","Chevrolet","Chrysler","Chrysler"
                        ,"Citroen","Daihatsu","Dodge","Ferrari","Fiat","Audi","Ford","Honda","Hummer","Hyundai","Isuzu","Jaguar","Jeep"
                        ,"Kia","Lamborghini","Lancia","Land Rover","Lexus","Lotus","Maserati","Mazda","Mercedes Benz","MG","Mini","Mitsubishi","Morgan"
                        ,"Nissan","Opel","Peugeot","Porsche","Renault","Rolls Royce","Rover","Saab","Seat","Skoda","Smart","Ssangyong","Subaru","Suzuki"
                        ,"Tata","Toyota","Volkswagen","Volvo");



  
  var_dump($marcas_de_autos);


?>

 <?php for ($x = 0; $x < count($marcas_de_autos); $x++) {?>                   
                        <?php if($marcas_de_autos[$x] == $fila[0]["marca_vehiculo"] ){ ?>
                            <option value="<?=$marcas_de_autos[$x]?>" selected><?=$marcas_de_autos[$x]?></option>  
                         <?php } else { ?>
                        
                        <option value="<?=$marcas_de_autos[$x]?>"><?=$marcas_de_autos[$x]?></option>
                          <?php } ?>                     
                      <?php }?>   