<?php
ob_start(); 
?>
<div class="detalle-prestamo-consumible-index">
    <!-------------------------FORMULARIO-------------------->
    <div class="container">
        <div class="contenedorForma">
			<div class="container-titulo">
				<h5>Registrar Prestamo</h5>
			</div>
            <div class="filtro" style="margin: 0 0 1rem 0;">
                <label>Categorias</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="filtrar" id="radio0" value="0" checked>
                    <label class="form-check-label" for="radio0">
                      Todos
                    </label>
                </div>
                <?php foreach($categorias as $categoria): ?>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="filtrar" id="radio<?= $categoria['id_categ'] ?>" value="<?= $categoria['id_categ'] ?>">
                      <label class="form-check-label" for="radio<?= $categoria['id_categ'] ?>">
                        <?= $categoria['nombr'] ?>
                      </label>
                    </div>
                <?php endforeach; ?>
            </div>
            <form id="formaGenerica">
                <div class="row" style="background-color: #B7834A; padding: 1rem; margin: 0 0 2rem 0;">
                    <div class="col-2">
                        <label>No. de Prestamo</label>
                        <input type="text" class="form-control" name="idPrestamo" id="idPrestamo" 
                        value="<?= $prestamo['id_prest']; ?>" disabled/>
                    </div>
                    <div class="col-3">
                        <label>Articulo</label>
                        <input class="form-control" list="opciones" id="busqueda" name="busqueda" placeholder="Buscar..." autocomplete="off">
                        <datalist id="opciones">
                        </datalist>                    
                    </div>
                    <div class="col-3">
                        <label>Cantidad Disponible</label>
                        <input type="text" name="disponible" id="disponible" class="form-control text-end" autocomplete="off" readonly/>
                    </div>
                    <div class="col-3">
                        <label>Cantidad Solicitada</label>
                        <input type="number" name="solicitada" id="solicitada" class="form-control text-end" autocomplete="off"/>
                    </div>
                    <div class="col-1">
                        <label></label>
                        <button  type="submit" name="agregar" id="agregar" value="agregar" class="btn btn-primary">Agregar</button>
                    </div>
                </div>
            </form>
            <div id="formaTabla">
                <div class="row">
                    <div class="contenedorForma">
			            <div class="container-titulo">
			            	<h5>Detalle de Prestamo</h5>
			            </div>
                        <form method="POST" action="">
                            <!-------------------------------lISTADO DE PRESTAMOS------------------------->
                            <table id="miTabla" class="tabla-general">
                                <thead>
                                  <tr>
                                    <th>Categoria</th>
                                    <th>Articulos</th>
                                    <th>Cantidad Solicitada</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div class="text-end" style="margin: 2rem 0 0 0;">
                                <button class="btn btn-success" id="registrar" name="registrar" >Registrar Prestamo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= BASE_JS .'detallePrestamo.js'?>"></script>
<?php
$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Detalle Prestamo';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>