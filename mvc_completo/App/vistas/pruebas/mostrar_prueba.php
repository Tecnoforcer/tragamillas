<?php require_once RUTA_APP.'/vistas/inc/header.php';?>

<?php //print_r($datos);?>

<div class="table-responsive">
    <h1><?php print_r($datos['Usuario']->nombre)?> <?php print_r($datos['Usuario']->apellido)?></h1>
    <table class="table table-hover">

        <thead>  
            <th>Prueba</th>
            <th>Fecha</th>
            <th>Marca</th>
        </thead>
        <?php foreach($datos['usuarioTest'] as $test): ?>
            <?php foreach($datos['pruebas'] as $prueba):?>
                <tr>
                    <?php if ($prueba->Id_prueba == $test->Id_prueba ) { ?>
                        <td><?php print_r($prueba->nombre)?></td>
                        <td><?php print_r($test->Fecha) ?></td>
                        <td><?php print_r($test->marca)?></td>
                    <?php } ?>
                </tr>
            <?php endforeach;?>
        <?php endforeach;?>
        


    </table>
</div>

<?php require_once RUTA_APP.'/vistas/inc/footer.php' ;?>