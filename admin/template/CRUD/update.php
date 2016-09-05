<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require 'clases/conexion.php';
require 'clases/CRUD.php';

if (isset($_REQUEST['ID'])) {
    $id = htmlspecialchars($_REQUEST['ID']);
    $model = new CRUD;
    $model->select = "*";
    $model->from = "productos";
    $model->condition = "ID=$id";
    $model->Read();
    $filas = $model->rows;
    foreach ($filas as $fila) {

        $nombre = $fila['nombre'];
        $descripcion = $fila['descripcion'];
        $categoria = $fila['categoria'];
        $precio = $fila['precio'];
    }
}
$mensaje = null;

if (isset($_POST['update'])) {

    $id_producto = ($_POST['idI']);
    $nombre = htmlspecialchars($_POST['nombreI']);
    $descripcion = htmlspecialchars($_POST['descripcionI']);
    $precio = $_POST['precioI'];

    $model = new CRUD;
    $model->update = "productos";


    $model->set = "nombre='$nombre', descripcion='$descripcion', precio=$precio";
    $model->condition = "ID = $id";
    $model->Update();
    $mensaje = $model->mensaje;
}
?>
<html>
    <head>

      <link type="text/css" rel="stylesheet" href="estilos.css" />
        <meta charset="UTF-8">
        <title>Actualizar</title>
    </head>
    <body>

        <h1>CRUD::Actualizar</h1>
        <h2><?php
            echo "<span>$mensaje</span>";

            echo "<h2>Realmente quieres eliminar el elemento con ID $id</h2>";
            ?>


        </h2>


        <a href="read.php" >Regresar a la lista de productos</a><br/>
        <a href="create.php" >Crear registro</a>
        <form action="" method="POST">
            <table align='center'>

                <tr>

                    <td>Nombre:</td>
                    <td><input type="text" value="<?php echo $nombre; ?>" name="nombreI"></td>

                </tr>


                <tr>

                    <td>Descripcion:</td>
                    <td><textarea cols="30" rows="10" name="descripcionI" ><?php echo $descripcion; ?></textarea></td>

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
                    <td><input value="<?php echo $precio; ?>" type="text" name="precioI"></td>

                </tr>

            </table>
            <input type="hidden" name="update">
            <input type="hidden" name="idI" value="">
            <input type="submit" value="Actualizar">


        </form>
    </body>
</html>
