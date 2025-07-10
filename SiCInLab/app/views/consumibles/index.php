<?php
ob_start(); 
?>
<div class="detalle-prestamo-consumible-index">
    <!-------------------------FORMULARIO-------------------->
    <div class="container">
        <div class="contenedorForma">
			<div class="container-titulo">
				<h5>Prestamos Consumibles</h5>
			</div>
            <form id="formaGenerica" >
                <div class="row" style="background-color: #B7834A; padding: 1rem; margin: 0 0 2rem 0;">
                    <div class="col-2">
                        <label>No. de Prestamo</label>
                        <input type="text" class="form-control" name="fk_compr" id="fk_compr" 
                        value="<?= isset($prestamo['id_prest_consu'])? $prestamo['id_prest_consu'] : ''; ?>" disabled/>
                    </div>
                    <div class="col-4">
                        <label>Nombre del reactivo</label>
                        <select class="form-select" name="reactivos" id="reactivos" aria-label="Default select example" autocomplete="off">
                            <option selected>Seleccione una opcion</option>
                            <?php foreach ($reactivos as $reactivo):?>
                                <option value="<?= $reactivo['id_react']?>"><?= $reactivo['react_nombr']?></option>
                            <?php endforeach; ?>
                        </select>                    
                    </div>
                    <div class="col-2">
                        <label>Cantidad Disponible</label>
                        <input type="text" name="disponible" id="disponible" class="form-control text-end" autocomplete="off" readonly/>
                    </div>
                    <div class="col-1">
                        <label>Unidad</label><br>
                        <label id="unidad"></label>
                    </div>
                    <div class="col-2">
                        <label>Cantidad Solicitada</label>
                        <input type="number" name="solicitada" id="solicitada" class="form-control text-end" autocomplete="off"/>
                    </div>
                    <div class="col-1">
                        <label></label>
                        <button  type="submit" name="agregar" id="agregar" value="Agregar" class="btn btn-primary">Agregar</button>
                    </div>
                </div>
            </form>
            <div id="formaTabla">
                <div class="row">
                    <div class="contenedorForma">
			            <div class="container-titulo">
			            	<h5>Lista Prestamos Consumibles</h5>
			            </div>
                        <form method="POST" action="">
                            <!-------------------------------lISTADO DE PRESTAMOS------------------------->
                            <table id="miTabla" class="tabla-general">
                                <thead>
                                  <tr>
                                    <th>Nombre del Reactivo</th>
                                    <th>Formula</th>
                                    <th>Cantidad Solicitada</th>
                                    <th>Unidades</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div class="text-end">
                                <button class="btn btn-success" id="registrar" name="registrar" >Registrar Prestamo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= BASE_JS .'prestamoConsumible.js'?>"></script>
<?php

$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Detalle Prestamo Consumible';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>