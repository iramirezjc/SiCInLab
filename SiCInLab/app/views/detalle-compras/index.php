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
</style>
<div class="detalle-compras-index">
    <div class="container">
        <div class="contenedorForma">
		    <div class="container-titulo">
		    	<h5>Detalle Compras</h5>
		    </div>
            <div class="row" style="margin: 0 0 1rem 0;">
                <div class="col-9">
                    <div class="registro-categorias" id="regCategoria">
                        <div class="row">
                            <div class="col-3">
                                <a class="btn btn-success" href="<?= Enlace::url('mobiliarios/alta')?>">Nuevo Mobiliario</a>
                            </div>
                            <div class="col-3">
                                <a class="btn btn-success" href="<?= Enlace::url('reactivos/alta')?>">Nuevo Reactivo</a>
                            </div>
                            <div class="col-3">
                                <a class="btn btn-success" href="<?= Enlace::url('materiales/alta')?>">Nuevo Material</a>
                            </div>
                            <div class="col-3">
                                <a class="btn btn-success" href="<?= Enlace::url('equipos/alta')?>">Nuevo Equipo</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="registrar-producto text-center">
                        <button type="submit" name="agregar" id="registrar" value="registrar" class="btn btn-primary">
                            <i class="bi bi-plus">Nuevo Producto</i>
                        </button>
                    </div>
                </div>
            </div>
            <!-------------------------FORMULARIO-------------------->
            <form id="formaGenerica">
                <div class="row" style="background-color: #B7834A; padding: 1rem;">
                    <div class="col-2">
                        <label>No. de Compra</label>
                        <input type="text" class="form-control" name="fk_compr" id="fk_compr" 
                        value="<?= isset($compra['id_compr'])? $compra['id_compr'] : ''; ?>" disabled/>
                    </div>
                    <div class="col-3">
                        <label>Categoria</label>
                        <select class="form-select" name="categoria" id="categoria" aria-label="Default select example">
                            <option selected>Seleccione una opcion</option>
                            <?php foreach ($categorias as $categoria):?>
                                <option value="<?= $categoria['id_categ']?>"><?= $categoria['nombr']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-3">
                        <label>Producto</label>
                        <select class="form-select" name="opciones" id="opciones" aria-label="Default select example">
                            <option selected>Seleccione una opcion</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label>Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control text-end" autocomplete="off"/>
                    </div>
                    <div class="col-1 text-center">
                        <label> </label>
                        <button  type="submit" name="agregar" id="agregar" value="Agregar" class="btn btn-primary">Agregar</button>
                    </div>                        
                </div>
            </form>
            <!--Tabla de Detalle-->
            <div id="formaTabla">
                <div class="row" style="margin: 2rem 0 0 0;">
                    <div class="contenedorForma">
		                <div class="container-titulo">
		        	        <h5>Lista de Compras</h5>
		                </div>
                        <form method="POST" action="">
                        <table id="miTabla" class="tabla-general">
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
                        <div class="text-end" style="margin: 2rem 0 0 0;">
                            <button class="btn btn-success" id="finalizar" name="finalizar" >Registrar Compras</button>
                        </div>
                        </form>
                    </div>
                </div> 
            </div><!-- Termina Tabla de Detalle-->
        </div>
    </div>
</div>
<script src="<?= BASE_JS .'detalleCompras.js'?>"></script>
<?php
$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Detalle de Compras';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>