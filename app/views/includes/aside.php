<section id="contenido">
    <aside id="aside">
        <img class="logo" src="<?php echo  PATH_URL ?>/img/logo.png" alt="logo empresa">
              <ul>
                    <li>
                        <span><i class="icono fas fa-bars"></i></span>
                        <span><a href="#" onclick="ocultar_mostrar();">Menu</a></span>
                    </li>
                  
                    <?php if($_SESSION['rol_crm'] == 1 || $_SESSION['rol_crm']<=3) {?>
                    <li>
                        <span><i class="icono fas fa-people-arrows"></i></span>
                        <span><a href="<?php echo PATH_URL ?>/Clients/see" class="item" >Clientes</a></span>
                    </li>
                    <?php } ?>
                    <?php if($_SESSION['rol_crm'] == 1) {?>
                    <li>
                        <span><i class="icono fas fa-user"></i></span>
                        <span><a href="<?php echo PATH_URL ?>/Users/see" class="item">Usuarios</a></span>
                    </li>
                    <?php }?>

                    <?php if($_SESSION['rol_crm'] == 1 || $_SESSION['rol_crm']<=3) {?>
                    <li>
                        <span><i class="icono fas fa-project-diagram"></i></span>
                        <span><a href="<?php echo PATH_URL ?>/Projects/see" class="item">Proyectos</a></span>
                    </li>
                    <li>
                        <span><i class="icono fas fa-cogs"></i></span>
                        <span><a href="#" class="item">Configuraci&oacute;n</a></span>
                    </li>
                    <li>
                        <span><i class="icono fas fa-book-open"></i></span>
                        <span><a href="<?php echo PATH_URL ?>/Tasks/index" class="item">Tareas</a></span>
                    </li>
                    <li>
                        <span><i class="icono fas fa-calculator"></i></span>
                        <span><a href="#"class="item" >Presupuestos</a></span>
                    </li>
                    
                    <li>
                        <span><i class="icono fas fa-file-signature"></i></span>
                        <span><a href="#" class="item">Facturas</a></span>
                    </li>
                    <li>
                        <span><i class="icono fas fa-graduation-cap"></i></span>
                        <span><a href="#" class="item">Formaci&oacute;n</a></span>
                    </li>
                    <li>
                        <span><i class="icono fas fa-hands-wash"></i></span>
                        <span><a href="#" class="item">Servicios</a></span>
                      
                    </li>
                    <?php }?>
                    <li>
                        <span><i class="icono fas fa-envelope"></i></span>
                        <span><a href="#" class="item">Mensajes</a></span>
                    </li>
                    <li>
                        <span><i class="icono fas fa-download"></i></span>
                        <span><a href="#" class="item">Descargas</a></span>
                      
                    </li>
                
               </ul> 
               
    </aside>