<?php
  session_start();
  if (isset($_SESSION['usuario'])) {
$usuario_nombre=$_SESSION['usuario']['nombr'];

       if ($_SESSION['usuario']['fk_nivel_usuar'] != '1') {
         
            header('Location: ../Admin/admin.php');
          
       }
  }else{

    header('Location: ../../');


  }
  $nombr_usuar=$_SESSION['usuario']['user_name'];
  $matri_usuar=$_SESSION['usuario']['id_matri'];
 /*
  echo($_SESSION['usuario']['nombr']);
  echo($_SESSION['usuario']['fk_nivel_usuar']);
  echo($_SESSION['usuario']['id_matri']);
  echo($_SESSION['usuario']['user_name']);
  */
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="stylesheet" href="/SiClnLab/Main_app/estilo.css" />
     <link rel="icon" type="image/png" href="\SiClnLab\img	\icono.png" />	
     <title></title>
   </head>
   <body>
<h1>¡Bienvenido <?php echo($nombr_usuar);?> !</h1>
      <a href="/SiClnLab/Main_app/salir.php"><input type="button" id="eliminar" value="CERRAR SESIÓN"/></a>
<?php 
include("Opciones.html");
;?>  


     
   </body>
 </html>
