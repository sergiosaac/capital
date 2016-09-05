<?php

class Generales {
  
    public function subir_archivo($ubicacion,$archivo) {
      
      if (isset($ubicacion))
      {
          $file = $archivo;
          $time = time()."-";
          $nombre = $time.$file["name"];
          $tipo = $file["type"];
          $ruta_provisional = $file["tmp_name"];
          $size = $file["size"];
          $dimensiones = getimagesize($ruta_provisional);
          $width = $dimensiones[0];
          $height = $dimensiones[1];
          $carpeta = $ubicacion;

          if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif')
          {
            echo "Error, el archivo no es una imagen"; 
          }
          else if ($size > 1024*1024)
          {
            echo "Error, el tamaño máximo permitido es un 1MB";
          }
          else if ($width > 1024 || $height > 1920)
          {
              echo "Error la anchura y la altura maxima permitida es 500px";
          }
          else if($width < 60 || $height < 60)
          {
              echo "Error la anchura y la altura mínima permitida es 60px";
          }
          else
          {
              $src = $carpeta.$nombre;
              move_uploaded_file($ruta_provisional, $src);
              echo "<img src='$src'>";
          }
      }
    
    }
  
  public function subir_varios_archivos($ubicacion,$arvhivos){
     
    $time = time()."-";
    # definimos la carpeta destino
    $carpetaDestino=$ubicacion;
 
    # si hay algun archivo que subir
    if($arvhivos["name"][0])
    {
         # recorremos todos los arhivos que se han subido
        for($i=0;$i<count($arvhivos["name"]);$i++)
        {
             # si es un formato de imagen
            if($arvhivos["type"][$i]=="image/jpeg" || $arvhivos["type"][$i]=="image/pjpeg" || $arvhivos["type"][$i]=="image/gif" || $arvhivos["type"][$i]=="image/png")
            {
                 # si exsite la carpeta o se ha creado
                if(file_exists($carpetaDestino) || @mkdir($carpetaDestino))
                {
                    $origen=$arvhivos["tmp_name"][$i];
                    $destino=$carpetaDestino.$time.$arvhivos["name"][$i];
 
                    # movemos el archivo
                    if(@move_uploaded_file($origen, $destino))
                    {
                        echo "<br>".$arvhivos["name"][$i]." movido correctamente";
                    }else{
                        echo "<br>No se ha podido mover el archivo: ".$arvhivos["name"][$i];
                    }
                }else{
                    echo "<br>No se ha podido crear la carpeta: up/".$user;
                }
            }else{
                echo "<br>".$arvhivos["name"][$i]." - NO es imagen jpg";
            }
        }
    }else{
        echo "<br>No se ha subido ninguna imagen";
    }
  }
  
   public function obtener_valor_de_db_select($array_opciones,$valor_de_db){
      
    for ($x = 0; $x < count($array_opciones); $x++) {

      if($array_opciones[$x] == $valor_de_db){
        echo "<option value='".$array_opciones[$x]."' selected >".$array_opciones[$x]."</option>";
      }else{
        echo "<option value='".$array_opciones[$x]."'>".$array_opciones[$x]."</option>";
      }
    }
  }
  
  public function mensaje_de_operacion($tipo_de_mensaje,$mensaje_a_mostrar,$mensaje_negrita){

    switch ($tipo_de_mensaje) {
        case "error":
            echo '<div class="alert alertas alert-danger" role="alert"><strong>'.$mensaje_negrita.'</strong> '.$mensaje_a_mostrar.'</div>';
            break;
        case "actualizado":
            echo '<div class="alert alertas alert-warning" role="alert"><strong>'.$mensaje_negrita.'</strong> '.$mensaje_a_mostrar.'</div>';
            break;
        case "creado":
            echo '<div class="alert alertas alert-success" role="alert"><strong>'.$mensaje_negrita.'</strong> '.$mensaje_a_mostrar.'</div>';
            break;
        case "eliminado":
            echo '<div class="alert alertas alert-info" role="alert"><strong>'.$mensaje_negrita.'</strong> '.$mensaje_a_mostrar.'</div>';
            break;
        default:
            echo "Your favorite color is neither red, blue, nor green!";
    }
    
    
  }
  
}