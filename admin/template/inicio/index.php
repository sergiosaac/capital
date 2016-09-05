<?php require '../layout1.php'; ?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">
            Bienvenido <small> <?= $usuario[0]['full_name'] ?> </small>
        </h3>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Inicio
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
      
      <div class="well"><p>Le invitamos a probar la versión <strong>BETA</strong> del administrador de su portal web. Puede cargar la 
        información refente a los vehículos e inmuebles que tiene en stock. Esa infomación debe ser válida asi podremos reutilizar en la versión final del
        producto.</p></div>
      
       <div class="well"><p>Ante consultas a las ordenes.</p></div>
      
    </div>
</div>

<?php require '../layout2.php'; ?>