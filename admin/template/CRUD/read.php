<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require 'clases/Conexion.php';    // put your code here
require 'clases/CRUD.php';

@$criterio = $_POST['criterio'];

$model = new CRUD;
$model->select = '*';
$model->from = 'productos';

if (isset($criterio)) {
    $model->condition = "ID=" . $criterio . "";
}


$model->Read();
$filas = $model->rows;
$total = count($filas);
?>
<html>
    <head lang="es">
        <meta charset="UTF-8">
        <title>Read</title>


        <style type="text/css">
            tr:nth-child(2n+1){
                background-color:#E5DCD1;


            }

            td{

                padding-bottom: 10px;
            }

            body{

                text-align:center;
            }

            a{

                float: left;
            }
        </style>
    </head>
    <body>

        <h1>CRUD::Read</h1>
        <strong>El numero de filas es: <?php echo $total; ?></strong>
        <a href="create.php" title="Create" >Create</a>

        <form action="" method="POST">
            Escribe el ID: <input type="text" name="criterio">
            <input type="submit" value="Enviar">
        </form>
        <table align='center'>


            <tr>

                <td>ID</td>
                <td>Nombre</td>
                <td>Descripcion</td>
                <td>Categoria</td>
                <td>Precio</td>
                <td>Actualizar</td>
                <td>Eliminar</td>
            </tr>
            <?php
            foreach ($filas as $fila) {

                echo "<tr>";

                echo "<td>" . $fila['ID'] . "</td>";
                echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['descripcion'] . "</td>";
                echo "<td>" . $fila['categoria'] . "</td>";
                echo "<td>" . $fila['precio'] . "</td>";

                echo "<td><a href='delete.php?ID=" . $fila['ID'] . "' >Eliminar</a></td>";
                echo "<td><a href='update.php?ID=" . $fila['ID'] . "' >Actualizar</a></td>";

                echo "</tr>";
            }
            ?>

        </table>
    </body>
</html>
