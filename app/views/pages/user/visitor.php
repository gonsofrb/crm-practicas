<?php include_once '../app/helpers/security.php'; ?>
<?php require_once PATH_APP.'/views/includes/header.php';   ?>
<?php require_once PATH_APP.'/views/includes/aside.php';   ?>



<div id="info">
    <div class="widget-info">
        <article class="widget-tabla">
            <h3>Bienvenid@<?=$_SESSION['nombre_usu_crm']; ?></h3>
            <p>Seleccione una opcion del panel lateral.</p>
        </article>
    </div>
</div>

</section>

<?php require_once PATH_APP.'/views/includes/footer.php'; ?>