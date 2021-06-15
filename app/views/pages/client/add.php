<?php include_once '../app/helpers/security.php'; ?>
<?php require_once PATH_APP.'/views/includes/header.php'; ?>
<?php require_once PATH_APP.'/views/includes/aside.php'; ?>

<div id="info">
    <div class="widget-info">
    <?php if(isset($_SESSION['error_register'])): ?>
                <ul>
                    <?php foreach ($_SESSION['error_register'] as $error) : ?>
                    <p><strong><?php echo $error?></strong></p>
                    <?php endforeach;?>
                </ul>
            <?php endif;
             
             Utils::deleteSession('error_register');
                 
             
            ?>



            <?php if(!empty($_SESSION['register_complete'])){

                    echo $_SESSION['register_complete'];
                 
                    Utils::deleteSession('register_complete');
                 
            }
                   
            ?>    
        <article class="widget-tabla">
            <h3>Añadir Cliente</h3>
                <form action="<?php echo PATH_URL ?>/Clients/addClient/" method="POST" enctype="multipart/form-data">
                
                    <label for="logo">Logo:</label>
                    <input type="file" name="logo" accept=".jpg, .jpeg, .png, .gif" value="<?php echo $data['logo'] ? $data['logo'] : ''; ?>">
                
                
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" value="<?php echo $data['name'] ? $data['name'] : '';?>" required="">
                
                
                    <label for="cif">Cif:</label>
                    <input type="text" name="cif" value="<?php echo $data['cif'] ? $data['cif'] : ''; ?>" required="">

                    <label for="address">Direccion:</label>
                    <input type="text" name="address" value="<?php echo $data['address'] ? $data['address'] : ''; ?>" required="">

                    <label for="country">Pais:</label>
                    <input type="text" name="country" value="<?php echo $data['country'] ? $data['country'] : ''; ?>" required="">

                    <label for="email">Email:</label>
                    <input type="email" name="email" value="<?php echo $data['email'] ? $data['email'] : ''; ?>" required="">

                    <label for="telephone">Telefono:</label>
                    <input type="text" name="telephone" value="<?php echo $data['telephone'] ? $data['telephone'] : ''; ?>" required="">

                    <label for="contact_person">Persona Contacto:</label>
                    <input type="text" name="contact_person" value="<?php echo $data['contact_person'] ? $data['contact_person'] : ''; ?>" required="">

                    <label for="notes">Notas:</label>
                    <input type="text" name="notes" value="<?php echo $data['notes'] ? $data['notes'] : ''; ?>" required="">

                    <label for="website">Pagina web:</label>
                    <input type="text" name="website" value="<?php echo $data['website'] ? $data['website'] : ''; ?>" required="">

                    <input type="submit" value="Registrar Cliente">
            </form>
        </article>

    </div>     
    
</div>

</section>

<?php require_once PATH_APP.'/views/includes/footer.php'; ?>