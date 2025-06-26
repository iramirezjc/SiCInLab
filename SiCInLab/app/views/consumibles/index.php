<?php
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
<div class="detalle-prestamo-consumible-index">
<!-------------------------FORMULARIO-------------------->
    <div class="container">
        <form id="formaGenerica" >
            <div class="formulario" style="background-color: #ECF0F1; text-align: center; margin-top: 2%" >
                <br>
                <table width="100%">
                    <thead>
                        <tr>
                            <th>No. de Prestamo:</th>
                            <th>Nombre del reactivo:</th>
                            <th>Cantidad Disponible:</th>
                            <th>Unidad:</th>
                            <th>Cantidad Solicitada:</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="fk_compr" id="fk_compr" 
                                value="<?= isset($prestamo['id_prest_consu'])? $prestamo['id_prest_consu'] : ''; ?>" disabled/>
                            </td>
                            <td>
                                <select class="form-select" name="reactivos" id="reactivos" aria-label="Default select example" autocomplete="off">
                                    <option selected>Seleccione una opcion</option>
                                    <?php foreach ($reactivos as $reactivo):?>
                                        <option value="<?= $reactivo['id_react']?>"><?= $reactivo['react_nombr']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><input type="text" name="disponible" id="disponible" autocomplete="off" readonly/></td>
                            <td><label id="unidad"></label></td>
                            <td><input type="number" name="solicitada" id="solicitada" autocomplete="off"/></td>
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
            </div>
        </form>
    </div>
</div>
<script src="<?= BASE_JS .'prestamoConsumible.js'?>"></script>
<?php

$contenido = ob_get_clean();  // Guarda el contenido y limpia el buffer
$titulo = 'Detalle Prestamo Consumible';          // Puedes personalizar el título desde aquí
require BASE_APP . '/views/layouts/app.php';  // Usa el layout
?>