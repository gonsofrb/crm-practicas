<?php include_once '../app/helpers/security.php'; ?>
<?php require_once PATH_APP.'/views/includes/header.php';   ?>
<?php require_once PATH_APP.'/views/includes/aside.php';   ?>


<!--Restringir el acceso al controlador User -->
<?php  if($_SESSION['rol_crm']!=1){
    require_once '../app/controllers/Tasks.php';

    $taks = new Tasks();
    $taks->index();
}  ?>

<div id="info">
    <div class="widget-info">
        <article class="widget-tabla">
            <h3>Listado de Usuarios</h3>
            <table class="table" id="tablaClient">
                <a href="<?php echo PATH_URL ?>/Users/addUser/"><i class="fas fa-user-plus"></i> Agregar Usuario</a> 
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Empresa</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Imagen</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($data['users'] as $user) : ?>
                    <tr>
                        <td><?php echo $user->nombre; ?></td>
                        <td><?php echo $user->nombre_usu; ?></td>
                        <td><?php echo $user->rol; ?></td>
                        <td><?php echo $user->empresa; ?></td>
                        <td><?php echo $user->email; ?></td>
                        <td><?php echo $user->telefono; ?></td>
                        <?php if($user->imagen != null) :  ?>
                        <td><img src="<?php echo PATH_URL ?>/img_user/<?php echo $user->imagen;?>" alt="imagen de usuario"></td>
                            <?php else: ?>
                        <td><img src="<?php echo PATH_URL ?>/img_user/Avatar.png" alt="imagen usuario por defecto"></td>
                            <?php endif; ?>
                        <td><a href="<?php echo PATH_URL ?>/Users/editUser&i=<?=  Controller::encryption($user->id_usuario); ?>"><i class="fas fa-edit"></i></a></td>
                        <td><a href="<?php echo PATH_URL ?>/Users/deleteUser&i=<?= Controller::encryption($user->id_usuario); ?>"><i class="fas fa-trash-alt"></i></a></td>
                       

                        
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table> 
        </article>
       
    </div>

</div>

</section>

<?php require_once PATH_APP.'/views/includes/footer.php'; ?>