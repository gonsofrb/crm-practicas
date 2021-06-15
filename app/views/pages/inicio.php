<?php include_once '../app/helpers/security.php'; ?>
<?php require_once PATH_APP.'/views/includes/header.php';   ?>
<?php require_once PATH_APP.'/views/includes/aside.php';   ?>


<div id="info">
    <div class="widget-info">
        <article class="widget-tabla">
            <h3 class="form_title">Tareas Pendientes Para Hoy</h3>
            <table id="tareas">
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Prioridad</th>
                </tr>
                <!--Obtener tareas para hoy-->
                <?php foreach($data['tasksToday'] as $taskToday) : ?>      
                <tr>
                    <td><?php echo $taskToday->nombre; ?></td>
                    <td><?php echo $taskToday->descripcion; ?></td>
                    <td><?php echo $taskToday->estado; ?></td>
                    <td><?php echo $taskToday->prioridad; ?></td>
                </tr>
               <?php endforeach; ?>            
               
            </table>
        </article>
        <article class="widget-tabla">
            <h3 class="form_title">Tareas Pendientes a la semana</h3>
            <table id="tareas">
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Prioridad</th>
                </tr>
                <!--Obtener tareas pendientes durante 7 días-->
                <?php foreach($data['tasks'] as $task) : ?>
                <tr>
                    <td><?php if(empty($task->nombre_tarea)){ echo 'No hay tarea';}else{$task->nombre_tarea;} ?></td>
                    <td><?php echo $task->descripcion; ?></td>
                    <td><?php echo $task->estado; ?></td>
                    <td><?php echo $task->prioridad; ?></td>
                </tr>
                <?php endforeach; ?>
                           
                       
            </table>
        </article>
    </div>

    <div id="info">
    <div class="widget-info">

    <?php  if(isset($_SESSION['error_register'])) :  ?>
                <?php foreach($_SESSION['error_register'] as $error) :  ?> 
                    <strong><?php echo $error; ?></strong>
                <?php endforeach; ?>    
            <?php endif; ?>    
        <article class="widget-tabla">
            <h3 class="form_title">Añadir Tarea</h3>
                <form action="<?php echo PATH_URL ?>/Tasks/addTasks/" method="POST" >
                
                    <label class="form_label" for="name">Nombre:</label>
                    <input class="form_input" type="text" name="name" value="<?php echo $data['name'] ? $data['name'] : ''; ?>">
                
                
                    <label class="form_label"  for="date">Fecha Límite:</label>
                    <input class="form_input" type="date" name="date" value="<?php echo $data['date'] ? $data['date'] : ''; ?>" >

                    <label class="form_label"  for="author">Autor:</label>
                    <input class="form_input"  type="text" name="author" value="<?php echo $data['author'] ? $data['author'] : ''; ?>">

                    <label  class="form_label" for="project">Seleccione Proyecto:</label>
                    <select name="project">
                        <?php foreach($data['projects'] as $project) : ?>
                        <option value="<?php echo $project->id_proyecto; ?>"><?php echo $project->nombre_proyecto; ?></option>
                        <?php endforeach; ?>
                    </select>
                    

                    <label class="form_label"  for="description">Descripción:</label>
                    <textarea type="text" name="description"><?php echo $data['description'] ? $data['description'] : ''; ?></textarea>

                    <label class="form_label"  for="state">Estado:</label>
                    <select name="state">
                        <option value="Sin Empezar"<?php if($data['state']=='Sin Empezar'){echo 'selected=""';} ?>>Sin empezar</option>
                        <option value="Comenzada"<?php if($data['state']=='Comenzada'){echo 'selected=""';} ?>>Comenzada</option>
                        <option value="Completada"<?php  if($data['state']=='Completada'){echo 'selected=""';}?>>Completada</option>
                        <option value="Cancelada"<?php if($data['state']=='Cancelada'){echo 'selected=""';} ?>>Cancelada</option>
                    </select>

                    <label class="form_label"  for="priority">Prioridad:</label>
                    <select name="priority">
                        <option value="Baja"<?php if($data['priority']=='Baja'){echo 'selected=""';} ?>>Baja</option>
                        <option value="Normal"<?php if($data['priority']=='Normal'){echo 'selected=""';} ?>>Normal</option>
                        <option value="Alta"<?php if($data['priority']=='Alta'){echo 'selected=""';} ?>>Alta</option>
                        <option value="Urgente"<?php if($data['priority']=='Urgente'){echo 'selected=""';} ?>>Urgente</option>
                    </select>

                    <label class="form_label"  for="duration">Duración:</label>
                    <input class="form_input" type="number" name="duration" value="<?php echo $data['duration'] ? $data['duration'] : ''; ?>">
                    <span>h</span>

                    <label class="form_label" for="client">Cliente:</label>        
                    <select name="client">
                        <?php foreach($data['clients'] as $client) : ?>
                        <option value="<?=$client->id_cliente; ?>" ><?=$client->nombre_cliente; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <input class="form_submit" type="submit" value="Registrar Tarea">
            </form>
              
        </article>
    </div>
    <?php Utils::deleteSession('error_register');  ?>
</div>

    
    


</section>

<?php require_once PATH_APP.'/views/includes/footer.php'; ?>