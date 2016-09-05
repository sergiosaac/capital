<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require("clases/Conexion.php");
require("clases/CRUD.php");

$mensaje = null;


if (isset($_POST['oculto'])) {

    $nombreL = htmlspecialchars($_POST['nombreI']);
    $descripcionL = htmlspecialchars($_POST['descripcionI']);
    $categoriaL = htmlspecialchars($_POST['categoriaI']);
    $precioL = ($_POST['precioI']);


    if (!is_numeric($precioL)) {
        $mensaje = "El campo precio debe ser numerico";
    } else {
        $model = new CRUD;
        $model->insertInto = 'productos';
        $model->insertColumns = 'nombre,descripcion,categoria,precio';
        $model->insertValues = "'$nombreL','$descripcionL','$categoriaL',$precioL";
        $model->Create();
        $mensaje = $model->mensaje;
    }
}
?>

<html>
    <head lang="es">
        <meta charset="UTF-8">
        <title>CRUD</title>

        <link type="text/css" rel="stylesheet" href="estilos.css" />
      
    </head>
    <body>
        <h1>CRUD::Create</h1>
        <strong> <?php echo "<span>$mensaje</span>"; ?> </strong>
        <a href="read.php" title="Read" >Read</a>
        <form action="" method="POST">
            <table align='center'>

                <tr>

                    <td>Nombre:</td>
                    <td><input type="text" name="nombreI"></td>

                </tr>


                <tr>

                    <td>Descripcion:</td>
                    <td><textarea cols="30" rows="10" name="descripcionI"></textarea></td>

                </tr>


                <tr>

                    <td>Categoria:</td>
                    <td>


                        <select name="categoriaI">


                            <option value="comida"> Comida</option>
                            <option value="limpieza"> Limpieza</option>
                            <option value="Cocina"> Cocina</option>
                        </select>

                    </td>

                </tr>


                <tr>

                    <td>Precio:</td>
                    <td><input type="text" name="precioI"></td>

                </tr>

            </table>
            <input type="hidden" name="oculto">
            <input type="submit" value="Enviar">


        </form>

    </body>
</html>
