<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Estilos-->
    <link href="<?=BASE_URL?>css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    
    <link rel="stylesheet" href="<?= BASE_STYLE?>/web/css/login.css">
    <!--SCRIPTS-->
    <script src="<?=BASE_URL?>js/jquery-3.7.1.min.js"></script>
    <script src="<?=BASE_URL?>js/jquery.validate.min.js"></script>
    <link rel="icon" type="image/png" href="<?= BASE_STYLE?>/web/img/escudo_letras.png" />
    <title >SiCInLab</title>
  </head>
  <body>
    <img src="<?= BASE_STYLE?>/web/img/escudo_itsh.png"  style="top:0%; position:  fixed;left: 30%; width: 40%; "/>
    <div class="inicioSesion" >
        <form action="POST" id="formInicioSesion">
            <div class="mb-3">
                <h1>SiCInLab</h1>
            </div>
            <div class="mb-3">
                <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Matricula" autocomplete="off" required/>
            </div>
            <div class="mb-3">
                <input type="password" id="clave" name="clave" class="form-control"  placeholder="Contraseña" autocomplete="off" required>
            </div>
            <div class="mb-3">
                 <button type="submit" id="iniciar" name="iniciar" >Iniciar sesion</button>
            </div>
        </form>
    </div>
    <!--<script src="js/main.js"></script>-->
    <script src="<?= BASE_JS .'sitio.js'?>"></script>
  </body>
</html>