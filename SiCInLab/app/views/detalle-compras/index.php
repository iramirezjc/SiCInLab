<?php
use Core\Enlace;
ob_start(); 
?>
<style>
label.error {
    color: red;
    font-size: 0.9em;
    margin-top: 5px;
    display: block;
}
.registrar-producto {
      max-width: 200px;
      margin-left: 80%
}
</style>
<div class="detalle-compras-index">
    <div class="registrar-producto">
        <button  type="submit" name="agregar" id="registrar" value="registrar" class="btn btn-primary">+ Nuevo Producto</button>
        <div class="registro-categorias" id="regCategoria">
            <br>
            <table class=" table table-bordered" style="text-align: center;">
                <thead>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="<?= Enlace::url('mobiliarios/alta')?>"/>Nuevo Mobiliario</a></td>
                    </tr>
                    <tr>
                        <td><a href="<?= Enlace::url('reactivos/alta')?>"/>Nuevo Reactivo</a></td>
                    </tr>
                    <tr>
                        <td><a href="<?= Enlace::url('materiales/alta')?>"/>Nuevo Material</a></td>
                    </tr>
                    <tr>
                        <td><a href="<?= Enlace::url('equipos/alta')?>"/>Nuevo Equipo</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<!-------------------------FORMULARIO-------------------->
    <div class="container">
        <form id="formaGenerica" >
            <div class="formulario" style="background-color: #ECF0F1; text-align: center; margin-top: 2%" >
                <br>
                <table width="100%">
                    <thead>
                        <tr>
                            <th>No. de Compra:</th>
                            <th>Categoria:</th>
                            <th>Producto:</th>
                            <th>Cantidad:</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="fk_compr" id="fk_compr" 
                                value="<?= isset($compra['id_compr'])? $compra['id_compr'] : ''; ?>" disabled/>
                            </td>
                            <td>
                                <select class="form-select" name="categoria" id="categoria" aria-label="Default select example">
                                    <option selected>Seleccione una opcion</option>
                                    <?php foreach ($categorias as $categoria):?>
                                        <option value="<?= $categoria['id_categ']?>"><?= $categoria['nombr']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <select class="form-select" name="opciones" id="opciones" aria-label="Default select example">
                                    <option selected>Seleccione una opcion</option>
                                </select>
                            </td>
                            <td><input type="number" name="cantidad" id="cantidad" autocomplete="off"/></td>
                            <td> 
                                <button  type="submit" name="agregar" id="agregar" value="Agregar" class="btn btn-primary">Agregar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </div>
        </form>
    </div>
    <div class="container">
        <br>
        <!-------------------------------TABLA FINAL------------------------->
        <form method="POST" action="">
            <div id="formaTabla">
                <table id="miTabla" class=" table table-bordered">
                    <thead>
                      <tr>
                        <th>Categoria</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="text-end">
                    <button class="btn btn-success" id="finalizar" name="finalizar" >Registrar Compras</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="<?= BASE_JS .'detalleCompras.js'?>"></script>
<?php

$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Detalle de Compras';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>