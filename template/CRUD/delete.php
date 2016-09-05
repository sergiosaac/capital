<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
require 'clases/CRUD.php';
require 'clases/Conexion.php';

$mensaje = null;
$aux = $_GET['ID'];
if (isset($_POST['delete'])) {
    $model = new CRUD;
    $model->deletefrom = "productos";
    $model->condition = "ID=$aux";
    $model->Delete();
    $mensaje = $model->mensaje;
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Delete</title>

        <link type="text/css" rel="stylesheet" href="estilos.css" />


    </head>
    <body>

        <h1>CRUD:: Delete</h1>
        <span> <?php echo $mensaje; ?></span><br/>
        <a href="read.php" >Regresar a la lista de productos</a><br/>
        <a href="create.php" >Crear registro</a>

        <?php if (isset($_GET['ID'])) { ?>

            <h2>Realmente quieres eliminar el elemento con ID <?php echo $_GET['ID']; ?></h2>
            <form method="POST" action="">



                <input type="hidden" name="delete">
                <input type="hidden" name="ID" value="<?php echo htmlspecialchars($_GET['id']) ?>">
                <input type="submit" value="Eliminar">


            </form>
        <?php } ?>


    </body>
</html>
