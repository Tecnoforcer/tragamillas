<?php require_once RUTA_APP.'/vistas/inc/header.php'; ?>
<?php //print_r ($datos)?>

    <?php foreach($datos["alumno"] as $Alumno): ?>
        <h1 style="text-align: center;"><?php echo $Alumno->nombre?> <?php echo $Alumno->apellido?></h1>
    <?php endforeach ?>

    <?php //print_r ($datos["marcas"])?>
    <h1>Falta ordenar</h1>
    <table class="table" id="">
        <thead>
            <tr>
                <th>Prueba</th>
                <th>Marca/Fecha</th>
            </tr>
        </thead>
            
            <?php foreach($datos["pruebas"] as $prueba):?>
                <tr>
                    <td><?php print_r($prueba->nombre)?></td>
                    <?php foreach($datos["marcas"] as $marca): ?>
                        <?php if($prueba->Id_prueba == $marca->Id_prueba): ?>

                            <td><?php print_r($marca->marca)?>/<?php print_r($marca->Fecha)?></td>

                        <?php endif ?>
                    <?php endforeach?>
                </tr>
            <?php endforeach ?>
            



<?php require_once RUTA_APP.'/vistas/inc/footer.php'; ?>