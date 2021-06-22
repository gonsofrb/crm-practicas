<?php include_once '../app/helpers/security.php'; ?>
<?php require_once PATH_APP.'/views/includes/header.php'; ?>
<?php require_once PATH_APP.'/views/includes/aside.php';   ?>



<div id="info">
    <div class="widget-info">
        <article class="widget-tabla">
            <h3>Listado de Proyectos</h3>
            <table class="table" id="tablaClient">
                <a href="<?php echo PATH_URL ?>/Projects/addProject/"><i class="fas fa-user-plus"></i> Agregar Proyecto</a>
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Proyecto</th>
                        <th>Descripcion</th>
                        <th>Estado</th>
                        <th>Tarea</th>
                        <th>Nota</th>

                <?php if($_SESSION['rol_crm']==1 || $_SESSION['rol_crm']<=2) { ?>
                        <th>Acciones</th>

                <?php } ?>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($data['projects'] as $project) : ?>
                    <tr>
                        <td><?= $project->nombre_cliente; ?></td>
                        <td><?= $project->nombre_proyecto; ?></td>
                        <td><?= $project->descripcion; ?></td>
                        <td><?= $project->estado; ?></td>
                        <td><?= $project->tarea_asociada; ?></td>
                        <td><?= $project->nota_asociada; ?></td>

                        <?php if($_SESSION['rol_crm']==1 || $_SESSION['rol_crm'] == 2) {?>
                        <td><a href="<?php echo PATH_URL ?>/Projects/editProject&id=<?= Controller::encryption($project->id_proyecto);  ?>"><i class="fas fa-edit"></i></a>
                        <?php } ?>

                        <?php if($_SESSION['rol_crm']==1){?>
                        <a href="<?php echo PATH_URL ?>/Projects/deleteProject&i=<?= Controller::encryption($project->id_proyecto);  ?>"><i class="fas fa-trash-alt"></i></a>
                        <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>    
                </tbody>
            </table> 
        </article>
       
    </div>

</div>

</section>











<?php require_once PATH_APP.'/views/includes/footer.php'; ?>