<?php 
include("../usuario.php");
 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="../incidentes/css/incidente.css">
    
</head>

<style type="text/css" media="screen">
    textarea{
            max-width: 200px;
            max-height: 100px;
            height: 100px;
            width: 400px;
            min-height: 100px;
            min-width: 400px;

        }

        label{
            display: inline-block;
            width: 150px;
        }

        input[type="text"]{
            font-size: 14px;
            height: 20px;
        }

        img{

            width: 100%;
            height: 100%
        }

        .mensaje{
            margin:10px 10px 10px 0px;
            text-align: center;

        }

</style>

<body>

    <form action="datos.php" method="POST" accept-charset="utf-8">

        <div class="titulo">
            <h1>Reporte de incidencias</h1>
        </div>

        <label> Fecha de incidencias:</label>
        <input type="date" name="fecha" required="true"> <br><br>

        <label>Descripcion:</label>
        <textarea name="descripcion"></textarea><br><br>

        <label>Matricula:</label> <br>
        <input type="text" name="matricula" value="<?php echo($matri_usuar)?>" disabled=""> <br> <br>

        <div class="botones">

            <input type="submit" name="generar" value="Generar">

           <a href="\SiClnLab\Main_app\Admin\admin.php"> <input type="button"  id="eliminar" value="Cancelar"></a>

        </div>

        <div class="mensaje" style="width: 400px; height: 50px;">
            <?php 
        if (isset($_SESSION["Mensaje"])) {
        echo $_SESSION["Mensaje"];
        unset($_SESSION["Mensaje"]);
        }
             ?>
        </div>

    </form> 
</body>
</html>