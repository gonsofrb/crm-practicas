<?php include_once '../app/helpers/security.php'; ?>
<?php require_once PATH_APP.'/views/includes/header.php'; ?>
<?php require_once PATH_APP.'/views/includes/aside.php';   ?>

<div id="info">
    <div class="widget-info">
    <?php if(isset($_SESSION['error_edit'])): ?>
                <ul>
                    <?php foreach ($_SESSION['error_edit'] as $error) : ?>
                    <p><strong><?=$error?></strong></p>
                    <?php endforeach;?>
                </ul>
            <?php endif; ?>

            <?php if(isset($_SESSION['edit_complete']))
                    echo $_SESSION['edit_complete'];
            ?>    
        <article class="widget-tabla">
            <h3>Modificar Datos Proyecto</h3>
                <form action="<?php echo PATH_URL ?>/Projects/saveProject/" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="edit_project_id" value="<?= $data['id_project']; ?>">

                    <label for="name">Nombre Proyecto:</label>
                    <input type="text" name="name" value="<?= $data['name'] ? $data['name'] : '' ?>">
                
                
                    <label for="description">Descripción:</label>
                    <textarea type="text" name="description" ><?php echo  $data['description'] ? $data['description'] : '' ?></textarea>


                    <label for="state">Estado:</label>
                    <select name="state">
                        <option value="Sin empezar" <?php if($data['state']=='Sin empezar'){echo 'seletected=""';} ?> >Sin empezar</option>
                        <option value="Comenzado" <?php if($data['state']=='Comenzado'){echo 'selected=""';} ?>>Comenzado</option>
                        <option value="Completado" <?php if($data['state']=='Completado'){echo 'selected=""';} ?>>Completado</option>
                        <option value="Cancelado" <?php if($data['state']=='Cancelado'){echo 'selected="';} ?>>Cancelado</option>
                    </select>

                    <label for="associated_task">Tarea:</label>
                    <textarea type="text" name="associated_task" ><?= $data['associated_task'] ? $data['associated_task'] : '' ?></textarea> 

                    <label for="associated_note">Nota:</label>
                    <textarea type="text" name="associated_note"><?= $data['associated_note'] ? $data['associated_note'] : '' ?></textarea> 

                    
                    <label for="client">Seleccione Cliente</label>
                    <select name="client">
                    <?php foreach($data['clients'] as $client) : ?>
                        <option value="<?= $client->id_cliente; ?>" ><?=$client->nombre_cliente; ?></option>
                    <?php endforeach; ?>     
                    </select>
                      

                    <input type="submit" value="Registrar">
            </form>
        </article>

    </div>     
    <?php Utils::deleteSession('error_edit'); ?>
    <?php Utils::deleteSession('edit_complete'); ?>
    
</div>

</section>

<?php require_once PATH_APP.'/views/includes/footer.php'; ?>