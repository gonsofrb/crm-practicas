<?php   
 include_once '../app/helpers/security.php'; 
 require_once PATH_APP.'/views/includes/header.php'; 
 require_once PATH_APP.'/views/includes/aside.php'; 

?>
    <div id="infoPresu">
        <h2>Presupuesto</h2>
        <form action="">
            <label for="client">Cliente</label>
            <input type="text">

            <label for="project">Proyecto</label>
            <input type="text">
            
           
            <label for="">Horas</label>
            <input type="number">

            <label for="duration">Duración</label>
            <input type="number">

        </form>
    </div>

 </section>
<?php require_once PATH_APP.'/views/includes/footer.php';?>