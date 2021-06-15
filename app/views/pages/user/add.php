<?php include_once '../app/helpers/security.php'; ?>
<?php require_once PATH_APP.'/views/includes/header.php'; ?>
<?php require_once PATH_APP.'/views/includes/aside.php';   ?>

<div id="info">
    <div class="widget-info">
    <?php if(isset($_SESSION['error_register'])): ?>
                <ul>
                    <?php foreach ($_SESSION['error_register'] as $error) : ?>
                    <p><strong><?php echo $error?></strong></p>
                    <?php endforeach;?>
                </ul>
            <?php endif;?>

            <?php if(isset($_SESSION['register_complete']))
                    echo $_SESSION['register_complete'];
            ?>    
        <article class="widget-tabla">
            <h3>Añadir Usuario</h3>
                <form action="<?php echo PATH_URL ?>/Users/addUser/" method="POST" enctype="multipart/form-data">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name">
                
                
                    <label for="user">Usuario:</label>
                    <input type="text" name="user">

                    <label for="password">Contrase&ntilde;a:</label>
                    <input type="password" name="password">

                    <label for="rol">Rol:</label>
                    <input type="number" name="rol" >

                    <label for="company">Empresa:</label>
                    <input type="company" name="company" >

                    <label for="email">Email:</label>
                    <input type="email" name="email" >

                    <label for="telephone">Tel&eacute;fono:</label>
                    <input type="text" name="telephone">

                    <label for="image">Imagen:</label>
                    <input type="file" name="image" accept=".jpg, .jpeg, .png, .gif">

                    <input type="submit" value="Registrar Usuario">
            </form>
        </article>

    </div>     
   
</div>

</section>

<?php require_once PATH_APP.'/views/includes/footer.php'; ?>