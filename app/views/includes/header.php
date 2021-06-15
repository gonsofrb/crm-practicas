
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="<?php echo PATH_URL?>/css/style.css">
        <script src="https://kit.fontawesome.com/5c32f8297e.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo PATH_URL ?>/datatable/datatables.min.css">
        <script type="text/javascript" src="<?php echo PATH_URL ?>/datatable/datatables.min.js"></script>
        <title>CRM</title>
    </head>
<body>
    <div id="contenedor">

        <header id="header">
            <div class="notificaciones">
                <h2>Notificaciones</h2>
            </div>
            <div class="tiempo">
                <h2>Reloj</h2>
            </div>

            <div class="avatar">
           
                 
            </div>
            <nav id="menu">
                <ul>
                    <li>
                    <?php echo $_SESSION['nombre_usu_crm']; ?>
                    </li>
                   <li>
                        <a href="<?php echo PATH_URL ?>/Login/close/">Salir</a>
                   </li>  
                </ul>
            </nav>
        </header>