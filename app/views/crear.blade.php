@extends('_template')

@section('cuerpo')

<?php
include_once MODEL_PATH . 'crear.php';
?>

<div class="container-fluid col-8">

    <!-- FORMULARIO DE AÑADIR TAREA -->
    <form method="post">
        <div class="form-group">
            <label for="contacto" class="col-form-label">Persona de contacto</label>
            <input id="contacto" name="contacto" type="text" class="form-control"  maxlength="140" value="<?= valorPost('contacto') ?>">
            <?= verError('contacto', $errores) ?>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="telefono" class="col-form-label">Teléfono</label>
                <input id="telefono" name="telefono" type="text" class="form-control" maxlength="20" value="<?= valorPost('telefono') ?>">
                <?= verError('telefono', $errores) ?>
            </div>
            <div class="form-group col-md-6">
                <label for="email" class="col-form-label">Email</label>
                <input id="email" name="email" type="text" class="form-control" maxlength="30" value="<?= valorPost('email') ?>">
                <?= verError('email', $errores) ?>
            </div>
        </div>

        <div class="form-group">
            <label for="descripcion" class="col-form-label">Descripción de la tarea</label>
            <textarea id="descripcion" name="descripcion" rows="3" maxlength="500" class="form-control"><?= valorPost('descripcion') ?></textarea>
            <?= verError('descripcion', $errores) ?>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="direccion" class="col-form-label">Dirección</label>
                <input id="direccion" name="direccion" type="text" class="form-control" maxlength="200" value="<?= valorPost('direccion') ?>">
                <?= verError('direccion', $errores) ?>
            </div>
            <div class="form-group col-md-6">
                <label for="poblacion" class="col-form-label">Población</label>
                <input id="poblacion" name="poblacion" type="text" class="form-control" maxlength="40" value="<?= valorPost('poblacion') ?>">
                <?= verError('poblacion', $errores) ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cp" class="col-form-label">CP</label>
                <input id="cp" name="cp" type="text" class="form-control" maxlength="5" value="<?= valorPost('cp') ?>">
                <?= verError('cp', $errores) ?>
            </div>
            <div class="form-group col-md-6">
                <label for="provincia" class="col-form-label">Provincia</label>
                <select id="provincia" name="provincia" class="custom-select">
                    <option value='' selected>Selecciona una Provincia</option>
                    <?php
                    foreach ($listaProvincias as $provincia) {
                        if (isset($_POST['provincia'])) {
                            if ($_POST['provincia'] != $provincia['cod']) {
                                echo '<option  value=' . $provincia['cod'] . '>' . $provincia['nombre'] . '</option>';
                            }
                            if ($_POST['provincia'] == $provincia['cod']) {
                                echo '<option  value=' . $provincia['cod'] . ' selected>' . $provincia['nombre'] . '</option>';
                            }
                        } else {
                            echo '<option  value=' . $provincia['cod'] . '>' . $provincia['nombre'] . '</option>';
                        }
                    }
                    ?>
                </select>
                <?= verError('provincia', $errores) ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label class="col-form-label">Estado</label>
                <div class="custom-controls-stacked">
                    <div class="custom-control custom-radio">
                        <input name="estado" id="estado_0" type="radio" class="custom-control-input" value="P" checked="checked">
                        <label for="estado_0" class="custom-control-label">Pendiente</label>
                    </div>
                </div>
                <div class="custom-controls-stacked">
                    <div class="custom-control custom-radio">
                        <input name="estado" id="estado_1" type="radio" class="custom-control-input" value="R">
                        <label for="estado_1" class="custom-control-label">Realizada</label>
                    </div>
                </div>
                <div class="custom-controls-stacked">
                    <div class="custom-control custom-radio">
                        <input name="estado" id="estado_2" type="radio" class="custom-control-input" value="C">
                        <label for="estado_2" class="custom-control-label">Cancelada</label>
                    </div>
                </div>
                <?= verError('estado', $errores) ?>
            </div>
            <div class="form-group col-md-5">
                <label for="operario" class="col-form-label">Operario</label>
                <select id="operario" name="operario" class="custom-select">
                    <option value='' selected>Selecciona un operario</option>
                    <?php
                    foreach ($listaOperarios as $operario) {
                        if (isset($_POST['operario'])) {
                            if ($_POST['operario'] != $operario['nombre']) {
                                echo '<option  value=' . $operario['nombre'] . '>' . $operario['nombre'] . '</option>';
                            }
                            if ($_POST['operario'] == $operario['nombre']) {
                                echo '<option  value=' . $operario['nombre'] . ' selected>' . $operario['nombre'] . '</option>';
                            }
                        } else {
                            echo '<option  value=' . $operario['nombre'] . '>' . $operario['nombre'] . '</option>';
                        }
                    }
                    ?>
                </select>
                <?= verError('operario', $errores) ?>
            </div>
            <div class="form-group col-md-5">
                <label for="fecha" class="col-form-label">Fecha de realización</label>
                <input id="fecha" name="fecha" type="text" class="form-control" maxlength="10" value="<?= valorPost('fecha') ?>">
                <?= verError('fecha', $errores) ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="anteriores" class="col-form-label">Anotaciones anteriores</label>
                <textarea id="anteriores" name="anteriores" cols="40" rows="5" maxlength="500" class="form-control"><?= valorPost('anteriores') ?></textarea>
                <?= verError('anteriores', $errores) ?>
            </div>

        </div>
        <div class="form-row">
            <div class="col text-center p-3">
                <input type='submit' value='Guardar tarea' class='btn btn-primary'>
                <a href='{{BASE_URL}}lista' class='btn btn-danger'>Cancelar</a>
            </div>
        </div>
    </form>
</div>

</html>

@endsection