<?php include_once '../app/helpers/security.php'; ?>
<?php require_once PATH_APP.'/views/includes/header.php'; ?>
<?php require_once PATH_APP.'/views/includes/aside.php';   ?>


<!--Solo tiene acceso admin -->
<?php  if($_SESSION['rol_crm']!=1){
    require_once '../app/controllers/Tasks.php';

    $taks = new Tasks();
    $taks->index();
}  ?>


<div id="info">
    <div class="widget-info">
        <article class="widget-tabla">

        <?php if(isset($_SESSION['error_edit'])): ?>
            <ul>
                    <?php foreach ($_SESSION['error_edit'] as $errors) : ?>
                    <p><strong><?=$errors?></strong></p>
                    <?php endforeach;?>
            </ul>
        <?php elseif(isset($_SESSION['edit_complete'])): ?>               
            <strong><?=$_SESSION['edit_complete']?></strong>

        <?php endif; ?> 

            <h2>Modificar datos</h2>
            
                <form action="<?= PATH_URL."/Users/saveUser/";?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_user_id" value="<?= $data['id']; ?>">
                    
                
                    <label for="name">Nombre:</label>
                    <input type="text" name="name"  value="<?=  $data['name'] ? $data['name'] : ''; ?>" required="" >
                
                
                    <label for="user">Usuario:</label>
                    <input type="text" name="user" value="<?= $data['user'] ? $data['user'] : '' ?>">

                    <label for="rol">Rol:</label>
                    <input type="number" name="rol" value="<?= $data['rol'] ? $data['rol'] : ''; ?>" required="">

                    <label for="company">Empresa:</label>
                    <input type="text" name="company" value="<?= $data['company'] ? $data['company'] : ''; ?>" required="">

                    <label for="email">Email:</label>
                    <input type="email" name="email" value="<?= $data['email'] ? $data['email'] : ''; ?>" required="">

                    <label for="telephone">Telefono:</label>
                    <input type="text" name="telephone" value="<?= $data['telephone'] ? $data['telephone'] : ''; ?>" required="">

                    <label for="image">Imagen:</label>
                    <input type="file" name="image" accept=".jpg, .jpeg, .png, .gif" value="<?= $data['image'] ?  $data['image'] : '' ;?>">
                
                   
                    <input type="submit" value="Enviar">
            </form>
        </article>
       
    </div>
    <?php Utils::deleteSession('error_edit'); ?>
    <?php Utils::deleteSession('edit_complete'); ?>

</div>

</section>

<?php require_once PATH_APP.'/views/includes/footer.php'; ?>