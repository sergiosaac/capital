<?php
  
  if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"]==null){
  //  print "<script>alert(\"Acceso invalido!\");window.location='login.php';</script>";
    if(!empty($_POST)){
      if(isset($_POST["username"]) &&isset($_POST["password"])){
        if($_POST["username"]!=""&&$_POST["password"]!=""){
          
          $user_id = null;          
          $admin = $_POST["username"];
          include "../template/CRUD/clases/Conexion.php";
          include "../template/CRUD/clases/CRUD.php";

          $model = new CRUD;
          $model->select = '*';
          $model->from = 'users';

          $model->condition = "usuario='" . $_POST["username"] . "' and password='".$_POST["password"]."'";
          $model->Read();
          $filas = $model->rows;          

          $user_id=$filas[0]['id'];
          

          if($user_id==null){
            
            $error = 1;    
           // print "<script>alert(\"Acceso invalido.\");window.location='/login/';</script>";
          }else{
            session_start();
            $_SESSION["user_id"]=$user_id;
            $data_sesion = ['full_name' => $filas[0]['full_name']];
            print "<script>window.location='../template/inicio/';</script>";				
           
          }
        }
      }
   }   
  }
?>

<!DOCTYPE html>
<html lang="es">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login Capital SA</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
            
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>CAPITAL SA</strong> Admin</h1>
                            <div class="description">
                                <p>
                                    Favor realizar las pruebas de carga de informacion en el administrador de su sitio web
                                    por el momento en esta version BETA solo se podra cargar vehiculos.
                                    <strong> Importante! La informacion tiene que ser valida, ya que una vez terminado se pueda utilizar en la web para los clientes </strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Ingresa para administrar</h3>
                                    <p>Soporte y consultas, info@exilonsoluciones.com</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <form role="form" action="" method="post" class="login-form">
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Usuario</label>
                                        <input type="text" name="username" placeholder="Usuario..." class="form-username form-control" id="form-username">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Password</label>
                                        <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
                                    </div>
                                  
                                    <?php if(isset($error)){ ?>
                                      <div class="alert alert-danger" role="alert">Credenciales no válidas, vuelve a ingresar.</div>
                                    <?php } ?>
                                  
                                    <button type="submit" class="btn">Entrar!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>