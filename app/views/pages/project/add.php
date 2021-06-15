<?php include_once '../app/helpers/security.php'; ?>
<?php require_once PATH_APP.'/views/includes/header.php'; ?>
<?php require_once PATH_APP.'/views/includes/aside.php';   ?>

<div id="info">
    <div class="widget-info">
    <?php if(isset($_SESSION['error_register'])): ?>
                <ul>
                    <?php foreach ($_SESSION['error_register'] as $error) : ?>
                    <p><strong><?=$error?></strong></p>
                    <?php endforeach;?>
                </ul>
            <?php endif;

              Utils::deleteSession('error_register');
            ?>

            <?php if(isset($_SESSION['register_complete']))
                    echo $_SESSION['register_complete'];
                    Utils::deleteSession('register_complete');
            ?>    
        <article class="widget-tabla">
            <h3>Añadir Proyecto</h3>
                <form action="<?php echo PATH_URL ?>/Projects/addProject/" method="POST" enctype="multipart/form-data">
                
                
                    <label for="name">Nombre Proyecto:</label>
                    <input type="text" name="name" value="<?php echo $data['name'] ? $data['name'] : ''; ?>">
                
                
                    <label for="description">Descripción:</label>
                    <textarea type="text" name="description"><?php echo $data['description'] ? $data['description'] : ''; ?></textarea>


                    <label for="state">Estado:</label>
                    <select name="state">
                    <option value="Sin empezar" <?php if($data['state']=='Sin empezar'){echo 'seletected=""';} ?> >Sin empezar</option>
                        <option value="Comenzado" <?php if($data['state']=='Comenzado'){echo 'selected=""';} ?>>Comenzado</option>
                        <option value="Completado" <?php if($data['state']=='Completado'){echo 'selected=""';} ?>>Completado</option>
                        <option value="Cancelado" <?php if($data['state']=='Cancelado'){echo 'selected="';} ?>>Cancelado</option>
                    </select>

                    <label for="associated_task">Tarea:</label>
                    <textarea type="text" name="associated_task" ><?php echo $data['associated_task'] ? $data['associated_task'] : ''; ?></textarea> 

                    <label for="associated_note">Nota:</label>
                    <textarea type="text" name="associated_note"><?php echo $data['associated_note'] ? $data['associated_note'] : ''; ?></textarea> 

                    
                    <label for="client">Seleccione Cliente</label>
                    <select name="client">
                    <?php foreach($data['clients'] as $client) : ?>
                        <option value="<?php echo $client->id_cliente; ?>"><?php echo $client->nombre_cliente; ?></option>
                    <?php endforeach; ?>     
                    </select>
                      

                    <input type="submit" value="Registrar">
            </form>
        </article>

    </div>     
    
    
</div>

</section>

<?php require_once PATH_APP.'/views/includes/footer.php'; ?>