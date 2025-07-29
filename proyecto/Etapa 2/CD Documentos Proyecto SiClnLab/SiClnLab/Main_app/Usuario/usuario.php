<?php
  session_start();
  if (isset($_SESSION['usuario'])) {

       if ($_SESSION['usuario']['fk_nivel_usuar'] != '2') {
          
            header('Location: ../Usuario/usuario.php');
          
       }
  }else{

    header('Location: ../../');


  }
    $nombr_usuar=$_SESSION['usuario']['user_name'];
  $matri_usuar=$_SESSION['usuario']['id_matri'];
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SiCInlab</title>
    <link rel="icon" type="image/png" href="\SiClnLab\img\icono.png" />
  <link rel="stylesheet" href="/SiClnLab/Main_app/estilo.css" />
  </head>
  <body>
    <h1>¡Bienvenido  <?php echo($_SESSION['usuario']['user_name']);?> !</h1>
    <a href="/SiClnLab/Main_app/salir.php"><input type="button" id="eliminar" value="CERRAR SESIÓN"/></a>
    <?php include("Opciones.html");?>
     
    
  </body>
</html>
