<?php include_once '../app/helpers/security.php'; ?>
<?php require_once PATH_APP.'/views/includes/header.php';   ?>
<?php require_once PATH_APP.'/views/includes/aside.php';   ?>


<div id="info">
    <div class="widget-info">
        <article class="widget-tabla">
            <h3>Listado de Clientes</h3>
            <table class="table" id="tablaClient">
                <a href="<?php echo PATH_URL ?>/Clients/addClient/"><i class="fas fa-user-plus"></i> Agregar Cliente</a>
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>
                      
                    </tr>
                </thead>
                <tbody>
                <?php foreach($data['clients'] as $client) : ?>
                    <tr>
                            <?php if($client->logo != null) :  ?>
                        <td><img src="<?php echo PATH_URL ?>/img_client/<?php echo $client->logo;?>" alt="logo de cliente"></td>
                            <?php else: ?>
                        <td><img src="<?php echo PATH_URL ?>/img_client/paisaje.jpg" alt="logo cliente por defecto"></td>
                            <?php endif; ?>
                        <td><?php echo $client->nombre_cliente; ?></td>
                        <td><?php echo $client->telefono; ?></td>
                        <td><?php echo $client->email; ?></td>
                        <td><a href="<?php echo PATH_URL ?>/Clients/editClient/&id=<?php echo $client->id_cliente; ?>"><i class="fas fa-edit"></i></a></td>
                        <td><a href="<?php echo PATH_URL ?>/Clients/deleteClient/&i=<?php echo $client->id_cliente; ?>"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table> 
        </article>
       
    </div>

</div>

</section>

<?php require_once PATH_APP.'/views/includes/footer.php'; ?>